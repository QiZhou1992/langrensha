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
App::uses('Game', 'Model');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class GameInfosController extends AppController {
	/** To do: the most compicate function **/
	public function index(){
		$currentUser = $this->Auth->user();
		$userId = $currentUser['id'];
		$gameId = $this->request->params['named']['game_id'];
        $params1 = array(
			'fields'=>array('number','role','bet'),		
			'conditions'=>array('game_id'=>$gameId,'user_id'=>$userId)
		);
		$allGameInfos=$this->GameInfo->find('all',$params1);
		$number=count($allGameInfos);
		if($number == 0){
			return $this->redirect(array('action'=>'index','game_id'=>$gameId));
		}else{
			$theGameInfo=$allGameInfos[0];
            $role=$theGameInfo['GameInfo']['role'];
            $this->set('role',$role);
            if($role == 0){
           		$params1 = array(
					'fields'=>array('number','role','bet'),		
					'conditions'=>array('game_id'=>$gameId),
					'order'=>'number'
					);
		    	$allGameInfos=$this->GameInfo->find('all',$params1);
				$this->set('allInfos',$allGameInfos);
				$this->set('gameId',$gameId);
			}
			else{
				$params1 = array(
					'fields'=>array('number','bet'),		
					'conditions'=>array('game_id'=>$gameId),
					'order'=>'number'
					);
				$allGameInfos=$this->GameInfo->find('all',$params1);
				$this->set('allInfos',$allGameInfos);
				$this->set('gameId',$gameId);
			}
		}
	}
	public function addRole(){
		$currentUser = $this->Auth->user();
		$userId = $currentUser['id'];
		$gameId = $this->request->params['named']['game_id'];
		$params1 = array(
			'fields'=>array('id','role','bet'),		
			'conditions'=>array('game_id'=>$gameId,'user_id'=>$userId)
		);
		$allGameInfos=$this->GameInfo->find('all',$params1);
		$number=count($allGameInfos);
		$params2=array(
					'fields'=>array('rank','username'),
					'conditions'=>array('id'=>$userId)
				);
		$UserModel = new User();
		$users=$UserModel->find('all',$params2);
		$currentRank=$users[0]['User']['rank'];
		$currentRank=$currentRank-2;
		$rankArray=array();
		$countCoin=0;
		while(($countCoin<=10) && ($countCoin<=$currentRank)){
			array_push($rankArray,$countCoin);
			$countCoin=$countCoin+1;
		}
		$this->set('Coins',$rankArray);
		if($number != 0){
			return $this->redirect(array('action'=>'index','game_id'=>$gameId));
		}
		if($this->request->is('post')){
			$this->GameInfo->create();
			$data= array(
				'game_id' => $gameId,
				'user_id' => $userId,
				'number' =>$this->request->data['GameInfo']['number'],
				'role' => $this->request->data['GameInfo']['role'],
				'bet' => $this->request->data['GameInfo']['bet']
				);
			$this->GameInfo->save($data);
			return $this->redirect(array('action'=>'index','game_id'=>$gameId));
		}

	}
	/** To do: wolf won **/
	public function win(){
		$gameId = $this->request->params['named']['game_id'];
		$params1 = array(
			'fields'=>array('user_id','role','bet'),		
			'conditions'=>array('game_id'=>$gameId)
		);
		$allResults=$this->GameInfo->find('all',$params1);
		foreach($allResults as $result){
			$role = $result['GameInfo']['role'];
			$params2=array(
					'fields'=>array('rank','username'),
					'conditions'=>array('id'=>$result['GameInfo']['user_id'])
				);
			$UserModel = new User();
			$users=$UserModel->find('all',$params2);
			$currenRank=$users[0]['User']['rank'];
			$newRank=0;
			if($role==0){
				continue;
			}
			if($role==1){
				$newRank=$currenRank-1-$result['GameInfo']['bet'];
			}
			if(($role<=4)&&($role>=2)){
				$newRank=$currenRank+2+$result['GameInfo']['bet'];
			}
			if($role>4){
				$newRank=$currenRank-2-$result['GameInfo']['bet'];
			}
			if($newRank<0){
				$newRank=0;
			}
			$UserModel->id=$result['GameInfo']['user_id'];
			$data=array(
				'rank'=>$newRank
				);
			$UserModel->save($data);
		}
		$GameModel = new Game();
		$GameModel->id=$gameId;
		$data=array(
				'isover'=>1
				);
		$GameModel->save($data);
		return $this->redirect(array('controller'=>'Games','action'=>'index'));
	}
	/** To do: wolf lost **/
	public function lose(){
		$gameId = $this->request->params['named']['game_id'];
		$params1 = array(
			'fields'=>array('user_id','role','bet'),		
			'conditions'=>array('game_id'=>$gameId)
		);
		$allResults=$this->GameInfo->find('all',$params1);
		foreach($allResults as $result){
			$role = $result['GameInfo']['role'];
			$params2=array(
					'fields'=>array('rank','username'),
					'conditions'=>array('id'=>$result['GameInfo']['user_id'])
				);
			$UserModel = new User();
			$users=$UserModel->find('all',$params2);
			$currenRank=$users[0]['User']['rank'];
			$newRank=0;
			if($role==0){
				continue;
			}
			if($role==1){
				$newRank=$currenRank+1+$result['GameInfo']['bet'];
			}
			if(($role<=4)&&($role>=2)){
				$newRank=$currenRank-1-$result['GameInfo']['bet'];
			}
			if($role>4){
				$newRank=$currenRank+2+$result['GameInfo']['bet'];
			}
			if($newRank<0){
				$newRank=0;
			}
			$UserModel->id=$result['GameInfo']['user_id'];
			$data=array(
				'rank'=>$newRank
				);
			$UserModel->save($data);
		}
		$GameModel = new Game();
		$GameModel->id=$gameId;
		$data=array(
				'isover'=>1
				);
		$GameModel->save($data);
		return $this->redirect(array('controller'=>'Games','action'=>'index'));
	}
	public function openGame(){
		$currentUser = $this->Auth->user();
		$userId = $currentUser['id'];
		$gameId = $this->request->params['named']['game_id'];
		$role = $this->request->params['named']['role'];
		$params1 = array(
			'fields'=>'id',
			'conditions'=>array('game_id'=>$gameId,'user_id'=>$userId)
		);
		$allGameInfos=$this->GameInfo->find('all',$params1);
		$number=count($allGameInfos);
		if($number == 1){
			return $this->redirect(array('action'=>'index','game_id'=>$gameId));
		}
		if($role==0){
			$this->GameInfo->create();
			$data=array('GameInfo' => array(
					'number' => 0,
					'game_id'=>$gameId,
					'user_id'=>$userId,
					'role'=>0,
					'bet'=>0
					)
			);
			$this->GameInfo->save($data);
		}
		return $this->redirect(array('action'=>'index','game_id'=>$gameId));
	}
}
