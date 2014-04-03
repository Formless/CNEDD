<?php
App::uses('AppModel', 'Model');
/**
 * SurveyGroup Model
 *
 * @property Survey $Survey
 */
class SurveyGroup extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'SurveyGroups';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'survey_group_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Survey' => array(
			'className' => 'Survey',
			'foreignKey' => 'survey_group_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
