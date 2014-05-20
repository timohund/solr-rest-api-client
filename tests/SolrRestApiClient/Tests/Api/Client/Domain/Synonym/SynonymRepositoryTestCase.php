<?php

namespace SolrRestApiClient\Tests\Api\Client\Domain\Synonym;

use SolrRestApiClient\Api\Client\Domain\Synonym\Synonym;
use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection;
use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymDataMapper;
use SolrRestApiClient\Tests\BaseTestCase;

class SynonymRepositoryTestCase extends BaseTestCase {

	/**
	 * @var string
	 */
	protected $host = 'localhost';

	/**
	 * @var int
	 */
	protected $port = 8080;

	/**
	 * @var string
	 */
	protected $corePath = 'solr/saascluster-qvc-it-devbox/';

	/**
	 * @var SynonymDataMapper
	 */
	protected $dataMapper = null;

	/**
	 * @var \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymRepository()
	 */
	protected $synonymRepository;

	/**
	 * @return void
	 */
	public function setUp() {
		$factory = new \SolrRestApiClient\Common\Factory();
		$this->dataMapper = new SynonymDataMapper();
		$this->synonymRepository = $factory->getSynonymRepository($this->host, $this->port, $this->corePath);
	}

	/**
	 * @return void
	 */
	public function tearDown() {
	}


	/**
	 * @test
	 */
	public function canAddAndDeleteSynonym() {

		$synonymCollection = new \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection();

		$synonym = new \SolrRestApiClient\Api\Client\Domain\Synonym\Synonym();
		$synonym->setMainWord('foo');
		$synonym->addWordsWithSameMeaning('bar');
		$synonym->addWordsWithSameMeaning('bla');
		$synonym->addWordsWithSameMeaning('bluqqqqqqqqqqq');

		$synonymCollection->add($synonym);

		$result = $this->synonymRepository->addAll($synonymCollection, 'it');
		$this->assertTrue($result);

		$this->synonymRepository->deleteByMainWord("it", 'foo');
	}

	/**
	 * @test
	 */
	public function canGetAllSynonymsCollectionObject() {
		$synonymCollection = $this->createSynonymsCollection(array("foo" => array("bar", "bla", "blu"), "test" => array("1", "2", "3")));
		$this->synonymRepository->addAll($synonymCollection, 'it');

		$synonymsAll = $this->synonymRepository->getAll("it");
		$this->assertInstanceOf('SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection', $synonymsAll);

		$synonyms = $this->synonymRepository->getByMainWord("it", "foo");
		$this->assertEquals(1, count($synonyms), "Amount of added synonyms not equal to expected returned count");
		$this->synonymRepository->deleteByMainWord("it", 'foo');

		$synonyms2 = $this->synonymRepository->getByMainWord("it", "test");
		$this->assertEquals(3, count($synonyms2->getByIndex(0)->getWordsWithSameMeaning()), "Amount of retrieved words with same meaning not equal to added");
		$this->assertEquals("test", $synonyms2->getByIndex(0)->getMainWord(), "Main word not equal to added main word");
		$this->synonymRepository->deleteByMainWord("it", 'test');
	}

	/**
	 * @param array $synonyms
	 * @return SynonymCollection $synonymCollection
	 */
	protected function createSynonymsCollection($synonyms) {
		$synonymCollection = new \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection();
		foreach($synonyms as $mainWord => $wordsWithSameMeaning){
			$synonym = new \SolrRestApiClient\Api\Client\Domain\Synonym\Synonym();
			$synonym->setMainWord($mainWord);
			foreach($wordsWithSameMeaning as $wordWithSameMeaning)
				$synonym->addWordsWithSameMeaning($wordWithSameMeaning);
			$synonymCollection->add($synonym);
		}
		return $synonymCollection;
	}
}