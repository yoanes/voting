<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    protected $key = 'isAdmin';

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    protected function isLoggedIn() {
        $session = $this->request->session();

        if($session->check($this->key)) {
            return true;
        }

        return false;
    }

    protected function requireLogin() {
        if(!$this->isLoggedIn()) {
            $this->redirectToLogin();
        }
    }

    public function beforeRender(Event $event) {
        if($this->isLoggedIn()) {
            $this->set('showLogout', true);
        }
    }

    protected function redirectToLogin() {
        return $this->redirect([
            'controller' => 'users',
            'action' => 'login'
        ]);
    }

    protected function redirectToPentasBakat() {
        return $this->redirect('http://pentasbakat.com');
    }
}
