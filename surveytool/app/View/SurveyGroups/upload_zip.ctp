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
		                echo $this->Form->input('Surveys', array('type' => 'file', 'label' => 'Completed Surveys (in Zip File)'));
	                ?>
	                </fieldset>
                <?php echo $this->Form->end(array('label' => 'Upload', 'class' => 'btn btn-inverse')); ?>
            </div>
        </div>
    </div>
</body>
