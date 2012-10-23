Topics Controller > Create Action

<?php

echo $this->Form->create('Topic');

echo $this->Form->input('Topic.title', array('label' => 'トピックタイトル'));
echo $this->Form->textarea('Topic.body');

echo $this->Form->end('トピック作成');

?>



