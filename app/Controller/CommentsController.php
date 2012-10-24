<?php

class CommentsController extends AppController {

	public $uses = array('Comment', 'Topic', 'User', 'Like');

	public function create(){

		//POSTで中身のあるデータを送ってきて、
		if($this->request->is('post') && !empty($this->request->data)){

			//送られてきたデータを$dataに格納
			$data = $this->request->data;

			//ログインしている人のIDを$dataに追加
			$data['Comment']['user_id'] = $this->Auth->user('id');
//			debug($data);
			if($this->Comment->save($data)){
				$this->Session->setFlash('コメントを記入しました。');
				$this->redirect(array('controller'=>'Topics', 'action'=>'view', $data['Comment']['topic_id']));
			}
		}
	}


	public function delete(){

		//GETメソッドで削除するコメントのIDが送られてきたら
		if($this->request->is('get') && !empty($this->request->pass[0]) && is_numeric($this->request->pass[0])){

			//コメントidをパラメーターから取得する
			$comment_id = $this->request->pass[0];
//			debug($comment_id);

			//コメントのデータを引っ張ってくる
			$comment = $this->Comment->find('first', array('conditions' => array('Comment.id' => $comment_id)));
//			debug($comment);

			//コメントがつけられていたトピックのIDを取得
			$topic_id = $comment['Comment']['topic_id'];
//			debug($topic_id);

			if($this->Comment->delete($comment_id)){
				$this->Session->setFlash('コメントを削除しました。');
				$this->redirect(array('controller'=>'Topics', 'action'=>'view', $topic_id));
			}
		}
	}


	public function edit(){

		//GETメソッドで表示するトピックのIDが数字で送られてきていたら
		if($this->request->is('get') && !empty($this->request->pass[0]) && is_numeric($this->request->pass[0])){

			$comment_id = $this->request->pass[0];

			$comment = $this->Comment->find('first', array('conditions' => array('Comment.id' => $comment_id)));

			$this->set('comment', $comment);
		}

	}


	public function edit_excute(){

		if($this->request->is('post')){

			$comment = $this->request->data;
//			debug($comment);

			$old_comment = $this->Comment->find('first', array('conditions' => array('Comment.id' => $comment['Comment']['id'])));

			$new_comment = $old_comment['Comment'];
//			debug($new_comment);

			$topic_id = $new_comment['topic_id'];

			$new_comment['body'] = $comment['Comment']['body'];

			$this->Comment->save($new_comment);

			$this->Session->setFlash('コメントを更新しました。');
			$this->redirect(array('controller'=>'Topics', 'action'=>'view', $topic_id));
		}

	}

}

?>
