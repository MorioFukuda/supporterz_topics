<?php

App::uses('AuthComponent', 'Controller/Component');
class Like extends AppModel {

	public $name = 'Like';

	public $belongsTo = array(
		'User' => array(
			'foreignKey' => 'user_id'
		),
		'Topic' => array(
			'foreignKey' => 'extermal_key'
		),
		'Comment' => array(
			'foreignKey' => 'extermal_key'
		)
	);


	//ユーザーIDと、何に対するいいね！かと、それに対する外部キーを入れてやると、
	//そのユーザーがそれに対していいね！してるかどうかを返す関数。
	public function isLiked($user_id, $type, $extermal_key){

		$options = array(
			'conditions' => array(
				'Like.user_id' => $user_id,
				'Like.type' => $type,
				'Like.extermal_key' => $extermal_key
			)
		);

		if($this->find('first', $options)){
			return true;
		}else{
			return false;
		}

	}

}

?>
