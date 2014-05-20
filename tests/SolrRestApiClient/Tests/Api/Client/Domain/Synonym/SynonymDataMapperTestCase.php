<?php

namespace SolrRestApiClient\Tests\Api\Client\Domain\Synonym;

use SolrRestApiClient\Api\Client\Domain\Synonym\Synonym;
use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection;
use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymDataMapper;
use SolrRestApiClient\Tests\BaseTestCase;

class SynonymDataMapperTestCase extends BaseTestCase {

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
	public function canBuildSynonymCollectionFromJson() {
		$input = '{
                "responseHeader":{
			        "status":0,
                    "QTime":2
                },
                "synonymMappings":{
	                "initArgs":{"ignoreCase":false},
	                "initializedOn":"2014-05-07T11:33:57.187Z",
	                "updatedSinceInit":"2014-05-07T14:38:02.261Z",
	                "managedMap":{
	                    "foo":["bar","bla"],
					    "lucky":["happy"]
	                }
                }
         }';

		$synonymCollection = $this->dataMapper->fromJson($input);
		$this->assertEquals(2, $synonymCollection->getCount(),'Unexpected amount of synonyms after reconstitution.');

			/** @var $first Synonym  */
		$first = $synonymCollection->getByIndex(0);
		$this->assertEquals(array("bar" => "bar","bla" => "bla"), $first->getWordsWithSameMeaning(),'Could not create solr synonym collection from rest api response');
	}

	/**
	 * @test
	 */
	public function canBuildSynonymCollectionFromJsonAfterSearchByMainWord() {
		$input = '{
				   "responseHeader":
				   {
					   "status": 0,
					   "QTime": 3
				   },
				   "foo":
				   [
					   "bar",
					   "bla"
				   ]
    			}';

		$synonymCollection = $this->dataMapper->fromJsonToMainWordCollection($input, "foo");
		$this->assertEquals(1, $synonymCollection->getCount(), 'Unexpected amount of synonyms after reconstitution.');

		/** @var $first Synonym */
		$first = $synonymCollection->getByIndex(0);
		$this->assertEquals(array("bar" => "bar", "bla" => "bla"), $first->getWordsWithSameMeaning(), 'Could not create solr synonym collection from rest api response');
	}
}