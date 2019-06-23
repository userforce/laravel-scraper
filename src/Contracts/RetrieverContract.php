<?php
namespace UserForce\Scraper\Contracts;


interface RetrieverContract
{
    /**
     * @param array $input
     * @return array
     */
    public function get(array $input): array;
}