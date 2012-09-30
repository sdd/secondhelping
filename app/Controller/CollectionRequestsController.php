<?php
App::uses('AppController', 'Controller');
/**
 * CollectionRequests Controller
 *
 * @property CollectionRequest $CollectionRequest
 * @property AuthComponent $Auth
 */
class CollectionRequestsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth');

	public function add() {
		if ($this->request->isAjax()) {

			$this->autoLayout = false;
			$this->autoRender = false;
			Configure::write('debug', 0);
			header('conten-type:text/x-json');
			header('cache-control:no-store,no-cache,max-age=0,must-revalidate');

			if ($this->request->is('post')) {
				$this->CollectionRequest->create();
				$this->set(array(
					'status'    => 1,
					'user_id'   => $this->Auth->user('id'),
				));
				if ($this->CollectionRequest->save($this->request->data)) {
					echo json_encode(array('success' => true));
				} else {
					echo json_encode(array('success' => false));
				}
			}

		} else {
			if ($this->request->is('post')) {
				$this->Offering->create();

				$this->set(array(
					'status'    => 1,
					'user_id'   => $this->Auth->user('id'),
				));

				if ($this->CollectionRequest->save($this->request->data)) {
					$this->Session->setFlash(__('The Collection Request has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Collection Request could not be saved. Please, try again.'));
				}
			}
		}
	}

	function get($id = null) {
		$this->autoLayout = false;
		$this->autoRender = false;
		//Configure::write('debug', 0);
		header('conten-type:text/x-json');
		header('cache-control:no-store,no-cache,max-age=0,must-revalidate');

		$this->CollectionRequest->recursive = -1;

		$response = array('success' => false);
		if ($id) {
			$data = $this->CollectionRequest->read(null, $id);

			if ($data && $data['CollectionRequest']['user_id'] == $this->Auth->user('id')) {
				$response['success'] = true;
				$response['result'] = $data;
			} else {
				$response['message'] = 'Invalid Id';
				//$response['auth user id'] = $this->Auth->user('id');
				//$response['location user id'] =  $data['Location']['user_id'];
			}
		} else {
			$data = $this->CollectionRequest->find('all', array(
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
		echo json_encode($response);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->CollectionRequest->recursive = 0;
		$this->set('collectionRequests', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->CollectionRequest->id = $id;
		if (!$this->CollectionRequest->exists()) {
			throw new NotFoundException(__('Invalid collection request'));
		}
		$this->set('collectionRequest', $this->CollectionRequest->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	/*public function add() {
		if ($this->request->is('post')) {
			$this->CollectionRequest->create();
			if ($this->CollectionRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The collection request has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection request could not be saved. Please, try again.'));
			}
		}
		$users = $this->CollectionRequest->User->find('list');
		$offerings = $this->CollectionRequest->Offering->find('list');
		$this->set(compact('users', 'offerings'));
	}*/

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->CollectionRequest->id = $id;
		if (!$this->CollectionRequest->exists()) {
			throw new NotFoundException(__('Invalid collection request'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CollectionRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The collection request has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection request could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->CollectionRequest->read(null, $id);
		}
		$users = $this->CollectionRequest->User->find('list');
		$offerings = $this->CollectionRequest->Offering->find('list');
		$this->set(compact('users', 'offerings'));
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
		$this->CollectionRequest->id = $id;
		if (!$this->CollectionRequest->exists()) {
			throw new NotFoundException(__('Invalid collection request'));
		}
		if ($this->CollectionRequest->delete()) {
			$this->Session->setFlash(__('Collection request deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Collection request was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->CollectionRequest->recursive = 0;
		$this->set('collectionRequests', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->CollectionRequest->id = $id;
		if (!$this->CollectionRequest->exists()) {
			throw new NotFoundException(__('Invalid collection request'));
		}
		$this->set('collectionRequest', $this->CollectionRequest->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->CollectionRequest->create();
			if ($this->CollectionRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The collection request has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection request could not be saved. Please, try again.'));
			}
		}
		$users = $this->CollectionRequest->User->find('list');
		$offerings = $this->CollectionRequest->Offering->find('list');
		$this->set(compact('users', 'offerings'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->CollectionRequest->id = $id;
		if (!$this->CollectionRequest->exists()) {
			throw new NotFoundException(__('Invalid collection request'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->CollectionRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The collection request has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection request could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->CollectionRequest->read(null, $id);
		}
		$users = $this->CollectionRequest->User->find('list');
		$offerings = $this->CollectionRequest->Offering->find('list');
		$this->set(compact('users', 'offerings'));
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
		$this->CollectionRequest->id = $id;
		if (!$this->CollectionRequest->exists()) {
			throw new NotFoundException(__('Invalid collection request'));
		}
		if ($this->CollectionRequest->delete()) {
			$this->Session->setFlash(__('Collection request deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Collection request was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
