<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('FundraisingMonth', array('class' => 'form-horizontal'));?>
			<fieldset>
				<legend><?php echo __('Add %s', __('Fundraising Month')); ?></legend>
				<?php
				echo $this->BootstrapForm->input('fundraising_year_id');
				echo $this->BootstrapForm->input('month', array(
					'class' => 'monthpicker', 'type' => 'text', 
					'data-date-viewmode' => 'months', 'data-date-minviewmode' => 'months', 'data-date-format' => 'mm'));
				echo $this->BootstrapForm->input('coporate_recieved', array('label'=> 'Corporate Received'));
				echo $this->BootstrapForm->input('corporate_outstanding', array('label'=>'Corporate Pledged'));
				echo $this->BootstrapForm->input('major_donor_recieved', array('label'=>'Individual Received'));
				echo $this->BootstrapForm->input('major_donor_outstanding', array('label'=> 'Individual Pledged'));
				echo $this->BootstrapForm->input('foundation_recieved', array('label' => 'Foundations Received'));
				echo $this->BootstrapForm->input('foundation_outstanding', array('label' => 'Foundations Pledged'));
				echo $this->BootstrapForm->input('pday_received');
				echo $this->BootstrapForm->input('pday_outstanding', array('label' => 'Pday Pledged'));
				?>
				<?php echo $this->BootstrapForm->submit(__('Submit'));?>
			</fieldset>
		<?php echo $this->BootstrapForm->end();?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Months')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Fundraising Years')), array('controller' => 'fundraising_years', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Fundraising Year')), array('controller' => 'fundraising_years', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>
