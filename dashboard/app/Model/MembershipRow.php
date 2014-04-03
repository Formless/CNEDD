<?php
App::uses('AppModel', 'Model');
/**
 * MembershipRow Model
 *
 * @property MembershipReport $MembershipReport
 */
class MembershipRow extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'org_name';


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'org_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Organization Name must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'org_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Organization type must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'inlist' => array(
				'rule' => array('inlist', array('Business', 'Nonprofit', 'Consultant', 'NULL')),
				'message' => 'Organization type is invalid',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'first name must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'last name must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'the input is not an email!',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'the email must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'op_budget' => array(
			'inlist' => array(
				'rule' => array('inlist', array('$1,000,000 - $2,000,000', '$100,000 - $250,000', '$250,000 - $500,000',
				                '$500,000 - $1,000,000', 'Less than $100,000', 'Over $2,000,000', 'NULL')),
				'message' => 'the supplied op_budget was not one of the valid values',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'area' => array(
			'inlist' => array(
				'rule' => array('inlist', array('Special Needs/Disabled', 'Environment','Education','Arts/Humanities/Culture'
				               ,'Children/Youth (non-education)','Elderly/Aging','Health and Safety/Healthcare',
				               'Hunger/Poverty/Basic Assistance','Social Services','Foundations','Recreation/Athletics',
				               'Civic/Community Development','Organizational Capacity Building','Faith Based',
				               'Animal Service/Animal Welfare/Wildlife Conservation','Other','Violence Prevention/Civil Liberties',
				               'Housing', 'NULL')),
				'message' => 'The supplied organization area was not a valid type',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'renew_date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'The renew date must be a date',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'the renew date must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'inlist' => array(
				'rule' => array('inlist', array('Current', 'Grace', 'New', 'NULL')),
				'message' => 'the supplied status was not valid',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'the status must not be empty',
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
		'MembershipReport' => array(
			'className' => 'MembershipReport',
			'foreignKey' => 'membership_report_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
