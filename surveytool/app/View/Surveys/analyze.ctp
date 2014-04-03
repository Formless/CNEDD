<?php ?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span10">
                <div id="analyze_criteria">
                <?php 
	                echo $this->Form->create('SurveyGroup', array('url' => array('controller' => 'charts', 'action' => 'view')));
	                echo $this->Form->input('surveyNames', array('default' => 'Any', 'empty' => 'Any', 'label' => 'Training Name'));
			$types = array('Brown Bag' => 'Brown Bag Lunch', 'Workshop' => 'Workshop', 'Info Session' => 'Info Session', 'Series' => 'Series', 'Tech Series' => 'Tech Series', 'Other' => 'Other'); 	                
			echo $this->Form->input('surveyTypes', array('options' => $types, 'default' => 'Any', 'empty' => 'Any', 'label' => 'Training Type'));
	                echo $this->Form->input('surveyInstructors', array('default' => 'Any', 'empty' => 'Any', 'label' => 'Instructor'));
	                echo $this->Form->input('surveyLocations', array('default' => 'Any', 'empty' => 'Any', 'label' => 'Location'));
	                echo $this->Form->input('startDate', array('class' => 'datepicker', 'default' => 'Any', 'empty' => 'Any', 'label' => 'Earliest Date'));
	                echo $this->Form->input('endDate', array('class' => 'datepicker', 'default' => 'Any', 'empty' => 'Any', 'label' => 'Latest Date'));
	                echo $this->Form->end(array('label' => 'Analyze', 'class' => 'btn btn-inverse'));
                ?>
	                <!--<?php
		                echo $this->Js->submit('Analyze', array(
			                'update' => '#analysis_results',
			                'method' => 'POST'
		                ));
	                ?>-->
                </div>
                <!--
                <div id="analysis_results">
	                <p>Press submit above to see results</p>
                </div>
                -->
            </div>
        </div>
    </div>
</body>
