<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span10">
                <div class="surveyGroups form">
                <?php echo $this->Form->create('SurveyGroup'); ?>
	                <fieldset>
		                <legend><?php echo __('Edit Training'); ?></legend>
	                <?php
		                echo $this->Form->input('survey_group_id');
		                echo $this->Form->input('name');
				$types = array('Brown Bag' => 'Brown Bag Lunch', 'Workshop' => 'Workshop', 'Info Session' => 'Info Session', 'Series' => 'Series', 'Tech Series' => 'Tech Series', 'Other' => 'Other'); 
		                echo $this->Form->input('type', array('options' => $types, 'default' => 'Boot Camp'));
		                echo $this->Form->input('instructor');
		                echo $this->Form->input('location');
		                echo $this->Form->input('date', array('class' => 'datepicker', 'type' => 'text'));
		                echo $this->Form->input('attendance');
		                echo $this->Form->input('free1', array('label' => 'Freeform Question 1', 'type' => 'textarea'));
		                echo $this->Form->input('free2', array('label' => 'Freeform Question 2', 'type' => 'textarea'));
		                echo $this->Form->input('free3', array('label' => 'Freeform Question 3', 'type' => 'textarea'));
	                ?>
	                </fieldset>
                <?php echo $this->Form->end(array('label' => 'Submit', 'class' => 'btn btn-inverse')); ?>
                </div>
                <div class="actions">
	                <h3><?php echo __('Actions'); ?></h3>
	                <?php echo $this->Form->postLink(__('Delete Training'), array('action' => 'delete', $this->Form->value('SurveyGroup.survey_group_id')), array('class' => 'btn btn-inverse'), __('Are you sure you want to delete %s?', $this->Form->value('SurveyGroup.name'))); ?>

	
                </div>
            </div>
        </div>
    </div>
</body>
