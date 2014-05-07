<?php

namespace SolrRestApiClient\Api\Client\Domain\Synonym;

use SolrRestApiClient\Api\Client\Domain\JsonDataMapperInterface;

/**
 * Reconstitutes the json response to a synonym object.
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 */
class SynonymDataMapper implements JsonDataMapperInterface {

	/**
	 * @param string $json
	 * @return SynonymCollection
	 */
	public function fromJson($json) {

	}
}