<?php
App::uses('AppController', 'Controller');
//App::uses('BatchHelper', 'Batch.Batch/Helper');
/**
 * Locations Controller
 *
 * @property Location $Location
 * @property AuthComponent $Auth
 */
class LocationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth');

	public function beforeFilter() {
		parent::beforeFilter();
	}

	function index() {
		$this->Location->recursive = 0;
		$locations = $this->paginate('Location', array('user_id' => $this->Auth->user('id')));
		$users = $this->Location->User->find('list');
		$this->set(compact('locations', 'users'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid location'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Location->recursive = 1;

		$this->data = $this->Location->read(null, $id);
		if (!$this->data || $this->data['Location']['user_id'] != $this->Auth->user('id')) {
			$this->Session->setFlash('The location you have specified is not valid');
			$this->redirect('/locations');
		}

		$this->set('location', $this->data);
	}

	function get($id = null) {
		$this->autoLayout = false;
		$this->autoRender = false;
		Configure::write('debug', 0);
		//header('content-type:text/x-json');
		//header('cache-control:no-store,no-cache,max-age=0,must-revalidate');

		$response = array('success' => false);
		if ($id) {
			$this->Location->recursive = -1;
			$data = $this->Location->read(null, $id);
			if ($data && $data['Location']['user_id'] == $this->Auth->user('id')) {
				$response['success'] = true;
				$response['result'] = $data;
			} else {
				$response['message'] = 'Invalid Id';
				//$response['auth user id'] = $this->Auth->user('id');
				//$response['location user id'] =  $data['Location']['user_id'];
			}
		} else {
			$data = $this->Location->find('all', array(
				'conditions' => array(
					'user_id' => $this->Auth->user('id')
				)
			));

			if ($data) {
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
	}

	function add() {
		if ($this->request->isAjax()) {

			$this->autoLayout = false;
			$this->autoRender = false;
			Configure::write('debug', 0);
			//header('conten-type:text/x-json');
			//header('cache-control:no-store,no-cache,max-age=0,must-revalidate');

			if ($this->request->is('post')) {
				$this->Location->create();
				$this->Location->set(array(
					'user_id' => $this->Auth->user('id')
				));
				if ($this->Location->save($this->request->data)) {
					echo $response = array('success' => true);
				} else {
					echo $response = array('success' => false);
				}

				$this->response->type('json');
				$this->response->body(json_encode($response));
				return $this->response;
			}

		} else {
			if (!empty($this->data)) {

				$this->Location->create();

				$this->Location->set(array(
					'user_id' => $this->Auth->user('id')
				));

				if ($this->Location->save($this->data)) {
					$this->Session->setFlash(__('The location has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
				}
			}
			$users = $this->Location->User->find('list');
			$this->set(compact('users'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid location'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Location->save($this->data)) {
				$this->Session->setFlash(__('The location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		}
		if (empty($this->data)) {
			$this->Location->recursive = 1;
			$this->data = $this->Location->read(null, $id);
		}
		$users = $this->Location->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for location'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Location->delete($id)) {
			$this->Session->setFlash(__('Location deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Location was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	function admin_index() {
		$this->Location->recursive = 0;
		$locations = $this->paginate();
		$users = $this->Location->User->find('list');
		$this->set(compact('locations', 'users'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid location'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Location->recursive = 1;
		$this->set('location', $this->Location->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Location->create();
			if ($this->Location->save($this->data)) {
				$this->Session->setFlash(__('The location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		}
		$users = $this->Location->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid location'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Location->save($this->data)) {
				$this->Session->setFlash(__('The location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		}
		if (empty($this->data)) {
			$this->Location->recursive = 1;
			$this->data = $this->Location->read(null, $id);
		}
		$users = $this->Location->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for location'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Location->delete($id)) {
			$this->Session->setFlash(__('Location deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Location was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
