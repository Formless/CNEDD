<?php
App::uses('AppModel', 'Model');
/**
 * Survey Model
 *
 * @property SurveyGroup $SurveyGroup
 */
class Survey extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'Surveys';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'survey_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'survey_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SurveyGroup' => array(
			'className' => 'SurveyGroup',
			'foreignKey' => 'survey_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
