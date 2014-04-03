<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail','Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {


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
		$this->User->recursive = 0;
-		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid %s', __('user')));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('user')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);

				$users = $this->User->find('all', array(
					'fields' => array('username'), 
					'conditions' => array('admin' => true)));

				
				foreach ($users as $user) {
					$email = new CakeEmail('gmail');
					$email->template('accountActivation', 'default');
				        $email->emailFormat('html');
					$email->to($user['User']['username']);
					$email->from('cneadmin@cnereports.org');
					$email->subject('New Dashboard User Created');
					$email->viewVars(array('id' => $this->User->id));
					$email->send();
			        }


				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('user')),
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
 * Easy function for setting a user to "active" which can be called from a button press from the Users view
 *
 * @param string $id id of the user to activate
 * @return void
 */
	public function activate($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid %s', __('user')));
		}
		$this->User->set('activated', true);
		if ($this->User->save()) {
			$this->Session->setFlash(
				__('The %s has been activated', __('user')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(
				__('The %s could not be saved. Please, try again.', __('user')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-error'
				)
			);
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid %s', __('user')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('user')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('user')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid %s', __('user')));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('user')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('user')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
	    $this->Auth->allow('login');
	    $this->Auth->allow('logout');
    }


    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
	    }
    }

	public function logout() {
	    $this->redirect($this->Auth->logout());
	}

    public function isAuthorized($user) {
	    // Everyone can add an account
	    if ($this->action === 'add') {
		return true;
	    }

	    return parent::isAuthorized($user);
	}


}
