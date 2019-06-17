<?php

namespace UserForce\Scraper;

use UserForce\Scraper\Contracts\ScraperContract;
use UserForce\Scraper\Contracts\ResultContract;
use UserForce\Scraper\Validator\InputValidator;
use UserForce\Scraper\Validator\ConfigValidator;

class Scraper implements ScraperContract
{
    /**
     * @param array $input
     * @param array $config
     * @return ResultContract
     * @throws Exceptions\InputException
     */
    public function get(array $input, array $config = []): ResultContract
    {
        $inputValidator = new InputValidator();
        $configValidator = new ConfigValidator();


        dump($inputValidator->validate($input)->isValid());

        $result = [];

        return new Result($result);
    }
}