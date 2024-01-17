<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $lastName = null;

    #[ORM\ManyToOne(inversedBy: 'participant')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Contest $contest = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getContest(): ?Contest
    {
        return $this->contest;
    }

    public function setContest(?Contest $contest): static
    {
        $this->contest = $contest;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getFullName(): string
    {
        return $this->name." ".$this->lastName;
    }

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context) {
        if($this->startDate >= $this->endDate)
        {
            $context->buildViolation('End date must be bigger than Start Date.')
            ->atPath('startDate')
            ->addViolation();
            $context->buildViolation('End date must be bigger than Start Date.')
            ->atPath('endDate')
            ->addViolation();
        }

        if( $this->startDate < $this->contest->getStartDate() || $this->startDate > $this->contest->getEndDate())
        {
            $context->buildViolation('Start date must be within the contest start and end dates.')
            ->atPath('startDate')
            ->addViolation();
        }

        if($this->endDate < $this->contest->getStartDate() || $this->endDate > $this->contest->getEndDate())
        {
            $context->buildViolation('End date must be within the contest start and end dates.')
                ->atPath('endDate')
                ->addViolation();
        }
    }
}
