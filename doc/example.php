<?php

require '../vendor/autoload.php';

$factory                    = new \SolrRestApiClient\Common\Factory();
$managedResourceRepository  = $factory->getManagedResourceRepository('localhost',8080,'solr/<corename/collectionname>/');
$resources                  = $managedResourceRepository->getAll();

$synonymRepository          = $factory->getSynonymRepository('localhost',8080,'solr/<corename/collectionname>/');

foreach($resources->getSynonymResources() as $resource) {
	$synonymRepository->setResource($resource);

	$synonymCollection = new \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection();

	$synonym = new \SolrRestApiClient\Api\Client\Domain\Synonym\Synonym();
	$synonym->setMainWord("one");
	$synonym->addWordsWithSameMeaning("one#one");
	$synonym->addWordsWithSameMeaning("one#two");
	$synonymCollection->add($synonym);

	$synonym = new \SolrRestApiClient\Api\Client\Domain\Synonym\Synonym();
	$synonym->setMainWord("two");
	$synonym->addWordsWithSameMeaning("two#one");
	$synonym->addWordsWithSameMeaning("two#two");
	$synonymCollection->add($synonym);

	$synonymRepository->addAll($synonymCollection);
	$synonymRepository->deleteByMainWord("one");

	var_dump($synonymRepository->getAll());

	$synonymRepository->deleteAll();

	var_dump($synonymRepository->getAll());
}

