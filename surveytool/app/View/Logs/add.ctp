<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('Log', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Add %s', __('Log')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('user_id');
				echo $this->BootstrapForm->input('controller');
				echo $this->BootstrapForm->input('function');
				echo $this->BootstrapForm->input('details');
				echo $this->BootstrapForm->input('theid');
				echo $this->BootstrapForm->input('url');
				echo $this->BootstrapForm->input('data');
				echo $this->BootstrapForm->input('ipaddr');
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Logs')), array('action' => 'index'));?></li>
		</ul>
		</div>
	</div>
</div>