<?php

require '../vendor/autoload.php';

$factory = new \SolrRestApiClient\Common\Factory();
$repository = $factory->getSynonymRepository('localhost',8080,'solr/<yourcore>/');

$synonymCollection = new \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection();

$synonym = new \SolrRestApiClient\Api\Client\Domain\Synonym\Synonym();
$synonym->setMainWord('foo');
$synonym->addWordsWithSameMeaning('bar');
$synonym->addWordsWithSameMeaning('bla');

$synonymCollection->attach($synonym);

$result = $repository->addAll($synonymCollection,'mysynonymtag');