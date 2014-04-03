<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Fundraising Months'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('fundraising_year_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('month');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('coporate_recieved', 'Corporate Received');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('corporate_outstanding', 'Corporate Pledged');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('major_donor_recieved', 'Individual Received');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('major_donor_outstanding', 'Individual Pledged');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('foundation_recieved', 'Foundations Received');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('foundation_outstanding', 'Foundations Pledged');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('pday_received');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('pday_outstanding', 'Pday Pledged');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($fundraisingMonths as $fundraisingMonth): ?>
			<tr>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($fundraisingMonth['FundraisingYear']['year'], array('controller' => 'fundraising_years', 'action' => 'view', $fundraisingMonth['FundraisingYear']['id'])); ?>
				</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['month']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['coporate_recieved']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['corporate_outstanding']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['major_donor_recieved']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['major_donor_outstanding']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['foundation_recieved']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['foundation_outstanding']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['pday_received']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['pday_outstanding']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['created']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingMonth['FundraisingMonth']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $fundraisingMonth['FundraisingMonth']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fundraisingMonth['FundraisingMonth']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fundraisingMonth['FundraisingMonth']['id']), null, __('Are you sure you want to delete # %s?', $fundraisingMonth['FundraisingMonth']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Month')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Years')), array('controller' => 'fundraising_years', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Year')), array('controller' => 'fundraising_years', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>
