<?php

namespace SolrRestApiClient\Api\Client\Domain\Synonym;
use SolrRestApiClient\Api\Client\Domain\AbstractRepository;

/**
 * Repository to handle stopwords in solr using the RestAPI
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 */
class StopWordRepository extends AbstractRepository {

	/**
	 * @var string
	 */
	protected $restEndPointPath = 'schema/analysis/stopwords/';

	/**
	 * @param SynonymDataMapper $dataMapper
	 */
	public function injectDataMapper(SynonymDataMapper $dataMapper) {
		$this->dataMapper = $dataMapper;
	}

	/**
	 * @param StopWordCollection $stopWords
	 * @param string $tag
	 */
	public function addAll(StopWordCollection $stopWords, $tag) {
		$json = $this->dataMapper->toJson($stopWords);
		$response = $this->executePostRequest($tag, $json);

		return $response->getStatusCode() == 200;
	}
}