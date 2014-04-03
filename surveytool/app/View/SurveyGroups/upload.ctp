<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span10">
                <?php echo $this->Form->create('SurveyGroup', array('type' => 'file')); ?>
	                <fieldset>
		                <legend><?php echo __('Upload Surveys'); ?></legend>
	                <?php
		                echo $this->Form->input('Surveys', array('type' => 'file', 'label' => 'Survey Results (in CSV)'));
				echo $this->Form->input('attendance');
	                ?>
	                </fieldset>
                <?php echo $this->Form->end(array('label' => 'Analyze', 'class' => 'btn btn-inverse')); ?>
            </div>
        </div>
    </div>
</body>
