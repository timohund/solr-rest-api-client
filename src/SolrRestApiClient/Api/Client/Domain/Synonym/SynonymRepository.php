<?php

namespace SolrRestApiClient\Api\Client\Domain\Synonym;
use SolrRestApiClient\Api\Client\Domain\AbstractRepository;

/**
 * Repository to handle synonyms in solr using the RestAPI
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 */
class SynonymRepository extends AbstractRepository {

	/**
	 * @var string
	 */
	protected $restEndPointPath = 'schema/analysis/synonyms/';

	/**
	 * @param SynonymDataMapper $dataMapper
	 */
	public function injectDataMapper(SynonymDataMapper $dataMapper) {
		$this->dataMapper = $dataMapper;
	}

	/**
	 * @param SynonymCollection $synonyms
	 * @param string $tag
	 */
	public function addAll(SynonymCollection $synonyms, $tag) {
		$json = $this->dataMapper->toJson($synonyms);
		$response = $this->executePostRequest($tag, $json);

		return $response->getStatusCode() == 200;
	}
}