<?php

namespace SolrRestApiClient\Api\Client\Domain\Synonym;

use SolrRestApiClient\Api\Client\Domain\JsonDataMapperInterface;
use SolrRestApiClient\Api\Client\Domain\StopWord\StopWordCollection;

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
	 * @param StopWordCollection $stopWordCollection
	 * @return string
	 */
	public function toJson($stopWordCollection) {
		$result = array();

		/** @var $stopWordCollection StopWordCollection */
		foreach($stopWordCollection as $stopWord) {
			/** @var $stopWord StopWord */
			$result[] = $stopWord->getWord();
		}

		return json_encode($result);
	}
}
