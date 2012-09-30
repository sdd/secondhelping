<?php
App::uses('AppModel', 'Model');
/**
 * Offering Model
 *
 * @property Location $Location
 * @property OfferStatus $OfferStatus
 * @property CollectionRequest $CollectionRequest
 */
class Offering extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'OfferStatus' => array(
			'className' => 'OfferStatus',
			'foreignKey' => 'offer_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'CollectionRequest' => array(
			'className' => 'CollectionRequest',
			'foreignKey' => 'offering_id',
			'dependent' => false,
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
