<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Fundraising Year');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($fundraisingYear['FundraisingYear']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Year'); ?></dt>
			<dd>
				<?php echo h($fundraisingYear['FundraisingYear']['year']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Corporate Goal'); ?></dt>
			<dd>
				<?php echo h($fundraisingYear['FundraisingYear']['coporate_goal']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Individual Goal'); ?></dt>
			<dd>
				<?php echo h($fundraisingYear['FundraisingYear']['major_donor_goal']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Foundation Goal'); ?></dt>
			<dd>
				<?php echo h($fundraisingYear['FundraisingYear']['foundation_goal']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Pday Goal'); ?></dt>
			<dd>
				<?php echo h($fundraisingYear['FundraisingYear']['pday_goal']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($fundraisingYear['FundraisingYear']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($fundraisingYear['FundraisingYear']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Fundraising Year')), array('action' => 'edit', $fundraisingYear['FundraisingYear']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Fundraising Year')), array('action' => 'delete', $fundraisingYear['FundraisingYear']['id']), null, __('Are you sure you want to delete # %s?', $fundraisingYear['FundraisingYear']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Years')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Year')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Months')), array('controller' => 'fundraising_months', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Month')), array('controller' => 'fundraising_months', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span9">
		<h3><?php echo __('Related %s', __('Fundraising Months')); ?></h3>
	<?php if (!empty($fundraisingYear['FundraisingMonth'])):?>
		<table class="table">
			<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Fundraising Year Id'); ?></th>
				<th><?php echo __('Month'); ?></th>
				<th><?php echo __('Corporate Received'); ?></th>
				<th><?php echo __('Corporate Pledged'); ?></th>
				<th><?php echo __('Individual Received'); ?></th>
				<th><?php echo __('Individual Pledged'); ?></th>
				<th><?php echo __('Foundations Received'); ?></th>
				<th><?php echo __('Foundations Pledged'); ?></th>
				<th><?php echo __('Pday Received'); ?></th>
				<th><?php echo __('Pday Pledged'); ?></th>
				<th><?php echo __('Created'); ?></th>
				<th><?php echo __('Modified'); ?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($fundraisingYear['FundraisingMonth'] as $fundraisingMonth): ?>
			<tr>
				<td><?php echo $fundraisingMonth['id'];?></td>
				<td><?php echo $fundraisingMonth['fundraising_year_id'];?></td>
				<td><?php echo $fundraisingMonth['month'];?></td>
				<td><?php echo $fundraisingMonth['coporate_recieved'];?></td>
				<td><?php echo $fundraisingMonth['corporate_outstanding'];?></td>
				<td><?php echo $fundraisingMonth['major_donor_recieved'];?></td>
				<td><?php echo $fundraisingMonth['major_donor_outstanding'];?></td>
				<td><?php echo $fundraisingMonth['foundation_recieved'];?></td>
				<td><?php echo $fundraisingMonth['foundation_outstanding'];?></td>
				<td><?php echo $fundraisingMonth['pday_received'];?></td>
				<td><?php echo $fundraisingMonth['pday_outstanding'];?></td>
				<td><?php echo $fundraisingMonth['created'];?></td>
				<td><?php echo $fundraisingMonth['modified'];?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('controller' => 'fundraising_months', 'action' => 'view', $fundraisingMonth['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('controller' => 'fundraising_months', 'action' => 'edit', $fundraisingMonth['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'fundraising_months', 'action' => 'delete', $fundraisingMonth['id']), null, __('Are you sure you want to delete # %s?', $fundraisingMonth['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>

	</div>
</div>
