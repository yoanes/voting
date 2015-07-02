<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Vote;
use Cake\Network\Email\Email;

/**
 * Votes Controller
 *
 * @property \App\Model\Table\VotesTable $Votes
 */
class VotesController extends AppController
{

    private $adminEmail = 'voting@pentasbakat.com';

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->requireLogin();
        $this->set('votes', $this->paginate($this->Votes));
        $this->set('_serialize', ['votes']);
    }

    private function sendEmail($toEmail, $token) {
        $email = new Email('default');

        try {
            $email->from(['voting@pentasbakat.com' => 'Pentas Bakat Voting'])
                ->emailFormat('html')
                ->to($toEmail)
                ->bcc($this->adminEmail)
                ->subject('Your voting for Pentas Bakat')
                ->template('votingContent')
                ->viewVars(['token' => $token])
                ->send();

            $this->log("Email sent to $toEmail", 'info');
        } catch(Exception $e) {
            $this->log('Sending Email Exception : ' .  $e->getMessage(), 'error');
        }
    }

    private function filterData(&$data) {
        array_walk($data['contestant'], function(&$value, $key) {
            if(intval($value) < 0) {
                $value = 0;
            }
        });
    }

    /**
     * View method
     *
     * @param string|null $id Vote id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->requireLogin();

        $vote = $this->Votes->get($id, [
            'contain' => []
        ]);
        $this->set('vote', $vote);
        $this->set('_serialize', ['vote']);
    }

    private function displayResult(Vote $vote) {
        $result = $this->Votes->getAssignedVoteByToken($vote);

        $this->set('token', $vote->getToken());
        $this->set('remainingVote', $vote->getRemainingVote());
        $this->set('contestantsVote', $result);
        $this->render('/Votes/exhausted');

        return;
    }

    public function assign($token = null)
    {
        $session = $this->request->session();
        $this->loadModel('Contestants');
        $contestants = $this->Contestants->find('all');

        if($this->request->is('get')) {
            $vote = $this->Votes->getByToken($token);

            if (is_null($vote)) {
                $this->log('Voting\'s token:' . $token . ' given doesn\'t exist', 'info');
                return $this->redirectToPentasBakat();
            }

            if(!$vote->hasAnyVoteLeft()) {
                $this->log('Voting\'s token: ' . $token . ' given has been exhausted', 'info');
                $this->displayResult($vote);

                return;
            }

            $session->write('vote', $vote);

            $this->set('contestants', $contestants);
            $this->set('vote', $vote);

        } else if($this->request->is('post')) {
            $sessionVote = $session->read('vote');
            # if post, use the token from session to avoid token reuse/hijacking
            $token = $sessionVote->getToken();

            # if sessionToken is not set, then this is a direct post request. Should never happen
            if(is_null($token)) {
                $this->log("Trying to assign vote when session's token is null.", 'info');
                $this->redirectToPentasBakat();
                return;
            }

            $data = $this->request->data();

            $this->filterData($data);

            # return to form if total assigned vote exceed the remaining vote
            $totalVotesToBeAssigned = array_sum($data['contestant']);
            if($totalVotesToBeAssigned > $sessionVote->getRemainingVote()) {
                $this->Flash->set("You're trying to assign $totalVotesToBeAssigned votes but you only have $sessionVote->getRemainingVote() left");
                $this->set('contestants', $contestants);
                $this->set('vote', $sessionVote);

                return $this->redirect([
                    'action' => 'assign',
                    $sessionVote->getToken()
                ], 301);
            }

            # so far so good, start assigning vote
            foreach($data['contestant'] as $contestantId => $assignedVote) {

                $assignedVote = intval($assignedVote);

                # contestant doesn't exist, most likely html has been tampered
                if(!$this->Contestants->exists(['id' => $contestantId])) {
                    $this->log("Cannot assign vote token: $token to nonexistent contestant id: $contestantId", 'warning');
                    continue;
                }

                # skip empty vote
                if($assignedVote == 0) {
                    continue;
                }

                # Validate if assignedVote is anything but integer
                if(!is_int($assignedVote)) {
                    continue;
                }

                $this->Votes->assignVote($contestantId, $assignedVote, $sessionVote);
            }

            return $this->displayResult($sessionVote);
        }
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->requireLogin();

        $vote = $this->Votes->newEntity();
        if ($this->request->is('post')) {
            $vote = $this->Votes->patchEntity($vote, $this->request->data);
            if ($this->Votes->save($vote)) {
                $this->sendEmail($vote->getEmail(), $vote->getToken());
                $this->Flash->success(__('The vote has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vote could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vote'));
        $this->set('_serialize', ['vote']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vote id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->requireLogin();

        $vote = $this->Votes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vote = $this->Votes->patchEntity($vote, $this->request->data);
            if ($this->Votes->save($vote)) {
                $this->Flash->success(__('The vote has been saved.'));
//                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vote could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vote'));
        $this->set('_serialize', ['vote']);
    }

    public function resendEmail($id = null) {
        $this->requireLogin();

        $vote = $this->Votes->get($id);
        if($vote != null) {
            $this->sendEmail($vote->getEmail(), $vote->getToken());

            $this->Flash->set("Email has been sent to " . $vote->getEmail());
        } else {
            $this->Flash->set("Vote with id: $id doesn't exist");
        }

        return $this->redirect([
            'action' => 'view',
            $vote->id
        ], 301);
    }
}
