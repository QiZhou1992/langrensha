<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class UsersController extends AppController {
    public function beforeFilter(){
      parent::beforeFilter();
      $this->Auth->allow('add','index');	
    }
    public function index(){

    }
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            $data=array('User'=>array(
            		'username'=>$this->request->data['User']['username'],
            		'password'=>$this->request->data['User']['password'],
                        'rank'=>20
            		)
            	);
            if ($this->User->save($data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('注册成功，请登录')
            );
        }
    }
    public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            return $this->redirect(array('controller'=>'Games','action' => 'index'));
        }
        $this->Flash->error(__('用户名或密码不正确，请重试'));
    }
}
}
