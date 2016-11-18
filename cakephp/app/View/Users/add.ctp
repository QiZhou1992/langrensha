<h1> 狼人杀 </h1>
<?php echo $this->Form->create('User'); ?>
        <?php echo $this->Form->input('username',['label'=>'用户名']);
        echo $this->Form->input('password',['label'=>'密码']);
?>
<?php echo $this->Form->end(__('注册')); ?>