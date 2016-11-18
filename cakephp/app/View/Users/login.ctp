<h1>狼人杀</h1>
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User',['url'=>array('action'=>'login')]); ?>
    <fieldset>
        <?php

        echo $this->Form->input('username',['label'=>'用户名']);
        echo $this->Form->input('password',['label'=>'密码']);
    ?>
    </fieldset>
<?php echo $this->Form->end(__('登陆')); ?>
