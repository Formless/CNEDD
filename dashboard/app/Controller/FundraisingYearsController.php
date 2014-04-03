<?php
App::uses('AppController', 'Controller');
/**
 * FundraisingYears Controller
 *
 * @property FundraisingYear $FundraisingYear
 */
class FundraisingYearsController extends AppController {


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
		$this->FundraisingYear->recursive = 0;
		$this->set('fundraisingYears', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->FundraisingYear->id = $id;
		if (!$this->FundraisingYear->exists()) {
			throw new NotFoundException(__('Invalid %s', __('fundraising year')));
		}
		$this->set('fundraisingYear', $this->FundraisingYear->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FundraisingYear->create();
			$data = $this->request->data['FundraisingYear'];
			$year = $data['year'];
			$year = '01/01/' . $year;

			$year = date_parse($year);
			$data['year'] = $year;
			
			if ($this->FundraisingYear->save($data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('fundraising year')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('fundraising year')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
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
		$this->FundraisingYear->id = $id;
		if (!$this->FundraisingYear->exists()) {
			throw new NotFoundException(__('Invalid %s', __('fundraising year')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FundraisingYear->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('fundraising year')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('fundraising year')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->FundraisingYear->read(null, $id);
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
		$this->FundraisingYear->id = $id;
		if (!$this->FundraisingYear->exists()) {
			throw new NotFoundException(__('Invalid %s', __('fundraising year')));
		}
		if ($this->FundraisingYear->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('fundraising year')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('fundraising year')),
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
