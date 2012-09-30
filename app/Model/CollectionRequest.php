<?php
App::uses('AppModel', 'Model');
/**
 * CollectionRequest Model
 *
 * @property User $User
 * @property Offering $Offering
 */
class CollectionRequest extends AppModel {
	//public $name = 'CollectionRequest';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Offering' => array(
			'className' => 'Offering',
			'foreignKey' => 'offering_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}