<div class="surveys form">
<?php echo $this->Form->create('Survey'); ?>
	<fieldset>
		<legend><?php echo __('Edit Survey'); ?></legend>
	<?php
		echo $this->Form->input('survey_id');
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Survey.survey_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Survey.survey_id'))); ?></li>
	</ul>
</div>
