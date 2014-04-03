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


/*
	Used to see if two organizations are equal when computing membership renewal
*/
function membershipEquals($first, $second) {
	if($first['org_name'] === $second['org_name']){
		return 0;
	}
	else return -1;
}


class ChartsController extends AppController {
    public $name = 'Charts';
    public $components = array('HighCharts.HighCharts');
    public $uses = array('FinancialReport', 'FinancialRow', 'MembershipReport', 'MembershipRow', 'FundraisingYear', 'FundraisingMonth');
	public $chartWidth = 600;
	public $chartHeight = 450;
    public $helpers = array(
	
		'Js' => array('Jquery')
	);

    public function view($id = null) {
	    if ($this->request->is('post') || $this->request->is('put')) { //Came from Analyze View (user set criteria)
	
	    } else { //Came From Workshops Page (shows results only for the given workshop)	
		    $year = date('Y');
		    $prevYear = $year - 1;

		    $currMembershipReport = $this->MembershipReport->find('all', array(
			    'conditions' => array('MembershipReport.report_date >=' => $year . '-01-01', 'MembershipReport.report_date <=' => $year . '-12-31'),
			    'order' => array('MembershipReport.report_date' => 'desc')));
		    $prevMembershipReport = $this->MembershipReport->find('all', array(
			    'conditions' => array('MembershipReport.report_date >=' => $prevYear . '-01-01', 
				    'MembershipReport.report_date <=' => $prevYear . '-12-31'),
			    'order' => array('MembershipReport.report_date' => 'desc')));

		    //debug($currMembershipReport); exit;

		    $currFinancialReport = $this->FinancialReport->find('first', array(
			    'order' => array('FinancialReport.report_date' => 'desc')));
		    $currFundraisingReport = $this->FundraisingYear->find('first', array(
			    'order' => array('FundraisingYear.year' => 'desc')));


		    $membershipTypeCount = $this->MembershipRow->find('all', array(
			    'fields' => array('MembershipRow.org_type', 'COUNT(*)'),
			    'conditions' => array('MembershipRow.membership_report_id' => $currMembershipReport[0]['MembershipReport']['id']),
			    'group' => array('MembershipRow.org_type')));


		    $membershipBudgetCount = $this->MembershipRow->find('all', array(
			    'fields' => array('MembershipRow.op_budget', 'COUNT(*)'),
			    'conditions' => array('MembershipRow.membership_report_id' => $currMembershipReport[0]['MembershipReport']['id']),
			    'group' => array('MembershipRow.op_budget')));

		    $membershipAreaCount = $this->MembershipRow->find('all', array(
			    'fields' => array('MembershipRow.area', 'COUNT(*)'),
			    'conditions' => array('MembershipRow.membership_report_id' => $currMembershipReport[0]['MembershipReport']['id']),
			    'group' => array('MembershipRow.area')));

		    $financialRevenue = $this->FinancialRow->findAllByTypeAndFinancialReportId('income', $currFinancialReport['FinancialReport']['id'], 
			    array('FinancialRow.row_name','FinancialRow.actual_value', 'FinancialRow.budget_value'));
		    $financialExpenses = $this->FinancialRow->findAllByTypeAndFinancialReportId('expense', $currFinancialReport['FinancialReport']['id'], 
			    array('FinancialRow.row_name','FinancialRow.actual_value', 'FinancialRow.budget_value'));


		    $memberType = $this->processMembershipCountData($membershipTypeCount, 'org_type');
		    $memberBudget = $this->processMembershipCountData($membershipBudgetCount, 'op_budget');
		    $memberArea = $this->processMembershipCountData($membershipAreaCount, 'area');

		    //debug($financialRevenue); exit;

		    $this->createCountPie($memberType, 'Membership By Type', 'membershipTypePie', 'Membership Type Distribution', 'Type Count');
		    $this->createCountPie($memberBudget, 'Membership Operating Budget Distribution', 'membershipBudgetPie', 
			    'Membership Operating Budget Distribution','Budget Count');
		    $this->createCountPie($memberArea, 'Membership By Area', 'membershipAreaPie', 'Membership Area Distribution', 'Area Count');

		    $this->createFinancialBar($financialRevenue, 'Revenue', 'financialRevenueBar', 'Revenue');
		    $this->createFinancialBar($financialExpenses, 'Expenses', 'financialExpensesBar', 'Expenses');
		    $this->createFundraisingBar($currFundraisingReport, 'Fundraising', 'fundraisingBar', 'Fundraising');
		
		    $this->createMembershipGrowthLine($currMembershipReport, $prevMembershipReport, $year, $prevYear);
		    $this->createMembershipRenewalLine($currMembershipReport, $prevMembershipReport, $year, $prevYear);
	    }
    }

/*
	Takes data and returns in form that is used by pie charts
*/
	private function processMembershipCountData($data, $field) {
		$countArray = array();
		foreach($data as $item) {
			$category = $item['MembershipRow'][$field];
			$value = $item[0]['COUNT(*)'];
			$countArray[$category] = $value;
		}
		return $countArray;
	}

