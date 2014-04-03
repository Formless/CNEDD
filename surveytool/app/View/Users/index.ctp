<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <h3><?php echo __('Actions'); ?></h3>
	            <ul>
	            </ul>
            </div>
            <div class="span10">
                <h2><?php echo __('Users'); ?></h2>
	            <table class="table table-striped">
                <tr>
		                <th><?php echo $this->Paginator->sort('id'); ?></th>
		                <th><?php echo $this->Paginator->sort('username'); ?></th>
		                <th><?php echo $this->Paginator->sort('openid'); ?></th>
		                <th><?php echo $this->Paginator->sort('admin'); ?></th>
		                <th><?php echo $this->Paginator->sort('created'); ?></th>
		                <th><?php echo $this->Paginator->sort('modified'); ?></th>
		                <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                <?php foreach ($users as $user): ?>
                <tr>
	                <td><?php echo h($user['User']['id']); ?>&nbsp;</td>
	                <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
	                <td><?php echo h($user['User']['openid']); ?>&nbsp;</td>
	                <td><?php echo h($user['User']['admin']); ?>&nbsp;</td>
	                <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
	                <td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
	                <td class="actions">
		                <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
		                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
		                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
	                </td>
                </tr>
                <?php endforeach; ?>
                </table>

	            <?php echo $this->Paginator->pagination(); ?>
            </div>
        </div>
    </div>
</body>
