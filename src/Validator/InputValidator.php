<?php

namespace UserForce\Scraper\Validator;

use UserForce\Scraper\Exceptions\InputException;

class InputValidator extends Validator
{
    const URL = 'url';
    const REGEX = 'find';

    const REQUIRED_OPTIONS = [
        InputValidator::URL,
        InputValidator::REGEX,
    ];

    /**
     * @param array $input
     * @param string $optionKey
     * @return Validator
     * @throws InputException
     */
    public function validate(array $input, string $optionKey = ''): Validator
    {
        if ($this->hasRequired($input)) {
            $this->checkOption($input, $optionKey);
        } else {
            foreach ($input as $key => $value) {
                $this->validate($value, $key);
            }
        }

        return $this;
    }

    /**
     * @param array $data
     * @param string $key
     * @return bool
     * @throws InputException
     */
    private function checkOption(array $data, string $key): bool
    {
        $validRegex = $this->checkRegex($data[InputValidator::REGEX], $key);
        $validUrl = $this->checkUrl($data[InputValidator::URL], $key.'...'.InputValidator::URL);

        return $validRegex && $validUrl;
    }

    /**
     * @param array $data
     * @return bool
     */
    private function hasRequired(array $data): bool
    {
        return !array_diff(InputValidator::REQUIRED_OPTIONS, array_keys($data));
    }

    /**
     * Recursively check regular expressions.
     * @param $regex string|array
     * @param string $optionKey
     * @param string $item
     * @return bool
     * @throws InputException
     */
    private function checkRegex($regex, string $optionKey, string $item = ''): bool
    {
        if (empty($regex)) {
            throw new InputException("\"{$optionKey}...{$item}\" regular expression(s) must NOT be empty.");
        };

        if (is_array($regex)) {
            foreach ($regex as $item => $value) {
                $this->checkRegex($value, $optionKey, $item);
            }
        } elseif (!is_string($regex)) {
            $this->addError("The \"{$optionKey}...{$item}\" must be a valid regular expression.");
        }

        return is_string($regex);
    }
}