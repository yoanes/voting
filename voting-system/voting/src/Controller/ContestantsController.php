<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Contestants Controller
 *
 * @property \App\Model\Table\ContestantsTable $Contestants
 */
class ContestantsController extends AppController
{

    public function beforeFilter(Event $event) {
        $this->requireLogin();
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('contestants', $this->paginate($this->Contestants));
        $this->set('_serialize', ['contestants']);
    }

    /**
     * View method
     *
     * @param string|null $id Contestant id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contestant = $this->Contestants->get($id);
        $this->set('contestant', $contestant);
        $this->set('_serialize', ['contestant']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contestant = $this->Contestants->newEntity();
        if ($this->request->is('post')) {
            $contestant = $this->Contestants->patchEntity($contestant, $this->request->data);
            if ($this->Contestants->save($contestant)) {
                $this->Flash->success(__('The contestant has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contestant could not be saved. Please, try again.'));
            }
        }
        $votes = $this->Contestants->Votes->find('list', ['limit' => 200]);
        $this->set(compact('contestant', 'votes'));
        $this->set('_serialize', ['contestant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contestant id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contestant = $this->Contestants->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contestant = $this->Contestants->patchEntity($contestant, $this->request->data);
            if ($this->Contestants->save($contestant)) {
                $this->Flash->success(__('The contestant has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The contestant could not be saved. Please, try again.'));
            }
        }
        $votes = $this->Contestants->Votes->find('list', ['limit' => 200]);
        $this->set(compact('contestant', 'votes'));
        $this->set('_serialize', ['contestant']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contestant id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contestant = $this->Contestants->get($id);
        if ($this->Contestants->delete($contestant)) {
            $this->Flash->success(__('The contestant has been deleted.'));
        } else {
            $this->Flash->error(__('The contestant could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
