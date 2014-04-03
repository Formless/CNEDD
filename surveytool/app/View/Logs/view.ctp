<div class="row-fluid">
	<div class="span9">
		<h2><?php  echo __('Log');?></h2>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
			<dd>
				<?php echo h($log['Log']['id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('User Id'); ?></dt>
			<dd>
				<?php echo h($log['Log']['user_id']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Controller'); ?></dt>
			<dd>
				<?php echo h($log['Log']['controller']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Function'); ?></dt>
			<dd>
				<?php echo h($log['Log']['function']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Details'); ?></dt>
			<dd>
				<?php echo h($log['Log']['details']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Theid'); ?></dt>
			<dd>
				<?php echo h($log['Log']['theid']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Url'); ?></dt>
			<dd>
				<?php echo h($log['Log']['url']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Data'); ?></dt>
			<dd>
				<?php echo h($log['Log']['data']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Ipaddr'); ?></dt>
			<dd>
				<?php echo h($log['Log']['ipaddr']); ?>
				&nbsp;
			</dd>
			<dt><?php echo __('Created'); ?></dt>
			<dd>
				<?php echo h($log['Log']['created']); ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('Edit %s', __('Log')), array('action' => 'edit', $log['Log']['id'])); ?> </li>
			<li><?php echo $this->Form->postLink(__('Delete %s', __('Log')), array('action' => 'delete', $log['Log']['id']), null, __('Are you sure you want to delete # %s?', $log['Log']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List %s', __('Logs')), array('action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New %s', __('Log')), array('action' => 'add')); ?> </li>
		</ul>
		</div>
	</div>
</div>

