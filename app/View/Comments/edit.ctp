<?php

//debug($old_data);

echo $this->Form->create('Comment', array('action' => 'edit_excute'));
echo $this->Form->textarea('body', array('value' => $comment['Comment']['body']));
echo $this->Form->hidden('id', array('value' => $comment['Comment']['id']));
echo $this->Form->end('コメントを更新する');

?>
