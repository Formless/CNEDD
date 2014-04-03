<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <h3><?php echo __('Actions'); ?></h3>
	            <ul>
	                <?php echo $this->Html->link("New Training", "./add", array('class' => 'btn btn-inverse')); ?>
	            </ul>
            </div>
            <div class="span10">
                <h2><?php echo __('Trainings'); ?></h2>
	            <table class="table table-striped">
                <tr>
		                <th><?php echo $this->Paginator->sort('name'); ?></th>
		                <th><?php echo $this->Paginator->sort('type'); ?></th>
		                <th><?php echo $this->Paginator->sort('instructor'); ?></th>
		                <th><?php echo $this->Paginator->sort('location'); ?></th>
		                <th width="100"><?php echo $this->Paginator->sort('date'); ?></th>
				        <th title><?php echo $this->Paginator->sort('free1'); ?></th>
				        <th><?php echo $this->Paginator->sort('free2'); ?></th>
				        <th><?php echo $this->Paginator->sort('free3'); ?></th>
		                <th><?php echo $this->Paginator->sort('attendance'); ?></th>
                </tr>
                <?php
                foreach ($surveyGroups as $surveyGroup): ?>
                <tr>
	                <td><?php echo $this->Html->link(__($surveyGroup['SurveyGroup']['name']), array('action' => 'view', $surveyGroup['SurveyGroup']['survey_group_id'])); ?>&nbsp;</td>
	                <td><?php echo h($surveyGroup['SurveyGroup']['type']); ?>&nbsp;</td>
	                <td><?php echo h($surveyGroup['SurveyGroup']['instructor']); ?>&nbsp;</td>
	                <td><?php echo h($surveyGroup['SurveyGroup']['location']); ?>&nbsp;</td>
	                <td><?php echo h($surveyGroup['SurveyGroup']['date']); ?>&nbsp;</td>
			        <td><?php echo h($surveyGroup['SurveyGroup']['free1']); ?>&nbsp;</td>
			        <td><?php echo h($surveyGroup['SurveyGroup']['free2']); ?>&nbsp;</td>
			        <td><?php echo h($surveyGroup['SurveyGroup']['free3']); ?>&nbsp;</td>
			        <td><?php echo h($surveyGroup['SurveyGroup']['attendance']); ?>&nbsp;</td>
                </tr>
                <?php endforeach; ?>
                </table>
	            <?php echo $this->Paginator->pagination(); ?>
            </div>
        </div>
    </div>
</body>
