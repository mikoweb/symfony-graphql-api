<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\Entity;

use App\Entity\Interfaces\BlameableInterface;
use App\Entity\Interfaces\TimestampableInterface;
use App\Entity\Traits\BlameableTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Validator\EventDatesAvareInterface;
use App\Validator\EventDatesConstraint;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Uid\UuidV4;
use ZipCodeValidator\Constraints\ZipCode as AssertZipCode;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @ORM\Table(name="events")
 *
 * @UniqueEntity(fields={"slug"}, errorPath="slug")
 * @UniqueEntity(fields={"id"}, errorPath="id")
 *
 * @EventDatesConstraint()
 *
 * @ExclusionPolicy("all")
 */
class Event implements TimestampableInterface, BlameableInterface, EventDatesAvareInterface
{
    use TimestampableTrait;
    use BlameableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", name="id", unique=true)
     *
     * @Expose
     */
    private string $id;

    /**
     * @ORM\Column(type="string", name="name", nullable=false, length=50)
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     *
     * @Expose
     */
    private string $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", name="slug", unique=true, nullable=false, length=50)
     *
     * @Assert\Length(max=50)
     *
     * @Expose
     */
    private string $slug;

    /**
     * @ORM\Column(type="string", name="street_address", nullable=false, length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     *
     * @Expose
     */
    private string $streetAddress;

    /**
     * @ORM\Column(type="string", name="country", nullable=false, length=2)
     * @Assert\NotBlank()
     * @Assert\Length(max=2)
     *
     * @Expose
     */
    private string $country;

    /**
     * @ORM\Column(type="string", name="city", nullable=false, length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     *
     * @Expose
     */
    private string $city;

    /**
     * @ORM\Column(type="string", name="zipcode", nullable=false, length=25)
     * @Assert\NotBlank()
     * @Assert\Length(max=25)
     * @AssertZipCode(getter="getCountry")
     *
     * @Expose
     */
    private string $zipcode;

    /**
     * @ORM\Column(type="string", name="email", nullable=false, length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     * @Assert\Email()
     *
     * @Expose
     */
    private string $email;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_from", type="datetime", nullable=false)
     * @Assert\NotNull()
     * @Assert\Type(type="\DateTimeInterface", message="Invalid date")
     *
     * @Expose
     */
    private DateTime $dateFrom;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_to", type="datetime", nullable=false)
     * @Assert\NotNull ()
     * @Assert\Type(type="\DateTimeInterface", message="Invalid date")
     *
     * @Expose
     */
    private DateTime $dateTo;

    public function __construct(
        string $name,
        string $streetAddress,
        string $country,
        string $city,
        string $zipcode,
        string $email,
        DateTime $dateFrom,
        DateTime $dateTo
    )
    {
        $this->id = Uuid::v4();
        $this->name = $name;
        $this->streetAddress = $streetAddress;
        $this->country = $country;
        $this->city = $city;
        $this->zipcode = $zipcode;
        $this->email = $email;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function getId(): UuidV4|string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(string $streetAddress): self
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getDateFrom(): DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setDateFrom(DateTime $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(DateTime $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }
}
