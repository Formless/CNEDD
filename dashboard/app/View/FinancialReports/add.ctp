<div class="row-fluid">
	<div class="span9">
		<?php echo $this->BootstrapForm->create('FinancialReport', array('type' => 'file', 'class' => 'form-horizontal')); ?>
	                <fieldset>
		                <legend><?php echo __('Upload Financial Report'); ?></legend>
	                <?php
				echo $this->Form->input('submittedReport', array('type' => 'file', 'label' => 'Financial Report',
					'required' => 'required', 
					//'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;'
				));
				echo $this->BootstrapForm->input('report_date', array('class' => 'datepicker', 'type' => 'text', 
					'required' => 'required',
					//'helpInline' => '<span class="label label-important">' . __('Required') . '</span>&nbsp;',
					'data-date-viewmode' => 'months', 'data-date-minviewmode' => 'months', 'data-date-format' => 'mm/yyyy' ));
	                ?>
	                </fieldset>
                <?php echo $this->Form->end(array('label' => 'Upload', 'class' => 'btn btn-inverse')); ?>
	</div>
	<div class="span3">
		<div class="well" style="padding: 8px 0; margin-top:8px;">
		<ul class="nav nav-list">
			<li class="nav-header"><?php echo __('Actions'); ?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Reports')), array('action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List %s', __('Financial Rows')), array('controller' => 'financial_rows', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New %s', __('Financial Row')), array('controller' => 'financial_rows', 'action' => 'add')); ?></li>
		</ul>
		</div>
	</div>
</div>
