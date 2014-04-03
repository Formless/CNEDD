<?php
App::uses('AppController', 'Controller');
/**
 * SetDisplayCountController Controller
 * @package       app.Controller
 */
class SetDisplayCountController extends AppController {
	
	public $helpers = array(
	
		'Js' => array('Jquery'),
		'Session',
		'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
		'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
		'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator')

	);
	public $components = array('RequestHandler');
	
	//limit indicates the number of surveys/etc. to show per page
	public $paginate = array(
		'limit' => 2
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
	    $surveysToShow = 10; //default
	    if (count($this->request->params["pass"]) > 0){
	        $surveysParam = $this->request->params["pass"][0]; //the first extra parameter on the url
	        if (is_numeric($surveysParam)) {
	            $surveysParam = (int) $surveysParam;
	            if ($surveysParam > 0 && $surveysParam <= 20)  //if not between 1 and 20 inclusive, ignore param and go with default
	                $surveysToShow = $surveysParam;
	        }
	    }
	    $this->paginate['limit'] = $surveysToShow;
	}
}
