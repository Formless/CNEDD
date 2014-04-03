<?php
App::uses('SetDisplayCountController', 'Controller');
/**
 * Surveys Controller
 *
 * @property Survey $Survey
 */
class SurveysController extends SetDisplayCountController {
	
	public $helpers = array(
	
		'Js' => array('Jquery'),
		'Session',
		'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
		'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
		'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator')

	);
	public $components = array('RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
	    parent::index();
		$this->Survey->recursive = 0;
		$this->set('surveys', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Survey->id = $id;
		if (!$this->Survey->exists()) {
			throw new NotFoundException(__('Invalid survey'));
		}
		$this->set('survey', $this->Survey->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Survey->create();
			if ($this->Survey->save($this->request->data)) {
				$this->Session->setFlash(__('The survey has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey could not be saved. Please, try again.'));
			}
		}
		$surveyGroups = $this->Survey->SurveyGroup->find('list');
		$this->set(compact('surveyGroups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Survey->id = $id;
		if (!$this->Survey->exists()) {
			throw new NotFoundException(__('Invalid survey'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Survey->save($this->request->data)) {
				$this->Session->setFlash(__('The survey has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Survey->read(null, $id);
		}
		$surveyGroups = $this->Survey->SurveyGroup->find('list');
		$this->set(compact('surveyGroups'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Survey->id = $id;
		if (!$this->Survey->exists()) {
			throw new NotFoundException(__('Invalid survey'));
		}
		if ($this->Survey->delete()) {
			$this->Session->setFlash(__('Survey deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Survey was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


	public function analyze() {
		$surveyNames = $this->Survey->SurveyGroup->find('list', array('fields' => 'SurveyGroup.name'));
		$this->set('surveyNames', array_unique($surveyNames));

		$surveyTypes = $this->Survey->SurveyGroup->find('list', array('fields' => 'SurveyGroup.type'));
		$this->set('surveyTypes', array_unique($surveyTypes));

		$surveyInstructors = $this->Survey->SurveyGroup->find('list', array('fields' => 'SurveyGroup.instructor'));
		$this->set('surveyInstructors', array_unique($surveyInstructors));
			
		$surveyLocations = $this->Survey->SurveyGroup->find('list', array('fields' => 'SurveyGroup.location'));
		$this->set('surveyLocations', array_unique($surveyLocations));

		$conditions = array();
		if ($this->request->is('post') || $this->request->is('put')) {
			$name = $this->request->data['SurveyGroup']['surveyNames'];
			$type = $this->request->data['SurveyGroup']['surveyTypes'];
			$instructor = $this->request->data['SurveyGroup']['surveyInstructors'];
			$location = $this->request->data['SurveyGroup']['surveyLocations'];
			$startDate = $this->request->data['SurveyGroup']['startDate'];
			$endDate = $this->request->data['SurveyGroup']['endDate'];

			if($name != NULL) {
				$conditions["SurveyGroup.name"] = $surveyNames[$name];
			}
			if($type != NULL) {
				$conditions["SurveyGroup.type"] = $surveyTypes[$type];
			}
			if($instructor != NULL) {
				$conditions["SurveyGroup.instructor"] = $surveyInstructors[$instructor];
			}
			if($location != NULL) {
				$conditions["SurveyGroup.location"] = $surveyLocations[$location];
			}
			if($startDate['year'] != null && $startDate['month'] != null && $startDate['day'] != null ) {
				$startDatestring=$startDate['year'] . '-' . $startDate['month'] . '-' . $startDate['day'];
				$conditions["SurveyGroup.date >=" ] = $startDatestring;
			}
			if($endDate['year'] != null && $endDate['month'] != null && $endDate['day'] != null ) {
				$endDatestring=$endDate['year'] . '-' . $endDate['month'] . '-' . $endDate['day'];
				$conditions["SurveyGroup.date <=" ] = $endDatestring;
			}
			
			$fields = array('Survey.expectations', 'Survey.interactivity', 'SurveyGroup.attendance');
			$result = $this->Survey->find('all', array('conditions' => $conditions, 'fields' => $fields));
			$this->processQuery($result);
			$this->attendanceLinegraph();
		} else {

		}
	}
	
	private function processQuery($results) {
		if(count($results) <= 0) {
			echo '<p>There are no surveys that match those criteria.';
			exit;
		}
		$expectationSum = 0;
		$interactivitySum = 0;
		foreach($results as $survey) {
			$expectationSum += $survey['Survey']['expectations'];
			$interactivitySum += $survey['Survey']['interactivity'];
		}
		$averageExpectation = $expectationSum / count($results);
		$averageInteractivity = $interactivitySum / count($results);

		echo '<p>The average expectations value was ' . $averageExpectation . '</p>';
		echo '<p>The average interactivity value was ' . $averageInteractivity . '</p>';

		exit;
	}

    public function isAuthorized($user) {
        if (in_array($this->action, array('analyze'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}
