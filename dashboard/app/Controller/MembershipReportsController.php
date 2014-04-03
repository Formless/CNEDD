<?php
App::uses('AppController', 'Controller');
/**
 * MembershipReports Controller
 *
 * @property MembershipReport $MembershipReport
 */
class MembershipReportsController extends AppController {


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
		$this->MembershipReport->recursive = 0;
		$this->set('membershipReports', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->MembershipReport->id = $id;
		if (!$this->MembershipReport->exists()) {
			throw new NotFoundException(__('Invalid %s', __('membership report')));
		}

		$this->set('membershipReport', $this->MembershipReport->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
	    if($this->request->isPost()){
    	    	//this means something was POSTed
	    	if($this->data['submittedReport']['error'] > 0){
        	    $this->Session->setFlash( __('An error occured during upload.', true), 'default', array('class' => 'error-message'));
    	    	} else{

		    if(strpos($this->data['submittedReport']['name'], '.csv') === false && 
			    strpos($this->data['submittedReport']['name'], '.CSV') === false) {
				    $this->Session->setFlash( __('An improper file type was submitted.', true), 'default', array('class' => 'error-message'));
				    $this->redirect(array('action' => 'add'));				    
		    }


		    $report_date = $this->request->data['MembershipReport']['report_date'];
		    $report_date = date_parse($report_date);
		    $this->MembershipReport->create();
		    $this->MembershipReport->set('report_date', $report_date);
		    if(!$this->MembershipReport->save()){
			print_r($this->MembershipReport->validationErrors);
			exit;
		    }
		    $reportId = $this->MembershipReport->id;

		    foreach(file($this->data['submittedReport']['tmp_name']) as $line){
			    $split = str_getcsv ( $line, ',', '"' , $escape = '\\' );
			    
			    if($split[0] === 'Org Name') continue; 
				

			   
					$orgName = $split[0];
					$orgType = $split[1];
					$first_name = $split[2];
					$last_name = $split[3];
					$email = $split[4];
					if($email === 'NULL') $email = "";
					$ed = $split[5];
					$op_budget = $split[6];
					$area = $split[7];
					$renewDate_preParse = $split[8];
					$renewDate = date_parse($renewDate_preParse);
					$status = $split[9];
					
					$this->MembershipReport->MembershipRow->create();
					$this->MembershipReport->MembershipRow->set('org_name', $orgName);
					$this->MembershipReport->MembershipRow->set('org_type', $orgType);
					$this->MembershipReport->MembershipRow->set('first_name', $first_name);
					$this->MembershipReport->MembershipRow->set('last_name', $last_name);
					$this->MembershipReport->MembershipRow->set('email', $email);
					$this->MembershipReport->MembershipRow->set('ed', $ed);
					$this->MembershipReport->MembershipRow->set('op_budget', $op_budget);
					$this->MembershipReport->MembershipRow->set('area', $area);
					$this->MembershipReport->MembershipRow->set('renew_date', $renewDate);
					$this->MembershipReport->MembershipRow->set('status', $status);
					$this->MembershipReport->MembershipRow->set('membership_report_id', $reportId);


					if(!$this->MembershipReport->MembershipRow->save())
					{
						echo '<p>';
						echo $orgType;
						echo '</p>';
						echo '<p>';
						echo $email;
						echo '</p>';
						echo '<p>';
						echo $op_budget;
						echo '</p>';
						echo '<p>';
						echo $area;
						echo '</p>';
						echo '<p>';
						print_r($renewDate);
						echo '</p>';
						echo '<p>';
						echo $status;
						echo '</p>';
						print_r($this->MembershipReport->MembershipRow->validationErrors);
						exit;
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

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->MembershipReport->id = $id;
		if (!$this->MembershipReport->exists()) {
			throw new NotFoundException(__('Invalid %s', __('membership report')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MembershipReport->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('membership report')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('membership report')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->MembershipReport->read(null, $id);
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
		$this->MembershipReport->id = $id;
		if (!$this->MembershipReport->exists()) {
			throw new NotFoundException(__('Invalid %s', __('membership report')));
		}
		if ($this->MembershipReport->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('membership report')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('membership report')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
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
