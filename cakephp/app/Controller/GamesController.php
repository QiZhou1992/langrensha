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
App::uses('User', 'Model');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class GamesController extends AppController {
	public function index(){
		$params1 = array(
			'fields' => 'id',
			'conditions'=> array('isOver' => 0)

		);
		$currentUser = $this->Auth->user();
		$userId = $currentUser['id'];
		$params2 = array(
			'fields'=>array('rank'),		
			'conditions'=>array('id'=>$userId)
		);
		$UserModel = new User();
		$users=$UserModel->find('all',$params2);
		$this->set('coins',$users[0]['User']['rank']);
		$allGames=$this->Game->find('all',$params1);
		$this->set('allGames',$allGames);
	}
	public function addGame(){
		$this->Game->create();
		$data=array('Game' => array(
				'isover' => 0
			)
		);
		$this->Game->save($data);
		return $this->redirect(array('controller'=>'GameInfos','action' => 'openGame','game_id'=>$this->Game->id,'role'=>0));
	}
}
