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
			#$count = 0;
			#while ( !$count ) {
				$sexies = Sexies::find('first', array(
					'conditions' => array(
						'random' => array( '$gte' => rand() ),
					),
				));
			#	$count = count($sexies);
			#}
		}

		return compact('sexies');
	}

	public function edit( $editHash ) {

		$sexies = Sexies::find('first', array(
			'conditions' => array(
				'editHash' => $editHash,
			)
		));

		if ( !count($sexies) )
			return compact('sexies');

		if ( $this->request->is('put') ) {
			if($this->request->data && $sexies->save($this->request->data)) {
				$saved = true;
			}
		}

		return compact('sexies', 'saved');

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