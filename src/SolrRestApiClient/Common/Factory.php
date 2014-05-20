<?php

namespace SolrRestApiClient\Common;

/**
 * Class Factory
 *
 * @package Searchperience\Common
 */
class Factory {

	/**
	 * @param string $hostname
	 * @param int $port
	 * @param string $corePath
	 * @return \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymRepository
	 */
	public static function getSynonymRepository($hostname = 'localhost', $port = 8080, $corePath = 'solr/') {
		$guzzle             = self::getPreparedGuzzleClient();
		$dataMapper         = new \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymDataMapper();

		$synonymRepository  = new \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymRepository();
		$synonymRepository->setHostName($hostname);
		$synonymRepository->setPort($port);
		$synonymRepository->setCorePath($corePath);
		$synonymRepository->injectRestClient($guzzle);
		$synonymRepository->injectDataMapper($dataMapper);
		$synonymRepository->setRestClientBaseUrl();

		return $synonymRepository;
	}

	/**
	 * @return \Guzzle\Http\Client
	 * @throws Exception\RuntimeException
	 */
	protected static function getPreparedGuzzleClient() {
		$guzzle = new \Guzzle\Http\Client();
		$guzzle->setConfig(array(
			'redirect.disable' => true
		));

		return $guzzle;
	}
}