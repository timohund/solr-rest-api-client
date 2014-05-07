<?php

namespace SolrRestApiClient\Tests\Api\Client\Domain\Synonym;

use SolrRestApiClient\Api\Client\Domain\Synonym\Synonym;
use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection;
use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymDataMapper;
use SolrRestApiClient\Tests\BaseTestCase;

class SynonymDataMapperTestCase extends BaseTestCase {

	/**
	 * @var SynonymDataMapper
	 */
	protected $dataMapper = null;

	/**
	 * @return void
	 */
	public function setUp() {
		$this->dataMapper = new SynonymDataMapper();
	}

	/**
	 * @test
	 */
	public function canBuildJsonFromSynonymCollection() {
		$synonymCollection = new SynonymCollection();

		$synonym = new Synonym();
		$synonym->setMainWord("lucky");
		$synonym->addWordsWithSameMeaning("happy");
		$synonymCollection->attach($synonym);

		$this->assertEquals(1, $synonymCollection->count());
		$expectedJson = '{"lucky":["happy"]}';
		$json = $this->dataMapper->toJson($synonymCollection);

		$this->assertEquals($expectedJson, $json);
	}
}