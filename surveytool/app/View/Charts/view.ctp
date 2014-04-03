<?php
/**
 *  CakePHP HighCharts Plugin
 * 
 * 	Copyright (C) 2012 Kurn La Montagne / destinydriven
 *	<https://github.com/destinydriven> 
 * 
 * 	Multi-licensed under:
 * 		MPL <http://www.mozilla.org/MPL/MPL-1.1.html>
 * 		LGPL <http://www.gnu.org/licenses/lgpl.html>
 * 		GPL <http://www.gnu.org/licenses/gpl.html>
 * 		Apache License, Version 2.0 <http://www.apache.org/licenses/LICENSE-2.0.html>
 */
?>

<?php 
    if(isset($noSurveys)) {
        echo '<p>There are no surveys that match this criteria.</p>';
    }
?>	

<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse"  href="#collapseAverages">
	Averages Graph
      </a>
    </div> <!-- Close Heading -->
    <div id="collapseAverages" class="accordion-body collapse in">
      <div class="accordion-inner">
        <div class="AveragesChart">

            <div id="averagewrapper" style="display: block; float: left; width:90%; margin-bottom: 20px;"></div>

                <div class="clear"></div>	
	
                <?php echo $this->HighCharts->render('Averages'); ?>

        </div> <!-- Close Chart -->
      </div> <!-- Close Inner --> 
    </div> <!-- Close Collapse -->
  </div> <!--Close Group -->
  <?php if(isset($renderExpectationsBar)) { ?>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" href="#collapseExpectations">
        Expectations Graph
      </a>
    </div> <!--Close Heading -->
    <div id="collapseExpectations" class="accordion-body collapse">
      <div class="accordion-inner">
        
	    <div class="ExpectationsChart">

	        <div id="expectwrapper" style="display: block; float: left; width:90%; margin-bottom: 20px;"></div>
	        <div class="clear"></div>	
	
	        <?php echo $this->HighCharts->render('Expectations'); ?>

	
	    </div> <!-- Close Chart -->
      </div> <!-- Close Inner -->
    </div> <!-- Close Collapse -->
  </div> <!-- Close Group -->
  <?php } ?>
  <?php if(isset($renderAttendanceLine)) { ?>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse"  href="#collapseAttendance">
        Attendance Graph
      </a>
    </div> <!-- Close Heading-->
    <div id="collapseAttendance" class="accordion-body collapse">
      <div class="accordion-inner">
        
	
	<div class="AttendanceChart">

    	    <div id="linewrapper" style="display: block; float: left; width:90%; margin-bottom: 20px;"></div>
	    <div class="clear"></div>	
	
	    <?php echo $this->HighCharts->render('Attendance By Month'); ?>

	</div> <!-- Close Graph -->
      </div> <!-- Close Inner -->
    </div><!-- Close Collapse -->
  </div> <!-- Close Group -->
  <?php } ?>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse"  href="#collapseTraining">
	Training Source Graph
      </a>
    </div> <!-- Close Heading-->
    <div id="collapseTraining" class="accordion-body collapse">
      <div class="accordion-inner">
        <div class="trainingSourceChart">

      	  <div id="columnwrapper" style="display: block; float: left; width:90%; margin-bottom: 20px;"></div>

    	  <div class="clear"></div>	

	

    	  <?php echo $this->HighCharts->render('Training Source'); ?>



        </div> <!-- Close Graph-->
      </div> <!-- Close Inner-->
    </div> <!-- Close Collapse -->
  </div> <!-- Close Group -->
</div> <!-- Close Accordion -->


