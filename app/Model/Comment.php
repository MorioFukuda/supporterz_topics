<?php

App::uses('AuthComponent', 'Controller/Component');
class Comment extends AppModel {

	public $belongsTo = array('User', 'Topic');

	public $hasMany = array(
		'Like' => array(
			'conditions' => array('Like.type' => 'comment')
		)
	);

}

?>
