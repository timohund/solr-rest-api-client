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
	 * @param $tag
	 * @return bool
	 */
	public function addAll(SynonymCollection $synonyms, $tag = "default") {
		$json       = $this->dataMapper->toJson($synonyms);
		$endpoint   = $this->getEndpoint(array($tag));
		$response   = $this->executePostRequest($endpoint, $json);

		return $response->getStatusCode() == 200;
	}

	/**
	 * @param $tag
	 * @return SynonymCollection
	 */
	public function getAll($tag = "default") {
		$endpoint   = $this->getEndpoint(array($tag));
		$response   = $this->executeGetRequest($endpoint);
		$result     = $response->getBody(true);

		return $this->dataMapper->fromJson($result);
	}

	/**
	 * @param string $mainWord
	 * @param string $tag
	 * @return SynonymCollection
	 */
	public function getByMainWord($mainWord = '', $tag = "default") {
		$endpoint = $this->getEndpoint(array($tag));

		if(trim($mainWord) != '') {
			$endpoint = $endpoint . '/' .$mainWord;
		}

		$response = $this->executeGetRequest($endpoint);
		$result = $response->getBody(true);

		return $this->dataMapper->fromJsonToMainWordCollection($result, $mainWord, $tag);
	}

	/**
	 * @param $tag
	 * @return bool
	 * @throws \Exception
	 */
	public function deleteAll($tag = "default") {
		$result = array();
		$synonymsCollection = $this->getAll($tag);

		foreach($synonymsCollection->toArray() as $synonymObject) {
			$result[] = $synonymObject->getMainWord();
		}

		if(count($result) > 0) {
			foreach($result as $mainWord) {
				$endpoint = $this->getEndpoint(array($tag, $mainWord));
				$response = $this->executeDeleteRequest($endpoint);
				if($response->getStatusCode() != 200 ) {
					throw new \Exception($mainWord . " do not exists.");
				}
			}
		}
		return true;
	}

	/**
	 * @param string $mainWord
	 * @param string $tag
	 * @return bool
	 * @throws \Exception
	 */
	public function deleteByMainWord($mainWord, $tag = "default") {
		try {
			$endpoint = $this->getEndpoint(array($tag, $mainWord));
			$this->executeDeleteRequest($endpoint);
			return true;
		} catch(\Exception $e) {
			var_dump($e->getMessage());
		}
	}
}