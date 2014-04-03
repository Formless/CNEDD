<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Financial Row');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($financialRow['FinancialRow']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Financial Report'); ?></dt>
			<dd>
				<?php echo $this->Html->link($financialRow['FinancialReport']['name'], array('controller' => 'financial_reports', 'action' => 'view', $financialRow['FinancialReport']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Row Name'); ?></dt>
			<dd>
				<?php echo h($financialRow['FinancialRow']['row_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Type'); ?></dt>
			<dd>
				<?php echo h($financialRow['FinancialRow']['type']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Budget Value'); ?></dt>
			<dd>
				<?php echo h($financialRow['FinancialRow']['budget_value']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Actual Value'); ?></dt>
			<dd>
				<?php echo h($financialRow['FinancialRow']['actual_value']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($financialRow['FinancialRow']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Financial Row')), array('action' => 'edit', $financialRow['FinancialRow']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Financial Row')), array('action' => 'delete', $financialRow['FinancialRow']['id']), null, __('Are you sure you want to delete # %s?', $financialRow['FinancialRow']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Rows')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Financial Row')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Reports')), array('controller' => 'financial_reports', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Financial Report')), array('controller' => 'financial_reports', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

