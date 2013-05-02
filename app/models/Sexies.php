<?php

namespace app\models;

class Sexies extends \lithium\data\Model {

	protected $_schema = array(
		'_id' => array('type' => 'id', 'primary' => 'true'),
		'file_name' => array('type' => 'string'),
		'hash' => array('type' => 'string'),
		'random' => array('type' => 'integer'),
		'size' => array('type' => 'integer'),
		'createdAt' => array('type' => 'date'),
		'comments' => array('type' => 'array'),
		'commentCount' => array('type' => 'integer', 'default' => 0),
	);

	protected $_classes = array(
		'comments' => 'app\models\Comments',
	);

	public $imagePath = '/images';
	public $storagePath = LITHIUM_APP_PATH;
	public $originalPath;

	function __construct() {
		$this->storagePath .= '/webroot';
		$this->originalPath = $this->storagePath . $this->imagePath;
	}

	public function saveImage( $entity, $file, $hash = null ) {
		$ext = pathinfo($file['name'], PATHINFO_EXTENSION);

		// Build new filename
		$newFileName = $entity->_id . '.' . $ext;

		$newFilePath = $this->originalPath . '/' . $newFileName;

		if ( move_uploaded_file( $file['tmp_name'], $newFilePath ) ) {
			$entity->fileName = $newFileName;
			$entity->size = $file['size'];

			if ( !$hash )
				$entity->hash = md5_file($newFilePath);
			else
				$entity->hash = $hash;

			return true;
		}

		return false;
	}

	public function comment( $entity, $params = array() ) {
		$default = array('args' => array(), 'data' => array());
		$params += $default;
		extract($params);

		$comment = $this->_classes['comments'];
		$comment = $comment::create($data);

		if (empty($entity->_id) || !$comment->save()) {
			return false;
		}

		$data = $comment->data();
		$comments = !empty($entity->comments) ? $entity->comments->data() : array();

		$insert = function($comments, $args) use (&$insert, $data) {
			while($args) {
				$key = array_shift($args);
				if (isset($comments[$key])) {
					$comments[$key] = (array) $comments[$key];
					$result = (array) $comments[$key] + array('comments' => array());
					$comments[$key]['comments'] = $insert((array) $result['comments'], $args);
					$comments[$key]['commentCount']++;
				}
				return $comments;
			}
			return array_merge((array) $comments, array($data));
		};
		$entity->commentCount++;

		$comments  = $insert($comments, $args);
		$entity->set(compact('comments'));

		return $entity->save();
	}

}

use lithium\util\collection\Filters;

Filters::apply('app\models\Sexies', 'save', function($self, $params, $chain ) {

	// Only do this if this is a new model
	if ( !$params['entity']->exists() ) {
		$params['data']['random']    = rand();
		$params['data']['createdAt'] = time();
	}

	return $chain->next($self, $params, $chain);

});