<?php

App::uses('AuthComponent', 'Controller/Component');
class Topic extends AppModel {

	public $belongsTo = array('User');

	public $hasMany = array(
		'Comment',
		'Like' => array(
			'conditions' => array('Like.type' => 'Topic')
		)
	);

}

?>
