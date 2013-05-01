<?php

namespace app\models;

class Comments extends \lithium\data\Model {

	protected $_schema = array(
		'_id' => array('type' => 'id'),
		'content' => array('type' => 'text'),
		'createdAt' => array('type' => 'date'),
		'ip' => array('type' => 'string'),
	);

	protected $_classes = array(
		'set'     => 'lithium\data\collection\DocumentSet',
	);

}

use lithium\util\collection\Filters;

Filters::apply('app\models\Comments', 'save', function($self, $params, $chain ) {

	if ( !$params['entity']->exists() ) {
		$params['data']['createdAt'] = time();
		// Add request IP
		$params['data']['ip'] = $_SERVER['REMOTE_ADDR'];
	}

	return $chain->next($self, $params, $chain);
});