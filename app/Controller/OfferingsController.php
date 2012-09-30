<?php
App::uses('AppController', 'Controller');
/**
 * Offerings Controller
 *
 * @property Offering $Offering
 */
class OfferingsController extends AppController {


	public $components = array('Auth');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Offering->recursive = 0;
		$this->set('offerings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Offering->id = $id;
		if (!$this->Offering->exists()) {
			throw new NotFoundException(__('Invalid offering'));
		}
		$this->set('offering', $this->Offering->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->isAjax()) {

			$this->autoLayout = false;
			$this->autoRender = false;
			Configure::write('debug', 0);
			header('conten-type:text/x-json');
			header('cache-control:no-store,no-cache,max-age=0,must-revalidate');

			if ($this->request->is('post')) {
				$this->Offering->create();
				$this->set(array('offer_status_id'    => 1));
				if ($this->Offering->save($this->request->data)) {
					echo json_encode(array('success' => true));
				} else {
					echo json_encode(array('success' => false));
				}
			}

		} else {
			if ($this->request->is('post')) {
				$this->Offering->create();

				$this->set(array(
					'offer_status_id'    => 1,
				));

				if ($this->Offering->save($this->request->data)) {
					$this->Session->setFlash(__('The offering has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The offering could not be saved. Please, try again.'));
				}
			}
			$locations = $this->Offering->Location->find('list');
			$locations[-1] = 'Add New Location';


			$this->set(compact('locations'));
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Offering->id = $id;
		if (!$this->Offering->exists()) {
			throw new NotFoundException(__('Invalid offering'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Offering->save($this->request->data)) {
				$this->Session->setFlash(__('The offering has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offering could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Offering->read(null, $id);
		}
		$locations = $this->Offering->Location->find('list');
		$this->set(compact('locations'));
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
		$this->Offering->id = $id;
		if (!$this->Offering->exists()) {
			throw new NotFoundException(__('Invalid offering'));
		}
		if ($this->Offering->delete()) {
			$this->Session->setFlash(__('Offering deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Offering was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	function get($id = null) {
		$this->autoLayout = false;
		$this->autoRender = false;
		Configure::write('debug', 0);
		//header('content-type:text/x-json');
		//header('cache-control:no-store,no-cache,max-age=0,must-revalidate');

		$response = array('success' => false);
		if ($id) {
			$this->Offering->recursive = 1;
			$data = $this->Offering->read(null, $id);

			if ($data) {
				$data = $this->__conditional_conceal($data);

				$response['success'] = true;
				$response['result'] = $data;
			} else {
				$response['message'] = 'Invalid Id';
				//$response['auth user id'] = $this->Auth->user('id');
				//$response['location user id'] =  $data['Location']['user_id'];
			}
		} else {

			// list request
			$filters = array(
				'date_soonest'      => 'Offering.due > #',
				'date_latest'       => 'Offering.due < #',
				'tag'               => "Offering.tag REGEXP '(^|,)#(,|$)'",
				'postcode_1'        => 'Location.postcode_1 = `#`',
				'town_or_city'      => 'Location.town_or_city LIKE `#`',
			);

			$conditions = array();

			foreach($filters as $filter => $condition) {
				if (isset($this->request->data[$filter])) {
					$conditions[] = str_replace('#', $this->request->data[$filter], $condition);
				}
			}

			$data = $this->Offering->find('all', array(
				'conditions' => $conditions
			));

			if ($data) {
				if (isset($data['Offering'])) $data = array($data); // Single results are not retirned as an array, array-ify them
				foreach($data as $index => $item)
					$data[$index] = $this->__conditional_conceal($data[$index]);

				$response['success'] = true;
				$response['result'] = $data;
			} else {
				$response['message'] = 'Invalid Id';
				//$response['auth user id'] = $this->Auth->user('id');
				//$response['location user id'] =  $data['Location']['user_id'];
			}
		}

		$this->response->type('json');
		$this->response->body(json_encode($response));
		return $this->response;

		//echo json_encode($response);
	}

	public function __conditional_conceal($data) {

		//debug($data);

		if ($data) {
			if ($data['Location']['user_id'] == $this->Auth->user('id')) {

				// Requester is event owner. return all data.
				//no op

			} elseif ($data['CollectionRequest'][0]['user_id']) {

				// Requester is reserved collector.
				switch ($data['OfferStatus']['name']) {

					case 'Planned':
					case 'Reservation Expired':
					case 'Reservation Cancelled':
					case 'Expired':
						// Coarse Location Available
						unset($data['Location']['lat']);
						unset($data['Location']['lon']);
						unset($data['Location']['name']);
						unset($data['Location']['street_address']);
						unset($data['Location']['postcode_2']);
						break;

					case 'Imminent':
					case 'Ready':
					case 'Acknowledged':
					case 'Collected':
						// Fine location available
						break;

				}
			} elseif ($this->Auth->user('site_role') == 'consumer') {

				// Requester is unreserved collector.
				switch ($data['OfferStatus']['name']) {

					case 'Planned':
					case 'Reservation Expired':
					case 'Reservation Cancelled':
					case 'Expired':
					case 'Imminent':
					case 'Ready':
					case 'Acknowledged':
					case 'Collected':
						// Coarse Location Available
						unset($data['Location']['lat']);
						unset($data['Location']['lon']);
						unset($data['Location']['name']);
						unset($data['Location']['street_address']);
						unset($data['Location']['postcode_2']);
						break;
				}
			} elseif ($this->Auth->user('site_role') == 'admin') {

				// Requester is an admin
				switch ($data['OfferStatus']['name']) {

					case 'Planned':
					case 'Reservation Expired':
					case 'Reservation Cancelled':
					case 'Expired':
					case 'Imminent':
					case 'Ready':
					case 'Acknowledged':
					case 'Collected':
						// Fine Location Available
						break;
				}
			}
		} else {
			return false;
		}
		return $data;
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Offering->recursive = 0;
		$this->set('offerings', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Offering->id = $id;
		if (!$this->Offering->exists()) {
			throw new NotFoundException(__('Invalid offering'));
		}
		$this->set('offering', $this->Offering->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Offering->create();
			if ($this->Offering->save($this->request->data)) {
				$this->Session->setFlash(__('The offering has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offering could not be saved. Please, try again.'));
			}
		}
		$locations = $this->Offering->Location->find('list');
		$this->set(compact('locations'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Offering->id = $id;
		if (!$this->Offering->exists()) {
			throw new NotFoundException(__('Invalid offering'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Offering->save($this->request->data)) {
				$this->Session->setFlash(__('The offering has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The offering could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Offering->read(null, $id);
		}
		$locations = $this->Offering->Location->find('list');
		$this->set(compact('locations'));
	}

/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Offering->id = $id;
		if (!$this->Offering->exists()) {
			throw new NotFoundException(__('Invalid offering'));
		}
		if ($this->Offering->delete()) {
			$this->Session->setFlash(__('Offering deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Offering was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
