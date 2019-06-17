<?php
namespace UserForce\Scraper\Validator;

class ConfigValidator extends Validator
{
    /**
     * @param array $input
     * @param string $optionKey
     * @return Validator
     */
    public function validate(array $input, string $optionKey = ''): Validator
    {
        return $this;
    }
}