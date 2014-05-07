<?php

namespace SolrRestApiClient\Api\Client\Domain\Synonym;


class Synonym {

	/**
	 * The main term
	 *
	 * @var string
	 */
	protected $mainWord = '';

	/**
	 * The related words with the same meaning
	 *
	 * @var array
	 */
	protected $wordsWithSameMeaning = array();

	/**
	 * @var string
	 */
	protected $tag = '';


	/**
	 * @param string $word
	 */
	public function addWordsWithSameMeaning($word) {
		$this->wordsWithSameMeaning[$word] = $word;
	}

	/**
	 * @param string $mainWord
	 */
	public function setMainWord($mainWord) {
		$this->mainWord = $mainWord;
	}

	/**
	 * @return string
	 */
	public function getMainWord() {
		return $this->mainWord;
	}
}