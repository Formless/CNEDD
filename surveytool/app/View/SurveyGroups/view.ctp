<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1">
            </div>
            <div class="span10">
                <div class="surveyGroups view">
                <?php echo $this->Session->flash('flash'); ?>
                <h2><?php  echo __('Training'); ?></h2>

	                <div class="well" style="padding: 8px 0;">
                        	<ul class="nav nav-list">
			                <li class="nav-header"><?php echo __('Training Id'); ?></li>
			                <li><?php echo h($surveyGroup['SurveyGroup']['survey_group_id']); ?></li>
			                <li class="nav-header"><?php echo __('Training Name'); ?></li>
			                <li><?php echo h($surveyGroup['SurveyGroup']['name']); ?></li>
			                <li class="nav-header"><?php echo __('Training Type'); ?></li>
			                <li><?php echo h($surveyGroup['SurveyGroup']['type']); ?></li>
			                <li class="nav-header"><?php echo __('Instructor'); ?></li>
			                <li><?php echo h($surveyGroup['SurveyGroup']['instructor']); ?></li>
			                <li class="nav-header"><?php echo __('Location'); ?></li>
			                <li><?php echo h($surveyGroup['SurveyGroup']['location']); ?></li>
			                <li class="nav-header"><?php echo __('Date'); ?></li>
			                <li><?php echo h($surveyGroup['SurveyGroup']['date']); ?></li>
			                <li class="nav-header"><?php echo __('Attendance'); ?></li>
			                <li><?php echo h($surveyGroup['SurveyGroup']['attendance']); ?></li>
                        	</ul>
                      </div>
                </div>
                <div class="actions">
	                <h3><?php echo __('Actions'); ?></h3>

		                <?php echo $this->Html->link(__('Edit Training'), array('action' => 'edit', $surveyGroup['SurveyGroup']['survey_group_id']), array('class' => 'btn btn-inverse')); ?>
		                <?php echo $this->Html->link(__('Generate PDF'), array('action' => 'pdfgen', $surveyGroup['SurveyGroup']['survey_group_id']), array('class' => 'btn btn-inverse')); ?>
				        <?php echo $this->Html->link(__('Upload Complete Surveys'), array('action' => 'upload_zip', $surveyGroup['SurveyGroup']['survey_group_id']), array('class' => 'btn btn-inverse')); ?>
				        <?php echo $this->Html->link(__('Update Results'), array('action' => 'upload', $surveyGroup['SurveyGroup']['survey_group_id']), array('class' => 'btn btn-inverse')); ?>
		                <?php echo $this->Html->link(__('View Analysis'), array('controller' => 'charts', 'action' => 'view', $surveyGroup['SurveyGroup']['survey_group_id']), array('class' => 'btn btn-inverse')); ?>
		                <?php echo $this->Form->postLink(__('Delete Training'), array('action' => 'delete', $surveyGroup['SurveyGroup']['survey_group_id']), array('class' => 'btn btn-inverse'), __('Are you sure you want to delete %s?', $surveyGroup['SurveyGroup']['name'])); ?> 

                </div>
                <div class="related">
	                <h3><?php echo __('Related Surveys'); ?></h3>
	                <?php if (!empty($surveyGroup['Survey'])): ?>
	                <table class="table table-bordered table-striped table-hover">
	                <tr>
		                <th><?php echo __('Survey Id'); ?></th>
		                <th><?php echo __('Training Id'); ?></th>
		                <th><?php echo __('Exposure'); ?></th>
		                <th><?php echo __('New Ideas'); ?></th>
		                <th><?php echo __('Expectations'); ?></th>
		                <th><?php echo __('Interactivity'); ?></th>
		                <th><?php echo __('Training Source'); ?></th>
	                </tr>
	                <?php
		                $i = 0;
		                foreach ($surveyGroup['Survey'] as $survey): ?>
		                <tr>
			                <td><?php echo $survey['survey_id']; ?></td>
			                <td><?php echo $survey['survey_group_id']; ?></td>
			                <td><?php echo $survey['exposure']; ?></td>
			                <td><?php echo $survey['new_ideas']; ?></td>
			                <td><?php echo $survey['expectations']; ?></td>
			                <td><?php echo $survey['interactivity']; ?></td>
			                <td><?php echo $survey['training_source']; ?></td>
		                </tr>
	                    <?php endforeach; ?>
	                </table>
                <?php endif; ?>
                </div>
            </div>            
        </div>
    </div>
</body>
