<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('FinancialReport', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('Financial Report')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('name');
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
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FinancialReport.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('FinancialReport.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Reports')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Rows')), array('controller' => 'financial_rows', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Financial Row')), array('controller' => 'financial_rows', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>