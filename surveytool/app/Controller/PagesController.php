<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

protected static $INSTRUCTIONS_CREATE_PARTIALPATH = "/app/Instructions/Create.html";
protected static $INSTRUCTIONS_UPLOAD_PARTIALPATH = "/app/Instructions/Upload.html";
protected static $INSTRUCTIONS_ANALYZE_PARTIALPATH = "/app/Instructions/Analyze.html";

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
        $this->set('who', $this->Auth->user('username'));
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		
		//Display the instructions on the front page
		$this->loadInstructions();
		
		
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
	
/**
 * Loads instruction html files in app/Instructions
 *
 * @return void
 */	
	private function loadInstructions() {
	    $createText = "Put instructions in " . self::$INSTRUCTIONS_CREATE_PARTIALPATH;
	    $uploadText = "Put instructions in " . self::$INSTRUCTIONS_UPLOAD_PARTIALPATH;
	    $analyzeText = "Put instructions in " . self::$INSTRUCTIONS_ANALYZE_PARTIALPATH;
	    
		if (file_exists(ROOT . self::$INSTRUCTIONS_CREATE_PARTIALPATH)){
            $createText = file_get_contents(ROOT . self::$INSTRUCTIONS_CREATE_PARTIALPATH);
        }
		if (file_exists(ROOT . self::$INSTRUCTIONS_UPLOAD_PARTIALPATH)){
            $uploadText = file_get_contents(ROOT . self::$INSTRUCTIONS_UPLOAD_PARTIALPATH);
        }
		if (file_exists(ROOT . self::$INSTRUCTIONS_ANALYZE_PARTIALPATH)){
            $analyzeText = file_get_contents(ROOT . self::$INSTRUCTIONS_ANALYZE_PARTIALPATH);
        }
        
        $this->set('createInstructions', $createText);
        $this->set('uploadInstructions', $uploadText);
        $this->set('analyzeInstructions', $analyzeText);
    }

/**
 * Anyone should be allowed to access the static pages
 */
    public function isAuthorized($user) {
        return true;
    }
}