<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $label;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Babysitter::class, mappedBy: 'languages')]
    private $babysitters;

    public function __construct()
    {
        $this->babysitters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Babysitter>
     */
    public function getBabysitters(): Collection
    {
        return $this->babysitters;
    }

    public function addBabysitter(Babysitter $babysitter): self
    {
        if (!$this->babysitters->contains($babysitter)) {
            $this->babysitters[] = $babysitter;
            $babysitter->addLanguage($this);
        }

        return $this;
    }

    public function removeBabysitter(Babysitter $babysitter): self
    {
        if ($this->babysitters->removeElement($babysitter)) {
            $babysitter->removeLanguage($this);
        }

        return $this;
    }
}
