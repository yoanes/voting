<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Email\Email;

/**
 * Votes Controller
 *
 * @property \App\Model\Table\VotesTable $Votes
 */
class VotesController extends AppController
{

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
            $result = $email->from(['replique.ministry@gmail.com' => 'Pentas Bakat Voting'])
                ->emailFormat('html')
                ->to($toEmail)
                ->subject('Your voting for Pentas Bakat')
                ->template('votingContent')
                ->viewVars(['token' => $token]);
        } catch(Exception $e) {
            echo 'Exception : ',  $e->getMessage(), "\n";
        }
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
        $vote = $this->Votes->get($id, [
            'contain' => []
        ]);
        $this->set('vote', $vote);
        $this->set('_serialize', ['vote']);
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
                $this->sendEmail($vote->get('email'), $vote->get('guid'));
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

    /**
     * Delete method
     *
     * @param string|null $id Vote id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->requireLogin();

        $this->request->allowMethod(['post', 'delete']);
        $vote = $this->Votes->get($id);
        if ($this->Votes->delete($vote)) {
            $this->Flash->success(__('The vote has been deleted.'));
        } else {
            $this->Flash->error(__('The vote could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}