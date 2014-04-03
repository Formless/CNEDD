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

protected static $INSTRUCTIONS_FINANCIAL_PARTIALPATH = "/app/Instructions/Financial.html";
protected static $INSTRUCTIONS_MEMBERSHIP_PARTIALPATH = "/app/Instructions/Membership.html";
protected static $INSTRUCTIONS_FUNDRAISING_PARTIALPATH = "/app/Instructions/Fundraising.html";
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
		$this->loadInstructions();
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}

/**
 * Loads instruction text from app/Instructions
 *
 * @return void
 */	
	private function loadInstructions() {
	    $financialText = "Put instructions in " . self::$INSTRUCTIONS_FINANCIAL_PARTIALPATH;
	    $membershipText = "Put instructions in " . self::$INSTRUCTIONS_MEMBERSHIP_PARTIALPATH;
	    $fundraisingText = "Put instructions in " . self::$INSTRUCTIONS_FUNDRAISING_PARTIALPATH;
	    $analyzeText = "Put instructions in " . self::$INSTRUCTIONS_ANALYZE_PARTIALPATH;
	    
		if (file_exists(ROOT . self::$INSTRUCTIONS_FINANCIAL_PARTIALPATH)){
            $financialText = file_get_contents(ROOT . self::$INSTRUCTIONS_FINANCIAL_PARTIALPATH);
        }
		if (file_exists(ROOT . self::$INSTRUCTIONS_MEMBERSHIP_PARTIALPATH)){
            $membershipText = file_get_contents(ROOT . self::$INSTRUCTIONS_MEMBERSHIP_PARTIALPATH);
        }
		if (file_exists(ROOT . self::$INSTRUCTIONS_FUNDRAISING_PARTIALPATH)){
            $fundraisingText = file_get_contents(ROOT . self::$INSTRUCTIONS_FUNDRAISING_PARTIALPATH);
        }
		if (file_exists(ROOT . self::$INSTRUCTIONS_ANALYZE_PARTIALPATH)){
            $analyzeText = file_get_contents(ROOT . self::$INSTRUCTIONS_ANALYZE_PARTIALPATH);
        }
        
        $this->set('financialInstructions', $financialText);
        $this->set('membershipInstructions', $membershipText);
        $this->set('fundraisingInstructions', $fundraisingText);
        $this->set('analyzeInstructions', $analyzeText);
    }
}
