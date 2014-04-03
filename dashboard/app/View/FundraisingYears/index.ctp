<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Fundraising Years'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('year');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('coporate_goal', 'Corporate Goal');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('major_donor_goal', 'Individual Goal');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('foundation_goal');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('pday_goal');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($fundraisingYears as $fundraisingYear): ?>
			<tr>
				<td><?php echo h($fundraisingYear['FundraisingYear']['id']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingYear['FundraisingYear']['year']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingYear['FundraisingYear']['coporate_goal']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingYear['FundraisingYear']['major_donor_goal']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingYear['FundraisingYear']['foundation_goal']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingYear['FundraisingYear']['pday_goal']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingYear['FundraisingYear']['created']); ?>&nbsp;</td>
				<td><?php echo h($fundraisingYear['FundraisingYear']['modified']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $fundraisingYear['FundraisingYear']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fundraisingYear['FundraisingYear']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fundraisingYear['FundraisingYear']['id']), null, __('Are you sure you want to delete # %s?', $fundraisingYear['FundraisingYear']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Year')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Months')), array('controller' => 'fundraising_months', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Month')), array('controller' => 'fundraising_months', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>
