<?php
namespace UserForce\Scraper;

use UserForce\Scraper\Contracts\ResultContract;
use UserForce\Scraper\Contracts\ValidatorContract;
use Illuminate\Support\Arr;

class Result implements ResultContract
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * Validation errors
     *
     * @var array
     */
    private $errors = [];

    /**
     * Returns "all or specified by dot notation" result(s).
     * @param string $destination
     * @return array
     */
    public function get(string $destination = ''): array
    {
        if (empty($destination)) {
            $result = $this->data;
        } else {
            $result = Arr::get($this->data, $destination);
        }

        return empty($result) ? [] : $result;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * @param ValidatorContract $validator
     * @return ResultContract
     */
    public function addErrors(ValidatorContract $validator): ResultContract
    {
        $this->errors = array_merge($this->errors, $validator->errors());

        return $this;
    }


}