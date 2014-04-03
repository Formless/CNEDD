<?php
App::uses('AppModel', 'Model');
/**
 * FinancialRow Model
 *
 * @property FinancialReport $FinancialReport
 */
class FinancialRow extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'row_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'type' => array(
			'inlist' => array(
				'rule' => array('inlist', array('income', 'expense')),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'FinancialReport' => array(
			'className' => 'FinancialReport',
			'foreignKey' => 'financial_report_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
