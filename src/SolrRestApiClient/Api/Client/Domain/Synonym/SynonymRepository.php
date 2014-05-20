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
		$json = $this->dataMapper->toJson($synonyms);
		$response = $this->executePostRequest($tag, $json);

		return $response->getStatusCode() == 200;
	}

	/**
	 * @param $tag
	 * @return SynonymCollection
	 */
	public function getAll($tag = "default") {
		$response = $this->executeGetRequest($tag);
		$result = $response->getBody(true);

		return $this->dataMapper->fromJson($result);
	}

	/**
	 * @param string $mainWord
	 * @param string $tag
	 * @return SynonymCollection
	 */
	public function getByMainWord($mainWord = '', $tag = "default") {
		$response = $this->executeGetRequest($tag, $mainWord);
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
				$response = $this->executeDeleteRequest($tag, $mainWord);
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
			$this->executeDeleteRequest($tag, $mainWord);
			return true;
		} catch(\Exception $e) {
			var_dump($e->getMessage());
		}
	}
}