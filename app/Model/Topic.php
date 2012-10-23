<?php

App::uses('AuthComponent', 'Controller/Component');
class Topic extends AppModel {

	public $belongsTo = array('User');
}

?>
