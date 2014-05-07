<?php

namespace SolrRestApiClient\Api\Client\Domain\Synonym;

use SolrRestApiClient\Api\Client\Domain\JsonDataMapperInterface;
use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection;

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

	/**
	 * Converts a SynonymCollection to a json structure that is understood by the solr restApi.
	 *
	 * @param SynonymCollection $synonymCollection
	 * @return string
	 */
	public function toJson(SynonymCollection $synonymCollection) {
		$result =  new \StdClass();
		foreach($synonymCollection as $synonym) {
				/** @var $synonym Synonym */
			$mainWord = $synonym->getMainWord();
			$result->$mainWord = array_values($synonym->getWordsWithSameMeaning());
		}

		return json_encode($result);
	}
}