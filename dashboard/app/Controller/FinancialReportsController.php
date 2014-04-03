<?php
App::uses('AppController', 'Controller');
/**
 * FinancialReports Controller
 *
 * @property FinancialReport $FinancialReport
 */
class FinancialReportsController extends AppController {


/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('TwitterBootstrap.BootstrapHtml', 'TwitterBootstrap.BootstrapForm', 'TwitterBootstrap.BootstrapPaginator');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Session');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FinancialReport->recursive = 0;
		$this->set('financialReports', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->FinancialReport->id = $id;
		if (!$this->FinancialReport->exists()) {
			throw new NotFoundException(__('Invalid %s', __('financial report')));
		}
		$this->set('financialReport', $this->FinancialReport->read(null, $id));
	}


/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->FinancialReport->id = $id;
		if (!$this->FinancialReport->exists()) {
			throw new NotFoundException(__('Invalid %s', __('financial report')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FinancialReport->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('financial report')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('financial report')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->FinancialReport->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->FinancialReport->id = $id;
		if (!$this->FinancialReport->exists()) {
			throw new NotFoundException(__('Invalid %s', __('financial report')));
		}
		if ($this->FinancialReport->delete($id, true)) {
			$this->Session->setFlash(
				__('The %s deleted', __('financial report')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('financial report')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}


	public function add($id = null) {
	    if($this->request->isPost()){
    	    	//this means something was POSTed
	    	if($this->data['submittedReport']['error'] > 0){
        	    $this->Session->setFlash( __('An error occured during upload.', true), 'default', array('class' => 'error-message'));
    	    	} else{
		    $fieldType = null;
		    $file = file($this->data['submittedReport']['tmp_name']);

		    if(strpos($this->data['submittedReport']['name'], '.csv') === false && 
			    strpos($this->data['submittedReport']['name'], '.CSV') === false) {
				    $this->Session->setFlash( __('An improper file type was submitted.', true), 'default', array('class' => 'error-message'));
				    $this->redirect(array('action' => 'add'));				    
		    }

		    $firstLine = $file[0];
		    $firstArray = explode(',', $firstLine);
		    $reportName = $firstArray[1];
		    $reportName = str_replace('"', "", $reportName);

		    $report_date = $this->request->data['FinancialReport']['report_date'];
		    $report_date = date_parse($report_date);

		    $this->FinancialReport->create();
		    $this->FinancialReport->set('name', $reportName);
		    $this->FinancialReport->set('report_date', $report_date);
		    $this->FinancialReport->save();
		    $reportId = $this->FinancialReport->id;

		    foreach(file($this->data['submittedReport']['tmp_name']) as $line){
			    $line = str_replace('"', "", $line);
			    $split = explode(',', $line);
			    if($split[0] === 'Income') { //reading income data
				$fieldType = 'income';
			    } else if($split[0] === 'Expense') { //reading expense data
				$fieldType = 'expense';
			    } else {
				$rowTitle = explode(" ", $split[0]);
				if (is_numeric($rowTitle[0])) { //is a field we care about
					$actualVal = $split[1];
					$budgetVal = $split[2];
					$nameArray = explode(" ", $split[0]);
					$nameSize = sizeof($nameArray);
					$name = $nameArray[0] . ":";
					for($i = 2; $i < $nameSize; $i++)
					{
						$name = $name . " " . $nameArray[$i];
				
					}
					$this->FinancialReport->FinancialRow->create();
					$this->FinancialReport->FinancialRow->set('row_name', $name);
					$this->FinancialReport->FinancialRow->set('type', $fieldType);
					$this->FinancialReport->FinancialRow->set('budget_value', $budgetVal);
					$this->FinancialReport->FinancialRow->set('actual_value', $actualVal);
					$this->FinancialReport->FinancialRow->set('financial_report_id', $reportId);
					$this->FinancialReport->FinancialRow->save();
			        }
                          }
			  
		    }
				$this->Session->setFlash(
					__('The %s has been saved', __('financial report')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'view', $reportId));
    	    	}
	    }
	}


    public function isAuthorized($user) {
	    // activated users can see view and index
	    if ((bool)($user['activated'] == 1 ) && in_array($this->action, array('view', 'index'))) {
		return true;
	    }

	    // Default AppController method
	    return parent::isAuthorized($user);
	}

}
