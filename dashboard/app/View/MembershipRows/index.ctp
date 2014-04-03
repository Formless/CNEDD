<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Membership Rows'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

        <!-- prevent Actions menu from obscuring chart -->
	    <br><br><br><br>
		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('org_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('org_type');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('first_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('last_name');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('email');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('ed');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('op_budget');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('area');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('renew_date');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('status');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('modified');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('membership_report_id');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($membershipRows as $membershipRow): ?>
			<tr>
				<td><?php echo h($membershipRow['MembershipRow']['id']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['org_name']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['org_type']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['first_name']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['last_name']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['email']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['ed']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['op_budget']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['area']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['renew_date']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['status']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['created']); ?>&nbsp;</td>
				<td><?php echo h($membershipRow['MembershipRow']['modified']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($membershipRow['MembershipReport']['report_date'], array('controller' => 'membership_reports', 'action' => 'view', $membershipRow['MembershipReport']['id'])); ?>
				</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $membershipRow['MembershipRow']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $membershipRow['MembershipRow']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $membershipRow['MembershipRow']['id']), null, __('Are you sure you want to delete # %s?', $membershipRow['MembershipRow']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Membership Row')), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Membership Reports')), array('controller' => 'membership_reports', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Membership Report')), array('controller' => 'membership_reports', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>
