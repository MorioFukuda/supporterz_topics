<?php

App::uses('AuthComponent', 'Controller/Component');
class Comment extends AppModel {

	public $name = 'Comment';

	public $belongsTo = array('User', 'Topic');

	public $hasMany = array(
		'Like' => array(
			'conditions' => array('type' => 'comment'),
			'foreignKey' => 'extermal_key'
		)
	);
}

?>
