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
class ChartsController extends AppController {
    public $name = 'Charts';
    public $components = array('HighCharts.HighCharts');
    public $uses = array('Survey', 'SurveyGroup');
	public $chartWidth = 600;
	public $chartHeight = 450;
    public $helpers = array(
	
		'Js' => array('Jquery')
	);

    public function view($id = null) {
	$surveyNames = $this->Survey->SurveyGroup->find('list', array('fields' => 'SurveyGroup.name'));
	$surveyNames = array_unique($surveyNames);

	$surveyTypes = $this->Survey->SurveyGroup->find('list', array('fields' => 'SurveyGroup.type'));
	$surveyTypes = array_unique($surveyTypes);

	$surveyInstructors = $this->Survey->SurveyGroup->find('list', array('fields' => 'SurveyGroup.instructor'));
	$surveyInstructors = array_unique($surveyInstructors);

	$surveyLocations = $this->Survey->SurveyGroup->find('list', array('fields' => 'SurveyGroup.location'));
	$surveyLocations = array_unique($surveyLocations);

	$fields = array('SurveyGroup.attendance', 'SurveyGroup.date', 'SurveyGroup.type');

	if ($this->request->is('post') || $this->request->is('put')) { //Came from Analyze View (user set criteria)
		$name = $this->request->data['SurveyGroup']['surveyNames'];
		$type = $this->request->data['SurveyGroup']['surveyTypes'];
		$instructor = $this->request->data['SurveyGroup']['surveyInstructors'];
		$location = $this->request->data['SurveyGroup']['surveyLocations'];
		$startDate = $this->request->data['SurveyGroup']['startDate'];
		$endDate = $this->request->data['SurveyGroup']['endDate'];

		$conditions = array();
		if($name != NULL) {
			$conditions["SurveyGroup.name"] = $surveyNames[$name];
		}
		if($type != NULL) {
			$conditions["SurveyGroup.type"] = $type;
		}
		if($instructor != NULL) {
			$conditions["SurveyGroup.instructor"] = $surveyInstructors[$instructor];
		}
		if($location != NULL) {
			$conditions["SurveyGroup.location"] = $surveyLocations[$location];
		}
		if($startDate != 'Any' && $startDate !== null) {
			$start = date_parse($startDate);
			$startDatestring=$start['year'] . '-' . $start['month'] . '-' . $start['day'];
			$conditions["SurveyGroup.date >=" ] = $startDatestring;
		}
		if($endDate !== 'Any' && $endDate != null ) {
			$end = date_parse($endDate);
			$endDatestring=$end['year'] . '-' . $end['month'] . '-' . $end['day'];
			$conditions["SurveyGroup.date <=" ] = $endDatestring;
		}
		


		if($type == null && $name == null) {
			$this->set('renderExpectationsBar', true);	
		}
		if($name == null) {
			$this->set('renderAttendanceLine', true);	
		}	
		
		$result = $this->SurveyGroup->find('all', array('conditions' => $conditions, 'fields' => $fields));
	} else { //Came From Workshops Page (shows results only for the given workshop)
		$this->SurveyGroup->id = $id;
		if (!$this->SurveyGroup->exists()) {
			throw new NotFoundException(__('Invalid survey group'));
		}
		$conditions = array('SurveyGroup.survey_group_id' => $id);
		$result = $this->SurveyGroup->find('all', array('conditions' => $conditions, 'fields' => $fields));
	}

	$averages = $this->processQuery($result);
	$this->averagesBar($averages);
	$monthAttendance = $this->getAttendanceData($result);
	$this->attendanceLine($monthAttendance);
	$trainingSourceData = $this->getTrainingSourceData($result);
	$this->trainingSourceBar($trainingSourceData);
	$expectationData = $this->getExpectationData($result);
	$this->expectationsBar($expectationData);

    }
	/*
	Computes the averages of the four Likert scale questions, and places them in an array
	for a bar graph
	*/
    private function processQuery($results) {
	    if(count($results) <= 0) {
		    echo '<p>There are no surveys that match those criteria.';
		    exit;
	    }
	    $averages = array(0, 0, 0, 0);
	    $surveySum = 0;
	    //print_r($results);
	    //exit;
	    foreach($results as $surveyGroup) {
		    $surveySum += count($surveyGroup['Survey']);
		    foreach($surveyGroup['Survey'] as $survey) {
			    $averages[0] += $survey['expectations'];
			    $averages[1] += $survey['interactivity'];
			    $averages[2] += $survey['new_ideas'];
			    $averages[3] += $survey['exposure'];
		    }
	    }
	
	    if($surveySum <= 0) {
		    $this->set('noSurveys', true);
	    } else {

		    $averages[0] /= $surveySum;
		    $averages[1] /= $surveySum;
		    $averages[2] /= $surveySum;
		    $averages[3] /= $surveySum;

	    }
	    return $averages;
    }
	/*
	Computes the average 'meets expectations' value, divides by training type, puts it in an array
	*/
    private function getExpectationData($results) {
	    if(count($results) <= 0) return;
		    $expectData = array (0, 0, 0, 0, 0, 0);
		
		    $surveySum = array("brownbag"=>0,"workshop"=>0,"infosession"=>0,"series"=>0, "techseries" => 0, "other" => 0);
	    foreach($results as $surveyGroup) {
		    $expectationSum = 0;

		    foreach($surveyGroup['Survey'] as $survey){
			    $expectationSum += $survey['expectations'];
		    }	

	        if($surveyGroup['SurveyGroup']['type'] === 'Brown Bag'){
		        $expectData[0] += $expectationSum;
		        $surveySum["brownbag"] += count($surveyGroup['Survey']);
	        }if($surveyGroup['SurveyGroup']['type'] === 'Workshop'){
		        $expectData[1] += $expectationSum;
		        $surveySum["workshop"] += count($surveyGroup['Survey']);
	        }if($surveyGroup['SurveyGroup']['type'] === 'Info Session'){
		        $expectData[2] += $expectationSum;
		        $surveySum["infosession"] += count($surveyGroup['Survey']);
	        }if($surveyGroup['SurveyGroup']['type'] === 'Tech Series'){
		        $expectData[4] += $expectationSum;
		        $surveySum["techseries"] += count($surveyGroup['Survey']);
	        }else if($surveyGroup['SurveyGroup']['type'] === 'Series'){
		        $expectData[3] += $expectationSum;
		        $surveySum["series"] += count($surveyGroup['Survey']);
	        }else if($surveyGroup['SurveyGroup']['type'] === 'Other'){
		        $expectData[5] += $expectationSum;
		        $surveySum["other"] += count($surveyGroup['Survey']);
	        }

        }
	    if($surveySum["brownbag"] != 0){$expectData[0]/=$surveySum["brownbag"];}
	    if($surveySum["workshop"] != 0){$expectData[1]/=$surveySum["workshop"];}
	    if($surveySum["infosession"] != 0){$expectData[2]/=$surveySum["infosession"];}
	    if($surveySum["series"] != 0){$expectData[3]/=$surveySum["series"];}
	    if($surveySum["techseries"] != 0){$expectData[4]/=$surveySum["techseries"];}
	    if($surveySum["other"] != 0){$expectData[4]/=$surveySum["other"];}

	    return $expectData;
    }

