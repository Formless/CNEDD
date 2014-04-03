<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    //...

    public $components = array(
        'Session',
        'DebugKit.Toolbar' => array('autoRun' => false), 
	    'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
	    'authorize' => array('Controller')),
	    'SQLLog'        
	//'RequestHandler'
    );

	public $helpers = array(
        'Session',
        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
    );	

    public function beforeFilter() {
	    $this->Auth->allow(array('controller' => 'pages', 'action' => 'display'));
	    $this->Auth->authError = "You are not authorized to access that page.";

	    $this->set('who', $this->Auth->user('username'));
	    $this->set('admin', $this->Auth->user('admin'));
	    $this->SQLLog->LogEvent();
    }

    public function isAuthorized($user) {
	    // Admin can access every action
	    if ((bool)($user['admin'] == 1 )) {
		return true;
	    }

	    // Default deny
	    return false;
	}	


}