<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <h3><?php echo __('Actions'); ?></h3>
	            <ul>
	                <?php echo $this->Html->link("New Survey", "./add", array('class' => 'btn')); ?>
	            </ul>
            </div>
            <div class="span10">
                <h2><?php echo __('Surveys'); ?></h2>
	            <table class="table table-striped">
	            <thead>
	            <tr>
			            <th><?php echo $this->Paginator->sort('survey_id'); ?></th>
			            <th><?php echo $this->Paginator->sort('survey_group_id'); ?></th>
			            <th><?php echo $this->Paginator->sort('exposure'); ?></th>
			            <th><?php echo $this->Paginator->sort('new_ideas'); ?></th>
			            <th><?php echo $this->Paginator->sort('expectations'); ?></th>
			            <th><?php echo $this->Paginator->sort('interactivity'); ?></th>
			            <th><?php echo $this->Paginator->sort('training_source'); ?></th>
			            <th class="actions"><?php echo __('Actions'); ?></th>
	            </tr>
	            </thead>
	            <tbody>
	            <?php foreach ($surveys as $survey): ?>
	            <tr>
		            <td><?php echo h($survey['Survey']['survey_id']); ?>&nbsp;</td>
		            <td>
			            <?php echo $this->Html->link($survey['SurveyGroup']['name'], array('controller' => 'survey_groups', 'action' => 'view', $survey['SurveyGroup']['survey_group_id'])); ?>
		            </td>
		            <td><?php echo h($survey['Survey']['exposure']); ?>&nbsp;</td>
		            <td><?php echo h($survey['Survey']['new_ideas']); ?>&nbsp;</td>
		            <td><?php echo h($survey['Survey']['expectations']); ?>&nbsp;</td>
		            <td><?php echo h($survey['Survey']['interactivity']); ?>&nbsp;</td>
		            <td><?php echo h($survey['Survey']['training_source']); ?>&nbsp;</td>
		            <td class="actions">
			            <?php echo $this->Html->link(__('View'), array('action' => 'view', $survey['Survey']['survey_id'])); ?>
			            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $survey['Survey']['survey_id'])); ?>
			            <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $survey['Survey']['survey_id']), null, __('Are you sure you want to delete # %s?', $survey['Survey']['survey_id'])); ?>
		            </td>
	            </tr>
                <?php endforeach; ?>
	            </tbody>
	            </table>

	            <?php echo $this->Paginator->pagination(); ?>
            </div>
        </div>
    </div>
</body>
