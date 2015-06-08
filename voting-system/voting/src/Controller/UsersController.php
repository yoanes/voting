<?php

namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController {

    private $defaultUser = 'admin';
    private $defaultPassword = 'password';

    public function login() {
       if($this->isLoggedIn()) {
           return $this->redirect([
               'controller' => 'contestants',
               'action' => 'index'
           ]);
       }

       if($this->request->is('post')) {
          $credential = $this->request->data;

           if($credential['username'] == $this->defaultUser &&
              $credential['password'] == $this->defaultPassword
           ) {
               $this->request->session()->write($this->key, true);
               return $this->redirect([
                   'controller' => 'contestants',
                   'action' => 'index'
               ]);
           } else {
               $this->Flash->error(__("Invalid credential supplied."));
           }
       }
    }

    public function logout() {
        $session = $this->request->session();

        if($this->isLoggedIn()) {
            $this->request->session()->delete($this->key);
            $this->request->session()->destroy();
        }

        $this->redirect("http://pentasbakat.com");
    }
}