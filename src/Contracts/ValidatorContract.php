<?php
namespace UserForce\Scraper\Contracts;

use UserForce\Scraper\Validator\Validator;

interface ValidatorContract
{
    /**
     * @param array $data
     * @param string $optionKey
     * @return Validator
     */
    public function validate(array $data, string $optionKey = ''): Validator;

    /**
     * @return bool
     */
    public function isValid(): bool;

    /**
     * @return array
     */
    public function errors(): array;
}