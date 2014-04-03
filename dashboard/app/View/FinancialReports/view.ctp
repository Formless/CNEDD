<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Financial Report');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($financialReport['FinancialReport']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Name'); ?></dt>
			<dd>
				<?php echo h($financialReport['FinancialReport']['name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($financialReport['FinancialReport']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Financial Report')), array('action' => 'edit', $financialReport['FinancialReport']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Financial Report')), array('action' => 'delete', $financialReport['FinancialReport']['id']), null, __('Are you sure you want to delete # %s?', $financialReport['FinancialReport']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Reports')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Financial Report')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Rows')), array('controller' => 'financial_rows', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Financial Row')), array('controller' => 'financial_rows', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Financial Rows')); ?></h3>
	<?php if (!empty($financialReport['FinancialRow'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Financial Report Id'); ?></th>
				<th><?php echo __('Row Name'); ?></th>
				<th><?php echo __('Type'); ?></th>
				<th><?php echo __('Budget Value'); ?></th>
				<th><?php echo __('Actual Value'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($financialReport['FinancialRow'] as $financialRow): ?>
			<tr>
				<td><?php echo $financialRow['id'];?></td>
				<td><?php echo $financialRow['financial_report_id'];?></td>
				<td><?php echo $financialRow['row_name'];?></td>
				<td><?php echo $financialRow['type'];?></td>
				<td><?php echo $financialRow['budget_value'];?></td>
				<td><?php echo $financialRow['actual_value'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'financial_rows', 'action' => 'view', $financialRow['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'financial_rows', 'action' => 'edit', $financialRow['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'financial_rows', 'action' => 'delete', $financialRow['id']), null, __('Are you sure you want to delete # %s?', $financialRow['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
</div>
