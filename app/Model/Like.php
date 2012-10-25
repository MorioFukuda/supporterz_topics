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

}

?>
