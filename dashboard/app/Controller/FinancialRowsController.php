<?php
App::uses('AppController', 'Controller');
/**
 * FinancialRows Controller
 *
 * @property FinancialRow $FinancialRow
 */
class FinancialRowsController extends AppController {

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
		$this->FinancialRow->recursive = 0;
		$this->set('financialRows', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->FinancialRow->id = $id;
		if (!$this->FinancialRow->exists()) {
			throw new NotFoundException(__('Invalid %s', __('financial row')));
		}
		$this->set('financialRow', $this->FinancialRow->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FinancialRow->create();
			if ($this->FinancialRow->save($this->request->data)) {
				$this->flash(__('%s saved.', __('Financialrow')), array('action' => 'index'));
			} else {
			}
		}
		$financialReports = $this->FinancialRow->FinancialReport->find('list');
		$this->set(compact('financialReports'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->FinancialRow->id = $id;
		if (!$this->FinancialRow->exists()) {
			throw new NotFoundException(__('Invalid %s', __('financial row')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FinancialRow->save($this->request->data)) {
				$this->flash(__('The %s has been saved.', __('financial row')), array('action' => 'index'));
			} else {
			}
		} else {
			$this->request->data = $this->FinancialRow->read(null, $id);
		}
		$financialReports = $this->FinancialRow->FinancialReport->find('list');
		$this->set(compact('financialReports'));
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
		$this->FinancialRow->id = $id;
		if (!$this->FinancialRow->exists()) {
			throw new NotFoundException(__('Invalid %s', __('financial row')));
		}
		if ($this->FinancialRow->delete()) {
			$this->flash(__('%s deleted', __('Financial row')), array('action' => 'index'));
		}
		$this->flash(__('%s was not deleted', __('Financial row')), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}

    public function isAuthorized($user) {
	    // Admin can access every action
	    if ((bool)($user['activated'] == 1 ) && in_array($this->action, array('view', 'index'))) {
		return true;
	    }

	    // Default AppController method
	    return parent::isAuthorized($user);
	}

}
