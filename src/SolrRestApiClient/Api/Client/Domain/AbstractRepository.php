<?php

namespace SolrRestApiClient\Api\Client\Domain;

/**
 * Class AbstractRepository
 *
 * @author Timo Schmidt <timo.schmidt@aoe.com>
 * @package SolrRestApiClient\Api\Client\Domain
 */
abstract class AbstractRepository {

	/**
	 * @var \Guzzle\Http\Client
	 */
	protected $restClient;

	/**
	 * @var \SolrRestApiClient\Api\Client\Domain\JsonDataMapperInterface
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
	protected $restEndPointPath  = '';

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
	 * @return string
	 */
	public function getBaseUrl() {
		return 'http://'.$this->hostName.':'.$this->port.'/';
	}

	/**
	 * @param $tag
	 * @param null $body
	 * @param array $options
	 * @return \Guzzle\Http\Message\Response
	 */
	protected function executePostRequest($tag, $body = null,$options = array()) {
		$synonymEndpoint = $this->corePath. $this->restEndPointPath. $tag;
		$response = $this->restClient->setBaseUrl( $this->getBaseUrl() )
			->post($synonymEndpoint,array('Content-type' =>'application/json'), $body, $options)
			->send();

		return $response;
	}
}

