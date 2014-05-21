<?php

namespace SolrRestApiClient\Api\Client\Domain\ManagedResource;

/**
 * Class ManagedResourcesDataMapper
 */
class ManagedResourceDataMapper implements JsonDataMapperInterface {

	/**
	 * @param string $json
	 * @return ManagedResourceCollection
	 */
	public function fromJson($json) {
		$object = json_decode($json);

		if (!is_object($object) || !isset($object->managedResources) || count($object->managedResources) == 0) {
			return $synonymCollection;
		}

		foreach ($object->managedResources as $resources) {
			if (preg_match('/synonyms/', $resources->resourceId)) {
				$matches = preg_split('/synonyms\\//', $resources->resourceId);
				$tags[] = $matches[1];
			}

		}
		return $tags;
	}
}