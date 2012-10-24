<?php

App::uses('AuthComponent', 'Controller/Component');
class Comment extends AppModel {

	public $belongsTo = array('User', 'Topic');

}

?>
