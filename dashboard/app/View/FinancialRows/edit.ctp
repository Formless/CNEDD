<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('FinancialRow', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('Financial Row')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('financial_report_id');
				echo $this->BootstrapForm->input('row_name');
				echo $this->BootstrapForm->input('type');
				echo $this->BootstrapForm->input('budget_value');
				echo $this->BootstrapForm->input('actual_value');
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
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FinancialRow.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('FinancialRow.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Rows')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Reports')), array('controller' => 'financial_reports', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Financial Report')), array('controller' => 'financial_reports', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>