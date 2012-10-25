<?php

class LikesController extends AppController {

	public $uses = array('Comment', 'Topic', 'User', 'Like');

	public function likeTopic(){

		//GETメソッドでLikeするコメントのIDが送られてきたら
		if($this->request->is('get') && !empty($this->request->pass[0]) && is_numeric($this->request->pass[0])){

			$topic_id = $this->request->pass[0];

			$user_id = $this->Auth->user('id');

			$like['Like']['user_id'] = $user_id;
			$like['Like']['type'] = 'topic';
			$like['Like']['extermal_key'] = $topic_id;

			if($this->Like->save($like)){
				$this->Session->setFlash('トピックにLikeしました。');
				$this->redirect(array('controller' => 'Topics', 'action' => 'view', $topic_id));
			}

		}

	}

	public function likeComment(){

		//GETメソッドでLikeするコメントのIDが送られてきたら
		if($this->request->is('get') && !empty($this->request->pass[0]) && is_numeric($this->request->pass[0])){

			$comment_id = $this->request->pass[0];

			$comment = $this->Comment->find('first', array('conditions' => array('Comment.id' => $comment_id)));
			$topic_id = $comment['Comment']['topic_id'];
			$user_id = $this->Auth->user('id');

			$like['Like']['user_id'] = $user_id;
			$like['Like']['type'] = 'comment';
			$like['Like']['extermal_key'] = $comment_id;

			if($this->Like->save($like)){
				$this->Session->setFlash('コメントにLikeしました。');
				$this->redirect(array('controller' => 'Topics', 'action' => 'view', $topic_id));
			}

		}
	}
}

?>
