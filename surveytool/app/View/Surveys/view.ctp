<div class="surveys view">
<h2><?php  echo __('Survey'); ?></h2>
	<dl>
		<dt><?php echo __('Survey Id'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['survey_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Survey Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($survey['SurveyGroup']['name'], array('controller' => 'survey_groups', 'action' => 'view', $survey['SurveyGroup']['survey_group_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exposure'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['exposure']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('New Ideas'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['new_ideas']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expectations'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['expectations']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Interactivity'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['interactivity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Training Source'); ?></dt>
		<dd>
			<?php echo h($survey['Survey']['training_source']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Survey'), array('action' => 'edit', $survey['Survey']['survey_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Survey'), array('action' => 'delete', $survey['Survey']['survey_id']), null, __('Are you sure you want to delete # %s?', $survey['Survey']['survey_id'])); ?> </li>
	</ul>
</div>
