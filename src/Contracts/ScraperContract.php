<?php
namespace UserForce\Scraper\Contracts;

interface ScraperContract
{
    /**
     * @param array $input
     * @param array $config
     * @return ResultContract
     */
    public function get(array $input, array $config): ResultContract;
}