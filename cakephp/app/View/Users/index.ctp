<h1>狼人杀</h1>
<?php echo $this->Flash->render('auth'); ?>
<?php echo $this->Form->create('User',['url'=>array('action'=>'login')]); ?>
    <?php

        echo $this->Form->input('username',['label'=>'用户名']);
        echo $this->Form->input('password',['label'=>'密码']);
    ?>
<?php echo $this->Form->end(__('登陆')); ?>

<?php echo $this->Form->create(null,['url'=>array('action'=>'add'),'type'=>'get']); ?>
<?php echo $this->Form->end(__('注册')); ?>
