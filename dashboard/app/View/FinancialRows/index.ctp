<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Financial Rows'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('financial_report_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('row_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('type');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('budget_value');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('actual_value');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($financialRows as $financialRow): ?>
			<tr>
				<td><?php echo h($financialRow['FinancialRow']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($financialRow['FinancialReport']['name'], array('controller' => 'financial_reports', 'action' => 'view', $financialRow['FinancialReport']['id'])); ?>
				</td>
				<td><?php echo h($financialRow['FinancialRow']['row_name']); ?>&nbsp;</td>
				<td><?php echo h($financialRow['FinancialRow']['type']); ?>&nbsp;</td>
				<td><?php echo h($financialRow['FinancialRow']['budget_value']); ?>&nbsp;</td>
				<td><?php echo h($financialRow['FinancialRow']['actual_value']); ?>&nbsp;</td>
				<td><?php echo h($financialRow['FinancialRow']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $financialRow['FinancialRow']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $financialRow['FinancialRow']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $financialRow['FinancialRow']['id']), null, __('Are you sure you want to delete # %s?', $financialRow['FinancialRow']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

		<?php echo $this->BootstrapPaginator->pagination(); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Financial Row')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Reports')), array('controller' => 'financial_reports', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Financial Report')), array('controller' => 'financial_reports', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>