Topic Controller > Edit Action
<hr>
<?php

//debug($old_data);

echo $this->Form->create('Topic', array('action' => 'edit'));
echo $this->Form->input('title', array('value' => $old_data['Topic']['title']));
echo $this->Form->textarea('body', array('value' => $old_data['Topic']['body']));
echo $this->Form->input('id', array('type' => 'hidden', 'value' => $old_data['Topic']['id']));
echo $this->Form->end('トピックを更新する');

?>
