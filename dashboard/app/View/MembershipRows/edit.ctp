<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('MembershipRow', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Edit %s', __('Membership Row')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('org_name');
				echo $this->BootstrapForm->input('org_type');
				echo $this->BootstrapForm->input('first_name');
				echo $this->BootstrapForm->input('last_name');
				echo $this->BootstrapForm->input('email');
				echo $this->BootstrapForm->input('ed');
				echo $this->BootstrapForm->input('op_budget');
				echo $this->BootstrapForm->input('area');
				echo $this->BootstrapForm->input('renew_date');
				echo $this->BootstrapForm->input('status');
				echo $this->BootstrapForm->input('membership_report_id');
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
			<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MembershipRow.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MembershipRow.id'))); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Membership Rows')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Membership Reports')), array('controller' => 'membership_reports', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Membership Report')), array('controller' => 'membership_reports', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>