<?php

namespace UserForce\Scraper\Validator;

use UserForce\Scraper\Contracts\ValidatorContract;

class Validator implements ValidatorContract
{
    /**
     * Validation result flag
     * @var bool
     */
    private $isValid = true;

    /**
     * Validation errors
     * @var array
     */
    private $errors = [];

    /**
     * @param array $data
     * @param string $optionKey
     * @return Validator
     */
    public function validate(array $data, string $optionKey = ''): Validator
    {
        if (empty($data)) {
            $this->addError('There is no available scraping definition.');
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * @param bool $isValid
     * @return Validator
     */
    protected function setValidity(bool $isValid): Validator
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * @param string $message
     * @return Validator
     */
    protected function addError(string $message): Validator
    {
        array_push($this->errors, $message);
        $this->setValidity(false);

        return $this;
    }

    /**
     * @param string $url
     * @param string $key
     * @return bool
     */
    protected function checkUrl(string $url, string $key = ''): bool
    {
        $isValidUrl = (boolean) filter_var($url, FILTER_VALIDATE_URL);
        if (!$isValidUrl) {
            $this->addError("The \"{$key}\" must be a valid URL.");
        }

        return (boolean) filter_var($url, FILTER_VALIDATE_URL);
    }
}