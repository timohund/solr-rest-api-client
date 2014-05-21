<?php

namespace SolrRestApiClient\Tests\Api\Client\Domain\Synonym;

use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymTagRepository;
use SolrRestApiClient\Api\Client\Domain\Synonym\SynonymDataMapper;
use SolrRestApiClient\Tests\BaseTestCase;

class SynonymЕфпRepositoryTestCase extends BaseTestCase {

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
	 * @var \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymTagRepository()
	 */
	protected $synonymTagRepository;

	/**
	 * @return void
	 */
	public function setUp() {
		$factory = new \SolrRestApiClient\Common\Factory();
		$this->dataMapper = new SynonymDataMapper();
		$this->synonymTagRepository = $factory->getSynonymTagRepository($this->host, $this->port, $this->corePath);
	}

	/**
	 * @test
	 */
	public function canGetTags() {
		$tags = $this->synonymTagRepository->getTags();
		$this->assertContains("it",$tags);
	}
}