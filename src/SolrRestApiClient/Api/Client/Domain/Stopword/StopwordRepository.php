<?php

namespace SolrRestApiClient\Api\Client\Domain\StopWord;
use SolrRestApiClient\Api\Client\Domain\AbstractRepository;

/**
 * Repository to handle StopWord in solr using the RestAPI
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 */
class StopWordRepository extends AbstractRepository {

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
	 * @param $tag
	 * @return bool
	 */
	public function addAll(StopWordCollection $stopWords, $tag = 'default') {
		$json = $this->dataMapper->toJson($stopWords);
		$response = $this->executePostRequest($tag, $json);

		return $response;
		//return $response->getStatusCode() == 200;
	}
}