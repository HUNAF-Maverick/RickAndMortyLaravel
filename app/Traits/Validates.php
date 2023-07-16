<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

trait Validates
{

    /**
     * @var MessageBag
     */
    private $validationErrors;

    /**
     * @var \Illuminate\Contracts\Validation\Validator
     */
    private $validator;

    /**
     * return all validation rules
     * @return array
     */
    public function getValidationRules():array {
        return isset($this->rules) ? $this->rules : [];
    }

    /**
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(){

        $this->makeValidator($this->getValidationRules());
        $this->validator->validate();
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $this->makeValidator($this->getValidationRules());

        if($this->validator->fails()){
            $this->validationErrors = $this->validator->errors();
            return false;
        }
        return true;
    }

    /**
     * @param $validationRules
     * @param $ruleName
     * @return \Illuminate\Contracts\Validation\Validator|\Illuminate\Validation\Validator
     */
    protected function makeValidator($validationRules){

        $this->validator = Validator::make($this->attributesToArray(),$validationRules);
        return $this->validator;
    }

    /**
     * Get validation errors MessageBag object
     * @return MessageBag
     */
    public function getValidationErrorMessageBag() : MessageBag{
        return get_class($this->validationErrors) === MessageBag::class ? $this->validationErrors : new MessageBag();
    }

    /**
     * Get validation error messages
     * @param null $format
     * @return array
     */
    public function getValidationErrorMessages($format = null) : array {
        return $this->getValidationErrorMessageBag()->all($format);
    }
}
