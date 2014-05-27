<?php

namespace SolrRestApiClient\Api\Client\Domain\StopWord;

use SolrRestApiClient\Api\Client\Domain\AbstractRepository;
use SolrRestApiClient\Api\Client\Domain\AbstractTaggedResourceRepository;

/**
 * Repository to handle StopWord in solr using the RestAPI
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 */
class StopWordRepository extends AbstractTaggedResourceRepository {

	/**
	 * @var string
	 */
	protected $restEndPointPath = 'schema/analysis/stopwords/';

	/**
	 * @param StopWordDataMapper $dataMapper
	 */
	public function injectDataMapper(StopWordDataMapper $dataMapper) {
		$this->dataMapper = $dataMapper;
	}

	/**
	 * @param StopWordCollection $stopWords
	 * @param $forceResourceTag
	 * @return bool
	 */
	public function addAll(StopWordCollection $stopWords, $forceResourceTag = null) {
		$resourceTag    = $this->getTag($forceResourceTag);
		$json           = $this->dataMapper->toJson($stopWords);
		$endpoint       = $this->getEndpoint(array($resourceTag));
		$response       = $this->executePostRequest($endpoint, $json);

		return $response->getStatusCode() == 200;
	}

	/**
	 * @param $forceResourceTag
	 * @return StopWordCollection
	 */
	public function getAll($forceResourceTag = null) {
		try {
			$resourceTag    = $this->getTag($forceResourceTag);
			$endpoint       = $this->getEndpoint(array($resourceTag));
			$response       = $this->executeGetRequest($endpoint);
			$result         = $response->getBody(true);
		} catch ( \Guzzle\Http\Exception\BadResponseException $e) {
			if($e->getResponse()->getStatusCode() === 404) {
				return new StopWordCollection();
			}
		}

		return $this->dataMapper->fromJson($result);
	}
}