<?php

namespace App\Entity;

use App\Repository\ContractRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractRepository::class)]
class Contract
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $hourStartContract;

    #[ORM\Column(type: 'time', nullable: true)]
    private $hourEndContract;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateStartContract;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateEndContract;

    #[ORM\Column(type: 'text', nullable: true)]
    private $review;

    #[ORM\Column(type: 'datetime_immutable')]
    private $reviewDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHourStartContract(): ?\DateTimeInterface
    {
        return $this->hourStartContract;
    }

    public function setHourStartContract(?\DateTimeInterface $hourStartContract): self
    {
        $this->hourStartContract = $hourStartContract;

        return $this;
    }

    public function getHourEndContract(): ?\DateTimeInterface
    {
        return $this->hourEndContract;
    }

    public function setHourEndContract(?\DateTimeInterface $hourEndContract): self
    {
        $this->hourEndContract = $hourEndContract;

        return $this;
    }

    public function getDateStartContract(): ?\DateTimeInterface
    {
        return $this->dateStartContract;
    }

    public function setDateStartContract(?\DateTimeInterface $dateStartContract): self
    {
        $this->dateStartContract = $dateStartContract;

        return $this;
    }

    public function getDateEndContract(): ?\DateTimeInterface
    {
        return $this->dateEndContract;
    }

    public function setDateEndContract(?\DateTimeInterface $dateEndContract): self
    {
        $this->dateEndContract = $dateEndContract;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getReviewDate(): ?\DateTimeImmutable
    {
        return $this->reviewDate;
    }

    public function setReviewDate(\DateTimeImmutable $reviewDate): self
    {
        $this->reviewDate = $reviewDate;

        return $this;
    }
}
