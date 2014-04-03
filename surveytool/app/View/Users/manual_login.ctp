<!-- app/View/Users/login.ctp -->
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your email and password'); ?></legend>
    <?php
        echo $this->Form->input('username', array('label'=>'Email'));
        echo $this->Form->input('password', array ('label'=>'Password'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
