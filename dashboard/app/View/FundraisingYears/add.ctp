<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('FundraisingYear', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Add %s', __('Fundraising Year')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('year', array(
					'required' => 'required',
					'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;',
					'class' => 'yearpicker', 'type' => 'text', 
					'data-date-viewmode' => 'years', 'data-date-minviewmode' => 'years', 'data-date-format' => 'yyyy')
				);
				echo $this->BootstrapForm->input('coporate_goal', array('label' => 'Corporate Goal'));
				echo $this->BootstrapForm->input('major_donor_goal', array('label' => 'Individual Goal'));
				echo $this->BootstrapForm->input('foundation_goal');
				echo $this->BootstrapForm->input('pday_goal');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Years')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Months')), array('controller' => 'fundraising_months', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Month')), array('controller' => 'fundraising_months', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>
