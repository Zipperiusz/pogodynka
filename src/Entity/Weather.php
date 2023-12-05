<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeatherRepository::class)]
class Weather
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datetime = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 1)]
    private ?string $temperature = null;

    #[ORM\Column(nullable:true)]
    private ?int $humidity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2,nullable:true)]
    private ?string $wind = null;

    #[ORM\Column(nullable:true)]
    private ?int $rainchance = null;

    #[ORM\Column(nullable:true)]
    private ?bool $isgrilltime = null;

    #[ORM\ManyToOne(inversedBy: 'weather')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): static
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(string $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    public function setHumidity(int $humidity): static
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getWind(): ?string
    {
        return $this->wind;
    }

    public function setWind(string $wind): static
    {
        $this->wind = $wind;

        return $this;
    }

    public function getRainchance(): ?int
    {
        return $this->rainchance;
    }

    public function setRainchance(int $rainchance): static
    {
        $this->rainchance = $rainchance;

        return $this;
    }

    public function isIsgrilltime(): ?bool
    {
        return $this->isgrilltime;
    }

    public function setIsgrilltime(bool $isgrilltime): static
    {
        $this->isgrilltime = $isgrilltime;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }
}
