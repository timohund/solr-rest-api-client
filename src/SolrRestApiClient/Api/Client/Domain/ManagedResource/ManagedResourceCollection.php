<?php

namespace SolrRestApiClient\Api\Client\Domain\ManagedResource;

use SolrRestApiClient\Api\Client\Domain\AbstractCollection;

/**
 * Class ManagedResourceCollection
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 * @package SolrRestApiClient\Api\Client\Domain\StopWord
 */
class ManagedResourceCollection extends AbstractCollection {

	/**
	 * @param ManagedResource $managedResource
	 */
	public function add(ManagedResource $stopWord) {
		$this->data->append($stopWord);
	}

	/**
	 * @param $index
	 * @return mixed
	 */
	public function getByIndex($index) {
		return $this->data->offsetGet($index);
	}
}