<?php

App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {

	public $name = 'User';

	public $hasMany = array('Topic', 'Comment', 'Like');

	public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
    return true;
	}

}

?>
