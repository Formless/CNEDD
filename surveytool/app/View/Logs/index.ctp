<div class="row-fluid">
	<div class="span9">
		<h2><?php echo __('List %s', __('Logs'));?></h2>

		<p>
			<?php echo $this->BootstrapPaginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>
		</p>

		<table class="table">
			<tr>
				<th><?php echo $this->BootstrapPaginator->sort('id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('user_id');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('controller');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('function');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('details');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('theid');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('url');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('data');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('ipaddr');?></th>
				<th><?php echo $this->BootstrapPaginator->sort('created');?></th>
				<th class="actions"><?php echo __('Actions');?></th>
			</tr>
		<?php foreach ($logs as $log): ?>
			<tr>
				<td><?php echo h($log['Log']['id']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['user_id']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['controller']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['function']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['details']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['theid']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['url']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['data']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['ipaddr']); ?>&nbsp;</td>
				<td><?php echo h($log['Log']['created']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $log['Log']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $log['Log']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $log['Log']['id']), null, __('Are you sure you want to delete # %s?', $log['Log']['id'])); ?>
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
			<li><?php echo $this->Html->link(__('New %s', __('Log')), array('action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>