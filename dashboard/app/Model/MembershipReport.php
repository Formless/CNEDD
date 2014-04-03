<?php
App::uses('AppModel', 'Model');
/**
 * MembershipReport Model
 *
 * @property MembershipRow $MembershipRow
 */
class MembershipReport extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'report_date';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'report_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'MembershipRow' => array(
			'className' => 'MembershipRow',
			'foreignKey' => 'membership_report_id',
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
