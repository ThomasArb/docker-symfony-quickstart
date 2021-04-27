<?php

namespace App\Entity;

use App\Repository\CallbackRequestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CallbackRequest
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $nationalPhoneNumber;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $internationalPhoneNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getNationalPhoneNumber(): ?string
    {
        return $this->nationalPhoneNumber;
    }

    public function setNationalPhoneNumber(string $nationalPhoneNumber): self
    {
        $this->nationalPhoneNumber = $nationalPhoneNumber;

        return $this;
    }

    public function getInternationalPhoneNumber(): ?string
    {
        return $this->internationalPhoneNumber;
    }

    public function setInternationalPhoneNumber(string $internationalPhoneNumber): self
    {
        $this->internationalPhoneNumber = $internationalPhoneNumber;

        return $this;
    }
}
