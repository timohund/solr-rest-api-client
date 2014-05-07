++++++++++++++++++++++++
Solr RESTApi Client
++++++++++++++++++++++++

:Author: Timo Schmidt <timo.schmidt@aoe.com>
:Author: AOE <dev@aoe.com>
:Description: PHP Library to communicate with the RestFul API of Apache Solr
:Homepage: http://www.searchperience.com/
:Build status: |buildStatusIcon|

Solr Client basics
========================

You can use the factory class to retrieve an instance of of the repositories that can be used
to maintain the entities in solr.

::

    require '<vendorDir>/vendor/autoload.php';

    $factory = new \SolrRestApiClient\Common\Factory();
    $repository = $factory->getSynonymRepository('localhost',8080,'solr/<yourcore>/');

    $synonymCollection = new \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymCollection();

    $synonym = new \SolrRestApiClient\Api\Client\Domain\Synonym\Synonym();
    $synonym->setMainWord('foo');
    $synonym->addWordsWithSameMeaning('bar');
    $synonym->addWordsWithSameMeaning('bla');

    $synonymCollection->attach($synonym);

    $result = $repository->addAll($synonymCollection,'mysynonymtag');

::


.. |buildStatusIcon| image:: https://secure.travis-ci.org/timoschmidt/solr-rest-api-client.png?branch=master
   :alt: Build Status
       :target: http://travis-ci.org/timoschmidt/solr-rest-api-client