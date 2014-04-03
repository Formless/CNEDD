<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('FundraisingYear', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('Fundraising Year')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('year', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;')
				);
				echo $this->BootstrapForm->input('coporate_goal', array('label' => 'Corporate Goal'));
				echo $this->BootstrapForm->input('major_donor_goal', array('label' => 'Individual Goal'));
				echo $this->BootstrapForm->input('foundation_goal');
				echo $this->BootstrapForm->input('pday_goal');
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FundraisingYear.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('FundraisingYear.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Years')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Months')), array('controller' => 'fundraising_months', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Month')), array('controller' => 'fundraising_months', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>
