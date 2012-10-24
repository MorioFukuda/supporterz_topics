<?php

class LikesController extends AppController {

	public $uses = array('Comment', 'Topic', 'User', 'Like');

	public function likeTopic(){

		if($this->request->is('get')){

			$topic_id = $this->request->pass[0];

			$like['Like']['user_id'] = $this->Auth->user('id');
			$like['Like']['type'] = 'topic';
			$like['extermal_key'] = $topic_id;

			if($this->Like->save($like)){
				$this->Session->setFlash('トピックにLikeしました。');
				$this->redirect(array('controller'=>'Topics', 'action' => 'view', $topic_id));	
			}
		}

	}

	public function likeComment(){

	}
}

?>
