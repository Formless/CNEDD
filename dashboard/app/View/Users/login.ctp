<!-- app/View/Users/login.ctp -->
</div>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1">
            </div>
            <div class="span10">
                <?php echo $this->Session->flash('auth'); ?>
                <?php echo $this->Form->create('User'); ?>
                <fieldset>
                    <legend><?php echo __('Please enter your username and password'); ?></legend>
                <?php
                    echo $this->Form->input('username');
                    echo $this->Form->input('password');
                ?>
                </fieldset>
                <?php echo $this->Form->end(__('Login')); ?>

                <?php echo "Need an account?  " . $this->Html->link(__('Create one'), array('action' => 'add'));?>
            </div>
        </div>
    </div>
</body>
