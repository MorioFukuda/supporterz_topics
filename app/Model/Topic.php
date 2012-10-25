<?php

App::uses('AuthComponent', 'Controller/Component');
class Topic extends AppModel {

	public $name = 'Topic';

	public $belongsTo = array('User');

	public $hasMany = array(
		'Like' => array(
			'conditions' => array('type' => 'topic'),
			'foreignKey' => 'extermal_key'
		)
	);
}

?>
