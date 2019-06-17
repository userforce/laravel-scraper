<?php
namespace UserForce\Scraper\Contracts;

interface ResultContract
{
    /**
     * Returns "all or specified by dot notation" result(s).
     * @param string $option
     * @return array
     */
    public function get(string $option = ''): array;
}