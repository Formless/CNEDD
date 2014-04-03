<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span10">
                <?php echo $this->Form->create('SurveyGroup'); ?>
	                <fieldset>
		                <legend><?php echo __('Add Training'); ?></legend>
	                <?php
		                echo $this->Form->input('name');
		                $types = array('Brown Bag' => 'Brown Bag Lunch', 'Workshop' => 'Workshop', 'Info Session' => 'Info Session', 'Series' => 'Series', 'Tech Series' => 'Tech Series', 'Other' => 'Other'); 
		                echo $this->Form->input('type', array('options' => $types, 'default' => 'Boot Camp'));
		                echo $this->Form->input('instructor');
		                echo $this->Form->input('location');
		                echo $this->Form->input('date', array('class' => 'datepicker', 'type' => 'text'));
		                echo $this->Form->input('free1', array('label' => 'Freeform Question 1', 'type' => 'textarea', 'default' => 'What did you find helpful and what could be improved?'));
		                echo $this->Form->input('free2', array('label' => 'Freeform Question 2', 'type' => 'textarea', 'default' => 'What other topics should the CNE offer?'));
		                echo $this->Form->input('free3', array('label' => 'Freeform Question 3', 'type' => 'textarea', 'default' => 'Additional Comments'));
	                ?>
	                </fieldset>
                <?php echo $this->Form->end(array('label' => 'Submit', 'class' => 'btn btn-inverse')); ?>
            </div>
        </div>
    </div>
</body>
