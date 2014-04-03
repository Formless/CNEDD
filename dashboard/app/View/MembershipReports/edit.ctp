<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('MembershipReport', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('Membership Report')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('report_date');
				echo $this->BootstrapForm->hidden('id');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MembershipReport.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MembershipReport.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Membership Reports')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Membership Rows')), array('controller' => 'membership_rows', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Membership Row')), array('controller' => 'membership_rows', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>