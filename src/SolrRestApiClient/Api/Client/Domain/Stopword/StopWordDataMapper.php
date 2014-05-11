<?php

namespace SolrRestApiClient\Api\Client\Domain\Synonym;

use SolrRestApiClient\Api\Client\Domain\JsonDataMapperInterface;
use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection;

/**
 * Class StopWordDataMapper
 *
 * Reconstitutes the json response to a stopword object.
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 * @package SolrRestApiClient\Api\Client\Domain\Synonym
 */
class StopWordDataMapper implements JsonDataMapperInterface {

	/**
	 * @return object
	 */
	public function fromJson($json) {
		// TODO: Implement fromJson() method.
	}

	/**
	 * @return string
	 */
	public function toJson($object) {
		// TODO: Implement toJson() method.
	}
}
