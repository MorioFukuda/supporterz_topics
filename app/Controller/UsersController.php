<?php

class UsersController extends AppController {

	public $uses = array('User', 'Topic');

	public function beforeFilter(){

		//UserControllerの、addアクションと、logoutアクションは認証なしでもアクセスできるように。
		$this->Auth->allow('add', 'logout');

	}


	public function login(){
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash('IDかパスワードが違います。');
			}
		}
	}


	public function logout(){
		$this->redirect($this->Auth->logout());
	}

	//ユーザーの追加アクション
	public function add(){

		//POSTメソッドだったら
		if($this->request->is('post')){
			
			//Userモデルのインスタンスを初期化
			$this->User->create();

			//データが保存できたら
			if ($this->User->save($this->request->data)) {

				//メッセージを出してリダイレクト。
				$this->Session->setFlash('ユーザーを登録しました。');
				$this->redirect(array('action' => 'login'));

			} else {

				//失敗したとメッセージを出す。
				$this->Session->setFlash('ユーザー登録に失敗しました。');
			}

		}
	}

	//ユーザーの削除アクション
	public function delete(){

		$user_id = $this->Auth->user('id');

		//ユーザーのデータを削除
		$this->User->delete($user_id);


		//ユーザーが投稿したトピックを削除する
		$conditions = array('Topic.user_id' => $user_id);
		$this->Topic->deleteAll($conditions);

		//ログインページにリダイレクト
		$this->Session->setFlash('ユーザー情報を削除しました。');	
		$this->redirect(array('action' => 'login'));
	}


}

?>
