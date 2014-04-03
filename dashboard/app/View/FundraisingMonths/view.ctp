<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Fundraising Month');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Fundraising Year'); ?></dt>
			<dd>
				<?php echo $this->Html->link($fundraisingMonth['FundraisingYear']['year'], array('controller' => 'fundraising_years', 'action' => 'view', $fundraisingMonth['FundraisingYear']['id'])); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Month'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['month']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Corporate Received'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['coporate_recieved']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Corporate Pledged'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['corporate_outstanding']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Individual Received'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['major_donor_recieved']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Individual Pledged'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['major_donor_outstanding']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Foundations Received'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['foundation_recieved']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Foundations Pledged'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['foundation_outstanding']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Pday Received'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['pday_received']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Pday Pledged'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['pday_outstanding']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['created']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Modified'); ?></dt>
			<dd>
				<?php echo h($fundraisingMonth['FundraisingMonth']['modified']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Fundraising Month')), array('action' => 'edit', $fundraisingMonth['FundraisingMonth']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Fundraising Month')), array('action' => 'delete', $fundraisingMonth['FundraisingMonth']['id']), null, __('Are you sure you want to delete # %s?', $fundraisingMonth['FundraisingMonth']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Months')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Month')), array('action' => 'add')); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Years')), array('controller' => 'fundraising_years', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Year')), array('controller' => 'fundraising_years', 'action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