	private function createMembershipRenewalLine($curr, $prev, $currYear, $prevYear){
		$currData = array(0, 0, 0, 0);
		$prevData = array(0, 0, 0, 0);

		foreach($curr as $report) {
			$date = date_parse($report['MembershipReport']['report_date']);
			$month = $date['month'];

			if($month == 1 || $month == 4 || $month == 7 || $month == 10) { //if the start of a new quarter, find last quarter
				$thisQuarterTime = strtotime($report['MembershipReport']['report_date']);
				$lastQuarterTime = strtotime('3 months ago', $thisQuarterTime);
				$lastQuarterDate = date('Y-m-d', $lastQuarterTime);

				$lastQuarterDate = date_parse($lastQuarterDate);
				$lastQuarterMonth = $lastQuarterDate['month'];
				$lastQuarterYear = $lastQuarterDate['year'];

			//Find report for last quarter
				$lastQuarter = $this->MembershipReport->find('first', array(
					'conditions' => array('MembershipReport.report_date >=' => $lastQuarterYear . '-'. $lastQuarterMonth .'-01', 
						'MembershipReport.report_date <=' => $lastQuarterYear . '-' . $lastQuarterMonth . '-31'),
					'order' => array('MembershipReport.report_date' => 'asc')));


			// intersects last quarter with this quarter to find how many people renewed, divides by total number from previous quarter to find percentage
				$intersect = array_uintersect_assoc($lastQuarter['MembershipRow'], $report['MembershipRow'], 'membershipEquals');

				$percentage = count($intersect) / count($lastQuarter['MembershipRow']);
				
				$currData[(int)($month / 3)] = $percentage;
			}

		}
		//repeat the above steps with the previous year
		foreach($prev as $report) {
			$date = date_parse($report['MembershipReport']['report_date']);
			$month = $date['month'];

			if($month == 1 || $month == 4 || $month == 7 || $month == 10) { //if the start of a new quarter
				$thisQuarterTime = strtotime($report['MembershipReport']['report_date']);
				$lastQuarterTime = strtotime('3 months ago', $thisQuarterTime);
				$lastQuarterDate = date('Y-m-d', $lastQuarterTime);

				$lastQuarterDate = date_parse($lastQuarterDate);
				$lastQuarterMonth = $lastQuarterDate['month'];
				$lastQuarterYear = $lastQuarterDate['year'];

				$lastQuarter = $this->MembershipReport->find('first', array(
					'conditions' => array('MembershipReport.report_date >=' => $lastQuarterYear . '-'. $lastQuarterMonth .'-01', 
						'MembershipReport.report_date <=' => $lastQuarterYear . '-' . $lastQuarterMonth . '-31'),
					'order' => array('MembershipReport.report_date' => 'asc')));


				$intersect = array_uintersect_assoc($lastQuarter['MembershipRow'], $report['MembershipRow'], 'membershipEquals');
				$percentage = count($intersect) / count($lastQuarter['MembershipRow']);
				
				$prevData[(int)($month / 3)] = $percentage;
			}

		}

		$chartName = 'MembershipRenewal';
        	$mychart = $this->HighCharts->create( $chartName, 'line' );
        	$this->HighCharts->setChartParams(
			$chartName,
			array(
				'renderTo'				=> 'renewalLine',  // div to display chart inside
				'chartWidth'				=> 600,
				'chartHeight'				=> 450,
				'chartAlignTicks'			=> FALSE,
				'title'					=> 'Membership Renewal',
				'legendEnabled' 			=> TRUE,
        			'tooltipEnabled' 			=> FALSE,
				'xAxisLabelsStep' 			=> 1,
				'xAxislabelsX' 				=> 5,
				'xAxisLabelsY' 				=> 20,
				'xAxisCategories'           		=> array('Q1', 'Q2', 'Q3', 'Q4'),
				'yAxisTitleText' 			=> 'Renewal Percentage',
				/* autostep options */
				'enableAutoStep' 			=> FALSE,
				'plotOptionsLineDataLabelsEnabled'	=> TRUE
			)
		);

        	$currSeries = $this->HighCharts->addChartSeries();
        	$prevSeries = $this->HighCharts->addChartSeries();

        	$currSeries->addName($currYear)
        	    ->addData($currData);
        	$prevSeries->addName($prevYear)
        	    ->addData($prevData);
	
        	$mychart->addSeries($prevSeries);
        	$mychart->addSeries($currSeries);
	}





