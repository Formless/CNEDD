<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Membership Report');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($membershipReport['MembershipReport']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Report Date'); ?></dt>
			<dd>
				<?php echo h($membershipReport['MembershipReport']['report_date']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($membershipReport['MembershipReport']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Membership Report')), array('action' => 'edit', $membershipReport['MembershipReport']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Membership Report')), array('action' => 'delete', $membershipReport['MembershipReport']['id']), null, __('Are you sure you want to delete # %s?', $membershipReport['MembershipReport']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Membership Reports')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Membership Report')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Membership Rows')), array('controller' => 'membership_rows', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Membership Row')), array('controller' => 'membership_rows', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Membership Rows')); ?></h3>
	<?php if (!empty($membershipReport['MembershipRow'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Org Name'); ?></th>
				<th><?php echo __('Org Type'); ?></th>
				<th><?php echo __('First Name'); ?></th>
				<th><?php echo __('Last Name'); ?></th>
				<th><?php echo __('Email'); ?></th>
				<th><?php echo __('Ed'); ?></th>
				<th><?php echo __('Op Budget'); ?></th>
				<th><?php echo __('Area'); ?></th>
				<th><?php echo __('Renew Date'); ?></th>
				<th><?php echo __('Status'); ?></th>
				<th><?php echo __('Membership Report Id'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($membershipReport['MembershipRow'] as $membershipRow): ?>
			<tr>
				<td><?php echo $membershipRow['id'];?></td>
				<td><?php echo $membershipRow['org_name'];?></td>
				<td><?php echo $membershipRow['org_type'];?></td>
				<td><?php echo $membershipRow['first_name'];?></td>
				<td><?php echo $membershipRow['last_name'];?></td>
				<td><?php echo $membershipRow['email'];?></td>
				<td><?php echo $membershipRow['ed'];?></td>
				<td><?php echo $membershipRow['op_budget'];?></td>
				<td><?php echo $membershipRow['area'];?></td>
				<td><?php echo $membershipRow['renew_date'];?></td>
				<td><?php echo $membershipRow['status'];?></td>
				<td><?php echo $membershipRow['membership_report_id'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'membership_rows', 'action' => 'view', $membershipRow['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'membership_rows', 'action' => 'edit', $membershipRow['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'membership_rows', 'action' => 'delete', $membershipRow['id']), null, __('Are you sure you want to delete # %s?', $membershipRow['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
</div>
