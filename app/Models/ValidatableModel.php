<?php

namespace App\Models;

interface ValidatableModel
{
    /**
     * Returns validation rules for Model
     * @return array
     */
    public function getValidationRules(): array;
}
