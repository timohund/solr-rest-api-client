<?php

namespace SolrRestApiClient\Api\Client\Domain\Synonym;
use SolrRestApiClient\Api\Client\Domain\AbstractRepository;

/**
 * Repository to manage resources in solr using the RestAPI
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 */
class SynonymTagRepository extends AbstractRepository {

	/**
	 * @var string
	 */
	protected $restEndPointPath = 'schema/managed';

	/**
	 * @param SynonymDataMapper $dataMapper
	 */
	public function injectDataMapper(SynonymDataMapper $dataMapper) {
		$this->dataMapper = $dataMapper;
	}

	/**
	 * @return \Guzzle\Http\Message\Response
	 */
	public function getTags() {
		$response = $this->executeRestManagedRequest();
		$result = $response->getBody(true);

		return $this->dataMapper->fromRestManagedJson($result);
	}
}