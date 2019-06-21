<?php

namespace UserForce\Scraper;

use GuzzleHttp\Exception\GuzzleException;
use UserForce\Scraper\Contracts\ScraperContract;
use UserForce\Scraper\Contracts\ResultContract;
use UserForce\Scraper\Validator\InputValidator;
use UserForce\Scraper\Validator\ConfigValidator;

class Scraper implements ScraperContract
{
    /**
     * @var Result
     */
    private $result;

    /**
     * @var
     */
    private $retriever;

    /**
     * @var InputValidator
     */
    private $inputValidator;

    /**
     * @var ConfigValidator
     */
    private $configValidator;

    /**
     * Scraper constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * @param array $input
     * @param array $config
     * @return ResultContract
     */
    public function find(array $input, array $config = []): ResultContract
    {
        $this->validate($input, $config);
        if (!$this->result->hasErrors()) {
            try {
                $data = $this->retriever->get($input);
                $this->result->setData($data);
            } catch (GuzzleException $exception) {
                $this->result->addErrors($exception->getMessage());
            }
        }

        return $this->result;
    }

    /**
     * return void
     */
    private function init(): void
    {
        $this->result = new Result();
        $this->retriever = new Retriever();
        $this->inputValidator = new InputValidator();
        $this->configValidator = new ConfigValidator();

        return;
    }

    /**
     * @param array $input
     * @param array $config
     * @return bool
     */
    private function validate(array $input, array $config = []): bool
    {
        $isValid = true;
        $validators = [$this->inputValidator->validate($input), $this->configValidator->validate($config)];
        foreach ($validators as $validator) {
            if (!$validator->isValid()) {
                $this->result->addErrors($validator);
                $isValid = false;
            }
        }

        return $isValid;
    }
}