<?php
namespace UserForce\Scraper;

use UserForce\Scraper\Contracts\ResultContract;

class Result implements ResultContract
{
    /**
     * Returns "all or specified by dot notation" result(s).
     * @param string $option
     * @return array
     */
    public function get(string $option = ''): array
    {
        // TODO: Implement get() method.
    }
}