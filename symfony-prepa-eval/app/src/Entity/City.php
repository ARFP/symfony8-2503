<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CityRepository;
use Doctrine\ORM\Mapping as ORM;

use function Symfony\Component\Clock\now;

#[ORM\Entity(repositoryClass: CityRepository::class)]
#[ApiResource]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 6, name: "city_zipcode")]
    private ?string $city_zipcode = null;

    #[ORM\Column(length: 60)]
    private ?string $city_name = null;

    #[ORM\ManyToOne(inversedBy: 'cities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCityZipcode(): ?string
    {
        return $this->city_zipcode;
    }

    public function setCityZipcode(string $city_zipcode): static
    {
        $this->city_zipcode = $city_zipcode;

        return $this;
    }

    public function getCityName(): ?string
    {
        return $this->city_name;
    }

    public function setCityName(string $city_name): static
    {
        $this->city_name = $city_name;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }
}
