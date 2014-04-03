<?php
App::uses('AppController', 'Controller');
/**
 * MembershipRows Controller
 *
 * @property MembershipRow $MembershipRow
 */
class MembershipRowsController extends AppController {



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

	public $paginate = array('fields' => array(
		'MembershipRow.org_name',
		'MembershipRow.org_type',
		'MembershipRow.first_name',
		'MembershipRow.last_name',
		'MembershipRow.email',
		'MembershipRow.ed',
		'MembershipRow.op_budget',
		'MembershipRow.area',
		'MembershipRow.renew_date',
		'MembershipRow.status',
		'MembershipRow.id',
		'MembershipRow.created',
		'MembershipRow.modified',
		'MembershipReport.id',
		'MembershipReport.report_date'));
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MembershipRow->recursive = 0;
		$this->set('membershipRows', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->MembershipRow->id = $id;
		if (!$this->MembershipRow->exists()) {
			throw new NotFoundException(__('Invalid %s', __('membership row')));
		}
		$this->set('membershipRow', $this->MembershipRow->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MembershipRow->create();
			if ($this->MembershipRow->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('membership row')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('membership row')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$membershipReports = $this->MembershipRow->MembershipReport->find('list');
		$this->set(compact('membershipReports'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->MembershipRow->id = $id;
		if (!$this->MembershipRow->exists()) {
			throw new NotFoundException(__('Invalid %s', __('membership row')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MembershipRow->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('membership row')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('membership row')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->MembershipRow->read(null, $id);
		}
		$membershipReports = $this->MembershipRow->MembershipReport->find('list');
		$this->set(compact('membershipReports'));
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
		$this->MembershipRow->id = $id;
		if (!$this->MembershipRow->exists()) {
			throw new NotFoundException(__('Invalid %s', __('membership row')));
		}
		if ($this->MembershipRow->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('membership row')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('membership row')),
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
