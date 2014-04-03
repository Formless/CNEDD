<?php
App::uses('AppController', 'Controller');
/**
 * FundraisingMonths Controller
 *
 * @property FundraisingMonth $FundraisingMonth
 */
class FundraisingMonthsController extends AppController {


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
		$this->FundraisingMonth->recursive = 0;
		$this->set('fundraisingMonths', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->FundraisingMonth->id = $id;
		if (!$this->FundraisingMonth->exists()) {
			throw new NotFoundException(__('Invalid %s', __('fundraising month')));
		}
		$this->set('fundraisingMonth', $this->FundraisingMonth->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FundraisingMonth->create();

			$data = $this->request->data['FundraisingMonth'];
			$month = $data['month'];
			$month = str_replace(' ', '/', $month) . '01/13';
			$month = date_parse($month);
			$data['month'] = $month;

			//print_r($data);
			//exit;

			if ($this->FundraisingMonth->save($data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('fundraising month')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('fundraising month')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		}
		$fundraisingYears = $this->FundraisingMonth->FundraisingYear->find('list');
		$this->set(compact('fundraisingYears'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->FundraisingMonth->id = $id;
		if (!$this->FundraisingMonth->exists()) {
			throw new NotFoundException(__('Invalid %s', __('fundraising month')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FundraisingMonth->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('fundraising month')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('fundraising month')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->FundraisingMonth->read(null, $id);
		}
		$fundraisingYears = $this->FundraisingMonth->FundraisingYear->find('list');
		$this->set(compact('fundraisingYears'));
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
		$this->FundraisingMonth->id = $id;
		if (!$this->FundraisingMonth->exists()) {
			throw new NotFoundException(__('Invalid %s', __('fundraising month')));
		}
		if ($this->FundraisingMonth->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('fundraising month')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('fundraising month')),
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