	/*
	Gets attendance by month, puts it in an array for a line graph
	*/
    private function getAttendanceData($results) {
	    if(count($results) <= 0) return;
	    $monthAttendance = array (0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

	    foreach($results as $survey) {
		    $date = date_parse($survey['SurveyGroup']['date']);
		    $month = $date['month'];
		    $monthAttendance[$month - 1] += $survey['SurveyGroup']['attendance'];
	    }
	    return $monthAttendance;
    }

	/*
	Organizes the number of responses for each source type
	*/
    private function getTrainingSourceData($results) {
	    if(count($results) <= 0) return;
	    $trainingSourceCount = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	    foreach($results as $surveyGroup) {
		    foreach($surveyGroup['Survey'] as $survey) {
			    $trainingSourceStr = $survey['training_source'];
			    for($i = 0; $i < 10; $i++) {
				    $bit = substr($trainingSourceStr, $i, 1);
				    if($bit === '1') {
					    $trainingSourceCount[9 - $i]++;
				    }
			    }
		    }
	    }
	    return $trainingSourceCount;
    }
	/*
	For examples on how to use the Highcharts plugin, please visit https://github.com/destinydriven/cakephp-high-charts-plugin . 
	*/
    private function attendanceLine($attendance) {
        $chartName = 'Attendance By Month';

        // anonymous Callback function to format the text of the tooltip
        $tooltipFormatFunction =<<<EOF
function(){ return this.x +': '+ this.y +' Attendees';}
EOF;

        $mychart = $this->HighCharts->create( $chartName, 'line' );

        $this->HighCharts->setChartParams(
                        $chartName,
                        array (
                                'renderTo'				=> 'linewrapper',  // div to display chart inside
                                'chartWidth'				=> 600,
                                'chartHeight'				=> 450,
                                'chartMarginTop' 			=> 60,
                                'chartMarginLeft'			=> 90,
                                'chartMarginRight'			=> 30,
                                'chartMarginBottom'			=> 110,
                                'chartSpacingRight'			=> 10,
                                'chartSpacingBottom'			=> 15,
                                'chartSpacingLeft'			=> 0,
                                'chartAlignTicks'			=> FALSE,
                                //'chartTheme'                            => 'dark-green',

                                'title'					=> 'Monthly Training Attendance',
                                'titleAlign'				=> 'center',
                                'titleFloating'				=> TRUE,
                                'titleStyleFont'			=> '18px Metrophobic, Arial, sans-serif',
                                'titleStyleColor'			=> '#0099ff',
                                'titleX'				=> 20,
                                'titleY'				=> 10,

                                'legendEnabled' 			=> FALSE,
                                'legendLayout'				=> 'horizontal',
                                'legendAlign'				=> 'center',
                                'legendVerticalAlign '			=> 'bottom',
                                'legendItemStyle'			=> array('color' => '#222'),
                                'legendBackgroundColorLinearGradient' 	=> array(0,0,0,25),
                                'legendBackgroundColorStops' 		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                                'tooltipEnabled' 			=> TRUE,
                                'tooltipFormatter'			=> $tooltipFormatFunction,

                                'xAxisLabelsEnabled' 			=> TRUE,
                                'xAxisLabelsAlign' 			=> 'right',
                                'xAxisLabelsStep' 			=> 1,
                                'xAxislabelsX' 				=> 5,
                                'xAxisLabelsY' 				=> 20,
                                'xAxisCategories'           		=> array( 'Jan', 'Feb', 'Mar','Apr', 'May','Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ),

                                'yAxisTitleText' 			=> 'Attendance',

                                'plotOptionsLineDataLabelsEnabled' 	=> TRUE,
                                'plotOptionsLineEnableMouseTracking' 	=> TRUE,

                                /* autostep options */
                                'enableAutoStep' 			=> FALSE
                        )

            );

        $series1 = $this->HighCharts->addChartSeries();

        $series1->addData($attendance);

        $mychart->addSeries($series1);


	}

    public function trainingSourceBar($trainingSourceData) {
        $chartName = 'Training Source';

        $mychart = $this->HighCharts->create( $chartName, 'column');

        $this->HighCharts->setChartParams (
                        $chartName,
                        array
                        (
                            'renderTo'                                  => 'columnwrapper',  // div to display chart inside
                            'chartWidth'				=> 600,
                            'chartHeight'				=> 450,
                            //'chartBackgroundColorLinearGradient' 	=> array(0,0,0,300),
                            //'chartBackgroundColorStops'                 => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
                            'title'					=> 'Training Source Distribution',
                            'subtitle'                                  => 'Where did trainees hear about the training?',
                            'xAxisLabelsEnabled' 			=> TRUE,
                            'xAxisCategories'       	=> array( 'C-ville Weekly', 'CNE Website', 'Hook', 'C-Ville Calendar', 
			    					'Facebook', 'Daily Progress', 'Chamber Bits', 'LinkedIn', 'CNE Newsletter',
								'Other'),
                            'yAxisTitleText' 		=> 'Frequency',
                            'enableAutoStep' 		=> FALSE,
                            'creditsEnabled'		=> FALSE,
                           // 'chartTheme'                => 'skies'
                        )
                );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Training Sources')
            ->addData($trainingSourceData);

        $mychart->addSeries($series);
    }

    public function expectationsBar($expectationData) {
        $chartName = 'Expectations';

        $mychart = $this->HighCharts->create( $chartName, 'column');

        $this->HighCharts->setChartParams (
                        $chartName,
                        array
                        (
                            'renderTo'                                  => 'expectwrapper',  // div to display chart inside
                            'chartWidth'				=> 600,
                            'chartHeight'				=> 450,
                            //'chartBackgroundColorLinearGradient' 	=> array(0,0,0,300),
                            //'chartBackgroundColorStops'                 => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
                            'title'					=> 'Expectations By Training Type',
                            'subtitle'                                  => 'How much did trainees expect to get out of this training session?',
                            'xAxisLabelsEnabled' 			=> TRUE,
                            'xAxisCategories'       	=> array( 'Brown Bag Lunch', 'Workshop', 'Info Session', 
								'Series', 'Tech Series', 'Other'),
                            'yAxisTitleText' 		=> 'LikeRT Value',
                            'enableAutoStep' 		=> FALSE,
                            'creditsEnabled'		=> FALSE,
                           // 'chartTheme'                => 'skies'
                        )
                );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Expectations')
            ->addData($expectationData);

        $mychart->addSeries($series);
    }

    public function averagesBar($averages) {
        $chartName = 'Averages';

        $mychart = $this->HighCharts->create( $chartName, 'column');

        $this->HighCharts->setChartParams (
                        $chartName,
                        array
                        (
                            'renderTo'                                  => 'averagewrapper',  // div to display chart inside
                            'chartWidth'				=> 600,
                            'chartHeight'				=> 450,
                            //'chartBackgroundColorLinearGradient' 	=> array(0,0,0,300),
                            //'chartBackgroundColorStops'                 => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
                            'title'					=> 'Average Survey Values',
                            'xAxisLabelsEnabled' 			=> TRUE,
                            'xAxisCategories'       	=> array( 'Expectations', 'Interactivity', 'New Ideas', 
								'Exposure'),
                            'yAxisTitleText' 		=> 'LikeRT Value',
                            'enableAutoStep' 		=> FALSE,
                            'creditsEnabled'		=> FALSE,
                           // 'chartTheme'                => 'skies'
                        )
                );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Averages')
            ->addData($averages);

        $mychart->addSeries($series);
    }

}
