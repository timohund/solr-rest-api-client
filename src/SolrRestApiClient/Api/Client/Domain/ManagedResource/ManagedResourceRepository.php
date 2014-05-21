<?php

namespace SolrRestApiClient\Api\Client\Domain\ManagedResource;

use SolrRestApiClient\Api\Client\Domain\AbstractRepository;

/**
 * Repository to manage resources in solr using the RestAPI
 *
 * @author Nikolay Diaur <nikolay.diaur@aoe.com>
 */
class ManagedResourceRepository extends AbstractRepository {

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
		$endpoint   = $this->getEndpoint();
		$response   = $this->executeGetRequest($endpoint);
		$result     = $response->getBody(true);

		return $this->dataMapper->fromRestManagedJson($result);
	}
}