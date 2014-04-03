<?php
App::uses('SetDisplayCountController', 'Controller');
class UsersController extends SetDisplayCountController {

    //Set OpenID as the user auth component, and make sure google apps emails like virginia.edu are allowed
    public $components = array('Openid' => array('accept_google_apps' => true));
    public $uses = array();
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
        $this->Auth->allow('manualLogin');
    }

    public function index() {
        parent::index();
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function manualLogin() {
	if ($this->request->is('post')) {
		if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash(__('Invalid username or password, try again'));
	        }
	}
    }

    public function login() {
	    $hostNameSplitFromPort = explode(":", $_SERVER['HTTP_HOST']);
        $realm = 'http://' . $hostNameSplitFromPort[0];
	    $returnTo = $realm . $this->webroot . 'users/login';
	    //$returnTo = $realm . '/~cnedd/surveytool/users/login';
        $OpenIdURL = 'https://www.google.com/accounts/o8/id';
        if (!$this->Openid->isOpenIDResponse()) {
            try {
                $this->makeOpenIDRequest($OpenIdURL, $returnTo, $realm);
            } catch (InvalidArgumentException $e) {
                $this->set('error', 'Invalid OpenID');
		        $this->Session->setFlash(__('An Invalid OpenID was supplied'));
		        $this->redirect(array('action' => 'index'));
            } catch (Exception $e) {
                $this->set('error', $e->getMessage());
		        $this->Session->setFlash(__("ERROR!:" . $e->getMessage()));
		        $this->redirect(array('action' => 'index'));
            }
        } else if ($this->Openid->isOpenIDResponse()) {
                $this->handleOpenIDResponse($returnTo);
        }
    }

    private function makeOpenIDRequest($openid, $returnTo, $realm) {
        $axSchema = 'axschema.org';
        $attributes[] = Auth_OpenID_AX_AttrInfo::make('http://'.$axSchema.'/contact/email', 1, true, 'ax_email');

        $this->Openid->authenticate($openid, $returnTo, $realm, array('ax' => $attributes));
    }

    private function handleOpenIDResponse($returnTo) {
        $response = $this->Openid->getResponse($returnTo);

        if ($response->status == Auth_OpenID_SUCCESS) {
            $axResponse = Auth_OpenID_AX_FetchResponse::fromSuccessResponse($response);
            if ($axResponse) {
                $emailArray = $axResponse->get('http://axschema.org/contact/email');
                $email = $emailArray[0];
            }           

	        $OpenIdURL = parse_url($response->identity_url);
       	    $OpenIdQuery = explode('=', $OpenIdURL['query']);
	        $OpenIdString = $OpenIdQuery[1];
            $user = $this->User->findByOpenid($OpenIdString);
            if ($user) {
                $this->Auth->login($user['User']);
	        $this->redirect($this->Auth->redirect());
            } else {
                // new user -> create user entry in the database
		        $newUser = array('User' => array('username' => $email, 'admin' => false,
                                    'openid' => $OpenIdString));
                $this->User->create();
                if ($this->User->save($newUser)) {
		            $this->Auth->login($newUser['User']);
                    $this->Session->setFlash(__('Welcome to the CNE Survey Tool!  Please Create a Password'));
                    $this->redirect(array('controller' => 'users', 'action' => 'edit', $this->User->id));
		        } else {
		            $this->Session->setFlash(__('An error occured when creating the new user'));
		            $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
		        }
            }
        }   
	    else {
	        $this->Session->setFlash(__('An error occured while accessing the account.  Please login manually using your username and password. ' . $response->message));
	        $this->redirect(array('controller' => 'users', 'action' => 'manualLogin'));
	    }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user) {

        return parent::isAuthorized($user);
    }
}
