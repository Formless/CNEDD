<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Membership Row');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Org Name'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['org_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Org Type'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['org_type']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('First Name'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['first_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Last Name'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['last_name']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Email'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['email']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Ed'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['ed']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Op Budget'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['op_budget']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Area'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['area']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Renew Date'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['renew_date']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Status'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['status']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($membershipRow['MembershipRow']['modified']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Membership Report'); ?></dt>
			<dd>
				<?php echo $this->Html->link($membershipRow['MembershipReport']['report_date'], array('controller' => 'membership_reports', 'action' => 'view', $membershipRow['MembershipReport']['id'])); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Membership Row')), array('action' => 'edit', $membershipRow['MembershipRow']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Membership Row')), array('action' => 'delete', $membershipRow['MembershipRow']['id']), null, __('Are you sure you want to delete # %s?', $membershipRow['MembershipRow']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Membership Rows')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Membership Row')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Membership Reports')), array('controller' => 'membership_reports', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Membership Report')), array('controller' => 'membership_reports', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

