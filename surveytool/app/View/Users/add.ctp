<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span10">
                <?php echo $this->Form->create('User'); ?>
                    <fieldset>
                        <legend><?php echo __('Add User'); ?></legend>
                    <?php
                        echo $this->Form->input('username');
                        echo $this->Form->input('password');
                        echo $this->Form->input('role', array(
                            'options' => array('admin' => 'Admin', 'author' => 'Author')
                        ));
                    ?>
                    </fieldset>
                <?php echo $this->Form->end(__('Submit')); ?>
            </div>
        </div>
    </div>
</body>