	private function createMembershipGrowthLine($curr, $prev, $currYear, $prevYear){
		$currData = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
		$prevData = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

		foreach($curr as $report) {
			$date = date_parse($report['MembershipReport']['report_date']);
			$month = $date['month'];

			$currData[$month - 1] = count($report['MembershipRow']);
		}

		foreach($prev as $report) {
			$date = date_parse($report['MembershipReport']['report_date']);
			$month = $date['month'];

			$prevData[$month - 1] = count($report['MembershipRow']);
		}


		$chartName = 'MembershipGrowth';
        	$mychart = $this->HighCharts->create( $chartName, 'line' );
        	$this->HighCharts->setChartParams(
			$chartName,
			array(
				'renderTo'				=> 'growthLine',  // div to display chart inside
				'chartWidth'				=> 600,
				'chartHeight'				=> 450,
				'chartAlignTicks'			=> FALSE,
				'title'					=> 'Membership Growth',
				'legendEnabled' 			=> TRUE,
        			'tooltipEnabled' 			=> FALSE,
				'xAxisLabelsStep' 			=> 1,
				'xAxislabelsX' 				=> 5,
				'xAxisLabelsY' 				=> 20,
				'xAxisCategories'           		=> array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'),
				'yAxisTitleText' 			=> 'Membership',
				/* autostep options */
				'enableAutoStep' 			=> FALSE,
				'plotOptionsLineDataLabelsEnabled'	=> TRUE
			)
		);

    	$currSeries = $this->HighCharts->addChartSeries();
    	$prevSeries = $this->HighCharts->addChartSeries();

    	$currSeries->addName($currYear)
    	    ->addData($currData);
    	$prevSeries->addName($prevYear)
    	    ->addData($prevData);

    	$mychart->addSeries($prevSeries);
    	$mychart->addSeries($currSeries);
	}

