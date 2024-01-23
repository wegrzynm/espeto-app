<?php

namespace App\Entity;

use App\Repository\ContestHostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContestHostRepository::class)]
class ContestHost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\OneToMany(mappedBy: 'contestHost', targetEntity: Contest::class)]
    private Collection $contests;

    public function __construct()
    {
        $this->contests = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Contest>
     */
    public function getContests(): Collection
    {
        return $this->contests;
    }

    public function addContest(Contest $contest): static
    {
        if (!$this->contests->contains($contest)) {
            $this->contests->add($contest);
            $contest->setContestHost($this);
        }

        return $this;
    }

    public function removeContest(Contest $contest): static
    {
        if ($this->contests->removeElement($contest)) {
            // set the owning side to null (unless already changed)
            if ($contest->getContestHost() === $this) {
                $contest->setContestHost(null);
            }
        }

        return $this;
    }

    public function getFullName(): string
    {
        return $this->name." ".$this->lastName;
    }
}
