<?php

namespace SolrRestApiClient\Api\Client\Domain\Synonym;

/**
 * Repository to handle synonyms in solr using the RestAPI
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 */
class SynonymRepository {

	/**
	 * @var \Guzzle\Http\Client
	 */
	protected $restClient;

	/**
	 * @var \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymDataMapper
	 */
	protected $dataMapper;

	/**
	 * @var string
	 */
	protected $hostName = 'localhost';

	/**
	 * @var int
	 */
	protected $port = 8080;

	/**
	 * @var string
	 */
	protected $corePath = 'solr/';

	/**
	 * @var string
	 */
	protected $restEndPointPath = 'schema/analysis/synonyms/';

	/**
	 * @return string
	 */
	public function getCorePath() {
		return $this->corePath;
	}

	/**
	 * @param string $corePath
	 */
	public function setCorePath($corePath) {
		$this->corePath = $corePath;
	}

	/**
	 * @return string
	 */
	public function getHostName() {
		return $this->hostName;
	}

	/**
	 * @param string $hostName
	 */
	public function setHostName($hostName) {
		$this->hostName = $hostName;
	}

	/**
	 * @return int
	 */
	public function getPort() {
		return $this->port;
	}

	/**
	 * @param int $port
	 */
	public function setPort($port) {
		$this->port = $port;
	}

	/**
	 * @return string
	 */
	public function getRestEndPointPath() {
		return $this->restEndPointPath;
	}

	/**
	 * @param string $restEndPointPath
	 */
	public function setRestEndPointPath($restEndPointPath) {
		$this->restEndPointPath = $restEndPointPath;
	}

	/**
	 * @param \Guzzle\Http\Client $restClient
	 * @return void
	 */
	public function injectRestClient(\Guzzle\Http\Client $restClient) {
		$this->restClient = $restClient;
	}

	/**
	 * @param SynonymCollection $synonyms
	 * @param string $tag
	 */
	public function addAll(SynonymCollection $synonyms, $tag) {
		$json = $this->dataMapper->toJson($synonyms);
	}

}