	private function createFinancialBar($data, $chartName, $renderTo, $chartTitle){
		$actual = array();
		$budget = array();
		$catagories = array();
		$actual_total = 0;
		$budget_total = 0;

		foreach ($data as $info)
		{
			$field = $info['FinancialRow'];

			array_push($actual, intval($field['actual_value']));
			array_push($budget, intval($field['budget_value']));
			$actual_total += intval($field['actual_value']);
			$budget_total += intval($field['budget_value']);

			$row_name = $field['row_name'];
			$pivot = strpos($row_name, ':');
			array_push($catagories, substr($row_name, $pivot + 1));
		}
		array_push($actual, $actual_total);
		array_push($budget, $budget_total);
		array_push($catagories, 'Total');
		
    	$mychart = $this->HighCharts->create( $chartName, 'column');

    	$this->HighCharts->setChartParams (
                    $chartName,
                    array
                    (
                        'renderTo'                                  => $renderTo,  // div to display chart inside
                        'chartWidth'				=> 600,
                        'chartHeight'				=> 450,
                        //'chartBackgroundColorLinearGradient' 	=> array(0,0,0,300),
                        //'chartBackgroundColorStops'                 => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
                        'title'					=> $chartTitle,
                        'xAxisLabelsEnabled' 			=> TRUE,
                        'xAxisCategories'       	=> $catagories,
                        'yAxisTitleText' 		=> 'Amount',
                        'enableAutoStep' 		=> FALSE,
			'creditsEnabled'		=> FALSE,
                       // 'chartTheme'                => 'skies'
                    )
            );

    	$seriesOne = $this->HighCharts->addChartSeries();

    	$seriesOne->addName('Actual')
        		->addData($actual);

		$mychart->addSeries($seriesOne);

		$seriesTwo = $this->HighCharts->addChartSeries();

    	$seriesTwo->addName('Budget')
        		->addData($budget);

    	$mychart->addSeries($seriesTwo);
	}

	/*
	 * NOTE: $data is assumed to be formatted as <catagoryName> => <amount as string>.  For example, "Business" => "30"
	 */
    private function createCountPie($data, $chartName, $renderTo, $chartTitle, $seriesTitle) {
	    $chartData = array();
	    $index = 0;
	    foreach ($data as $key => $value){
		    if($key === 'NULL') {
			    $chartData[$index] = array('None Given', intval($value));
		    } else {
			    $chartData[$index] = array($key, intval($value));
		    }
		    $index++;
	    }

        $pieChart = $this->HighCharts->create( $chartName, 'pie' );

$dataLabelsFormatFunction =<<<EOF
function(){ return '<b>'+ this.point.name +'</b><br>'+ this.y;}
EOF;

        $this->HighCharts->setChartParams(
                                            $chartName,
                                            array
                                            (
                                                'renderTo'				=> $renderTo,  // div to display chart inside
                                                'chartWidth'				=> 600,
                                                'chartHeight'				=> 450,
                                                'title'					=> $chartTitle,
						'plotOptionsShowInLegend'		=> TRUE,
						'creditsEnabled' 			=> FALSE,
						'plotOptionsPieDataLabelsEnabled'	=> TRUE,
						'plotOptionsPieDataLabelsFormatter'	=> $dataLabelsFormatFunction
                                            )
        );

        $series = $this->HighCharts->addChartSeries();

        $series->addName($seriesTitle)
            ->addData($chartData);

        $pieChart->addSeries($series);
    }

