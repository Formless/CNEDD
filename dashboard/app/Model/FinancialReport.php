<?php
App::uses('AppModel', 'Model');
/**
 * FinancialReport Model
 *
 * @property FinancialRow $FinancialRow
 */
class FinancialReport extends AppModel {

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
		'FinancialRow' => array(
			'className' => 'FinancialRow',
			'foreignKey' => 'financial_report_id',
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
