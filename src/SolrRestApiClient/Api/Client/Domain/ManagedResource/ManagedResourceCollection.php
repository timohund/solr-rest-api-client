<?php

namespace SolrRestApiClient\Api\Client\Domain\ManagedResource;

use SolrRestApiClient\Api\Client\Domain\AbstractCollection;

/**
 * Class ManagedResourceCollection
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 * @package SolrRestApiClient\Api\Client\Domain\ManagedResource
 */
class ManagedResourceCollection extends AbstractCollection {

	/**
	 * @param ManagedResource $managedResource
	 */
	public function add(ManagedResource $managedResource) {
		$this->data->append($managedResource);
	}

	/**
	 * @param $index
	 * @return mixed
	 */
	public function getByIndex($index) {
		return $this->data->offsetGet($index);
	}

	/**
	 * @return ManagedResourceCollection
	 */
	public function getSynonymResources() {
		$result = new ManagedResourceCollection();

		foreach($this->data as $item) {
			if($item instanceof SynonymResource) {
				$result->add($item);
			}
		}

		return $result;
	}
}