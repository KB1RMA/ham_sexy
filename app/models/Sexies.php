<?php

namespace app\models;

class Sexies extends \lithium\data\Model {

	public $imagePath = '/images';
	public $storagePath = LITHIUM_APP_PATH;
	public $originalPath;

	function __construct() {
		$this->storagePath .= '/webroot';
		$this->originalPath = $this->storagePath . $this->imagePath;
	}

	public function saveImage( $entity, $file ) {
		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);

		// Build new filename
		$newFileName = $entity->_id . '.' . $ext;

		$newFilePath = $this->originalPath . '/' . $newFileName;

		if ( move_uploaded_file( $file['tmp_name'], $newFilePath ) ) {
			$entity->file_name = $newFileName;
			$entity->size = $file['size'];
			return true;
		}

		return false;
	}

}

use lithium\util\collection\Filters;
use lithium\util\String;

Filters::apply('app\models\Sexies', 'save', function($self, $params, $chain ) {

	// Only do this if this is a new model
	if ( !$params['entity']->exists() ) {
		$params['data']['random']   = rand();
		$params['data']['createdAt'] = time();
	}

	return $chain->next($self, $params, $chain);
});