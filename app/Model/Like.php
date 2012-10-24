<?php

App::uses('AuthComponent', 'Controller/Component');
class Like extends AppModel {

	public $belongsTo = array('Comment', 'Topic');

}

?>