	public function createFundraisingBar($current, $chartName, $renderTo, $chartTitle) {
		$currYear = $current['FundraisingYear']['year'];
		//corporate is spelled 'coporate' intentionally. We misspelled it in the database, didn't feel like changing it. Forgive us :(. The goals are saved as strings, we want them as floats
		$currGoal = array('Corporate' => floatval($current['FundraisingYear']['coporate_goal']),
			'MajorDonor' => floatval($current['FundraisingYear']['major_donor_goal']),
			'Foundation' => floatval($current['FundraisingYear']['foundation_goal']),
			'Pday' => floatval($current['FundraisingYear']['pday_goal']));

		$currOutstanding = array('Corporate' => 0, 'MajorDonor' => 0, 'Foundation' => 0, 'Pday' => 0);

		$currReceived = array('Corporate' => 0, 'MajorDonor' => 0, 'Foundation' => 0, 'Pday' => 0);

		$latestMonth = 0;
		
		//takes data from latest month, sets current outstanding and current received
		foreach($current['FundraisingMonth'] as $month) {
			//debug($month); exit;
			$date = date_parse($month['month']);
			if($date['month'] > $latestMonth) {
				$currOutstanding['Corporate'] = floatval($month['corporate_outstanding']);
				$currOutstanding['Foundation'] = floatval($month['foundation_outstanding']);
				$currOutstanding['MajorDonor'] = floatval($month['major_donor_outstanding']);
				$currOutstanding['Pday'] = floatval($month['pday_outstanding']);
				$currReceived['Corporate'] = floatval($month['coporate_recieved']);
				$currReceived['Foundation'] = floatval($month['foundation_recieved']);
				//we know received is spelled wrong as well. Sorry.
				$currReceived['MajorDonor'] = floatval($month['major_donor_recieved']);
				$currReceived['Pday'] = floatval($month['pday_received']);
				
				$latestMonth = $date['month'];
			}

		}
		//take the amount received, deduct it from goal to find the amount they still need to gather
		$currGoal['Corporate'] -= ($currOutstanding['Corporate'] + $currReceived['Corporate']);
		$currGoal['MajorDonor'] -= ($currOutstanding['MajorDonor'] + $currReceived['MajorDonor']);
		$currGoal['Foundation'] -= ($currOutstanding['Foundation'] + $currReceived['Foundation']);
		$currGoal['Pday'] -= ($currOutstanding['Pday'] + $currReceived['Pday']);

		//	debug($previous['FundraisingMonth']); exit;
		$latestMonth = 0;
		
		//setting the variables into the array for the bar graph
		$currentGoal = array($currGoal['Corporate'], $currGoal['MajorDonor'], $currGoal['Foundation'], $currGoal['Pday']);
		$currentOutstanding = array($currOutstanding['Corporate'], $currOutstanding['MajorDonor'], $currOutstanding['Foundation'], $currOutstanding['Pday']);
		$currentReceived = array($currReceived['Corporate'], $currReceived['MajorDonor'], $currReceived['Foundation'], $currReceived['Pday']);

    	$mychart = $this->HighCharts->create(
                    $chartName, 'column'
                );


        $this->HighCharts->setChartParams(
    	        $chartName,
            	array(
                	'renderTo'			=> $renderTo,  // div to display chart inside
                	'chartWidth'		=> 600,
                	'chartHeight'		=> 450,
                	'title'			=> $chartTitle,
                	'xAxisLabelsEnabled' 	=> TRUE,
                	'xAxisCategories'       	=> array( 'Corporate', 'Individual', 'Foundations', 'Pday' ),
                	'yAxisTitleText' 		=> 'Amount',
                	'enableAutoStep' 		=> FALSE,
               	'creditsEnabled'		=> FALSE,
		'plotOptionsSeriesStacking' => 'normal', // other options is 'percent'
            	)
    	);

        $currGoalSeries = $this->HighCharts->addChartSeries();
    	$currOutSeries = $this->HighCharts->addChartSeries();
		$currRecSeries = $this->HighCharts->addChartSeries();

		$curr = date_parse($current['FundraisingYear']['year']);

		$currOutSeries->addName($curr['year'] . ' Amount Pledged')
			->addData($currentOutstanding)
			->stack = $curr['year'];
    	$currGoalSeries->addName($curr['year'] . ' Remaining To Reach Goal')
			->addData($currentGoal)
			->stack = $curr['year'];
    	$currRecSeries->addName($curr['year'] . ' Received')
			->addData($currentReceived)
			->stack = $curr['year'];


    	$mychart->addSeries($currGoalSeries);
		$mychart->addSeries($currOutSeries);
		$mychart->addSeries($currRecSeries);
	}


	public function isAuthorized($user) {
	    // activated users can see view and index
	    if ((bool)($user['activated'] == 1 )) {
		return true;
	    }

	    // Default AppController method
	    return parent::isAuthorized($user);
	}
}
