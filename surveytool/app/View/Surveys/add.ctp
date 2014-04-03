<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span10">
                <?php echo $this->Form->create('Survey'); ?>
	                <fieldset>
		                <legend><?php echo __('Add Survey'); ?></legend>
	                <?php
		                echo $this->Form->input('survey_group_id');
		                echo $this->Form->input('exposure');
		                echo $this->Form->input('new_ideas');
		                echo $this->Form->input('expectations');
		                echo $this->Form->input('interactivity');
		                echo $this->Form->input('training_source');
	                ?>
	                </fieldset>
                <?php echo $this->Form->end(__('Submit')); ?>
            </div>
        </div>
    </div>
</body>
