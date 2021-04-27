<?php

namespace App\Service;

interface PhoneNumberValidatorInterface
{
    /**
     * Validate a phone number for a country.
     *
     * @param string $phoneNumber
     * @param string $country
     *
     * @return array|null Return an array if the api give a good response, null in case of error.
     */
    public function validate(string $phoneNumber, string $country): ?array;
}
