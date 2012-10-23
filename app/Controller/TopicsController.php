<?php

class TopicsController extends AppController {

	public $uses = array('Topic', 'User');

	public function index(){

		//すべてのTopicsを取得して、$topicsに格納する
		$topics = $this->Topic->find('all');

//		debug($topics);

		//$topicsをビューに渡してやる
		$this->set('topics', $topics);

	}


	//Topicの新規追加アクション
	public function create(){

		//POSTメソッドで中身のあるdataを送ってきて、
		if($this->request->is('post') && !empty($this->request->data)){
			
			//送られてきたデータを$dataに入れて、
			$data = $this->request->data;

			//ログインしている人のIDをAuthから引っ張ってきて、$dataの['user_id']に格納
			$data['Topic']['user_id'] = $this->Auth->user('id');

			//その$dataをセーブできたら、
			if($this->Topic->save($data)){

				//メッセージを表示してリダイレクトする。
				//$this->flash('トピックが追加されました。', '/Topics/index');
				$this->Session->setFlash('トピックが追加されました。');
				$this->redirect('/Topics/index');
			}
		}
	}


	//Topicの表示アクション
	public function view(){

		//GETメソッドで表示するトピックのIDが数字で送られてきていたら
		if($this->request->is('get') && !empty($this->request->pass[0]) && is_numeric($this->request->pass[0])){

			//トピックのIDをリクエストから受け取って$topic_idに格納
			$topic_id = $this->request->pass[0];

			//クエリの条件を設定
			$options = array(
				'conditions' => array('Topic.id' => $topic_id)
			);

			//$topic_idを使って、Topicモデルからレコードを探して、$recordに格納する。
			$record = $this->Topic->find('first', $options);
//			debug($record);

			//トピックが無かったらトピックスのトップページへリダイレクト。
			if(!$record){
				$this->Session->setFlash('指定されたトピックはありません。');
				$this->redirect('/Topics/index');
			}

			//必要なところだけを取り出す。
			$topic = $record['Topic'];
//			debug($topic);

			//クエリの条件を設定
			$options = array(
				'conditions' => array('User.id' => $topic['user_id'])
			);

			//$user_idからユーザーのデータを取得
			$user = $this->User->find('first', $options);
//			debug($user);


			//UserNameを取り出す。
			$username = $user['User']['username'];
//			debug($username);

			//ビューに渡してあげる
			$this->set('topic', $topic);
			$this->set('username', $username);

		}else{

				//POSTでのリクエスト、パラーメーターが無い、パラメーターが数字でない場合はトピックスのトップページへリダイレクト。
				$this->Session->setFlash('トピックのIDは数字で指定しください。');
				$this->redirect('/Topics/index');
		}
	}


	//Topicの削除アクション
	public function delete(){

		//GETメソッドで表示するトピックのIDが数字で送られてきていたら
		if($this->request->is('get') && !empty($this->request->pass[0]) && is_numeric($this->request->pass[0])){

			//トピックのIDをリクエストから受け取って$topic_idに格納
			$topic_id = $this->request->pass[0];

			//指定されたトピックが削除できたら、
			if($this->Topic->delete($topic_id)){
				//トップページへリダイレクト
				$this->Session->setFlash('トピックを削除しました。');
				$this->redirect('/Topics/index');
			}else{
				//指定されたトピックが削除できなかったら、トピックスのトップページへリダイレクト。
				$this->Session->setFlash('指定されたトピックの削除に失敗しました。');
				$this->redirect('/Topics/index');
			}

		}else{
				//POSTでのリクエスト、パラーメーターが無い、パラメーターが数字でない場合はトピックスのトップページへリダイレクト。
				$this->Session->setFlash('削除するトピックのIDは数字で指定しください。');
				$this->redirect('/Topics/index');
		}

	}


	//Topicの編集アクション
	public function edit(){

		if($this->request->is('get')){
			$topic_id = $this->request->pass[0];
			$this->Topic->id = $topic_id;
			$this->set('old_data', $this->Topic->read());
		}


		if($this->request->is('post')){
			$this->Topic->save($this->request->data);
			$this->Session->setFlash('トピックを更新しました。');
			$this->redirect('/Topics/index');
		}
	}

}

?>
