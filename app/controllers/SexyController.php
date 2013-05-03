<?php

namespace app\controllers;

use app\models\Sexies;
use lithium\util\String;

class SexyController extends \lithium\action\Controller {

	public function index( $id = null ) {

		// If an id is specified, find the image
		if ( $id ) {
			$sexies = Sexies::find('first', array(
				'conditions' => array(
					'_id' => $id,
				),
			));
		} else {

			// Otherwise, find a random image from the database
			$random = rand();

			$greaterThan = array( '$gt' => $random );
			$lessThan = array( '$lt' => $random );

			// Try greater than integer
			$sexies = Sexies::find('first', array(
				'conditions' => array(
					'random' => $greaterThan,
				),
				'order' => 'DESC',
			));

			// If the random integer is too high, try lower
			if ( !count($sexies) ) {
				$sexies = Sexies::find('first', array(
					'conditions' => array(
						'random' => $lessThan,
					),
					'order' => 'DESC',
				));
			}

		}

		return compact('sexies');
	}

	public function latest() {
		$limit = 20;
		$page = $this->request->page ?: 1;
		$order = array('createdAt' => 'DESC');
    $options = compact('limit', 'page', 'order');
    $sexies = Sexies::find('all', $options);

    return compact('sexies', 'options');
	}

	public function comment( $id = null ) {

		if ($this->request->is('post')) {

			$data = $this->request->data;
			$args = $this->request->args;

			$sexies = Sexies::find('first', array(
				'conditions' => array(
					'_id' => $data['id'],
				)
			));

			if ( !count($sexies) )
				return compact('sexies');

			$sexies->comment(compact('data', 'args'));

		} else {

			return $this->redirect(array(
				'controller' => 'Sexies',
				'action' => 'index',
			));
		}

		$this->render(array(
			'type' => 'json',
			'data' => compact('sexies')
		));

	}

	public function upload() {

		// If this isn't a post request we can avoid the awkward situation
		if ( ! $this->request->is('post') )
			return;

		$error = array('code' => 0);

		$data = $this->request->data;

		if ( array_key_exists( 'image', $data ) && !$data['image']['error'] ) {

			// Check if file is already uploaded
			$hash = md5_file($data['image']['tmp_name']);
			$exists = Sexies::find('first', array('conditions' => array( 'hash' => $hash ) ) );

			// If the file doesn't exist, create a new document
			if ( !count($exists) ) {
				$sexies = Sexies::create();
				$sexies->save();
				$sexies->saveImage($data['image']);
				$sexies->save();
				$id = $sexies->_id;
			} else {
				$id = $exists->_id;
			}
		} else {
			$error = array(
				'code' => 1,
				'msg'  => "Can't find the image!",
			);
		}

		$this->render(array(
			'type' => 'json',
			'data' => compact('error', 'id')
		));

	}

}

?>