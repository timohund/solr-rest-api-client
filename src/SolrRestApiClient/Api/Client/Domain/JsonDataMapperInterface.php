<?php

namespace SolrRestApiClient\Api\Client\Domain;

interface JsonDataMapperInterface {

	/**
	 * @return object
	 */
	public function fromJson($json);
}