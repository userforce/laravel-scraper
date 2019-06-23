<?php
namespace UserForce\Scraper;

use UserForce\Scraper\Contracts\RetrieverContract;
use UserForce\Scraper\Validator\InputValidator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Retriever implements RetrieverContract
{
    /**
     * @var string
     */
    private $currentPage = '';

    /**
     * @param array $input
     * @return array
     * @throws GuzzleException
     */
    public function get(array $input): array
    {
        $pageResults = [];
        if (InputValidator::hasRequired($input)) {
            $this->currentPage = $this->request($input[InputValidator::URL]);
            $pageResults = $this->find($input[InputValidator::REGEX]);
        } else {
            foreach ($input as $key => $item) {
                $pageResults[$key] = $this->get($item, $key);
            }
        }

        return $pageResults;
    }

    /**
     * @param string $url
     * @return string
     * @throws GuzzleException
     */
    private function request(string $url): string
    {
        $client = new Client();
        $method = 'GET';
        $page = $client->request($method, $url)->getBody()->getContents();

        return $page;
    }

    /**
     * @param $regex
     * @return array
     */
    private function find($regex): array
    {
        $result = [];
        if (is_string($regex)) {
            preg_match_all($this->prepareRegex($regex), $this->currentPage, $result);
        } else {
            foreach ($regex as $key => $item) {
                $result[$key] = $this->find($item);
            }
        }

        return $result;
    }

    /**
     * @param string $pattern
     * @return string
     */
    private function prepareRegex(string $pattern): string
    {
        preg_match('/^\/.+\/$/', $pattern, $matches);
        if (empty($matches)) {
            $pattern = '/'.$pattern.'/';
        }

        return $pattern;
    }

}