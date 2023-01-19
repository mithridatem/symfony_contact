<?php

namespace App\Entity;

use App\Repository\TypeDemandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TypeDemandeRepository::class)]
class TypeDemande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ct'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['ct'])]
    private ?string $descTypeDemande = null;

    #[ORM\OneToMany(mappedBy: 'typeDemandes', targetEntity: Contact::class)]
    private Collection $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescTypeDemande(): ?string
    {
        return $this->descTypeDemande;
    }

    public function setDescTypeDemande(string $descTypeDemande): self
    {
        $this->descTypeDemande = $descTypeDemande;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setTypeDemandes($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getTypeDemandes() === $this) {
                $contact->setTypeDemandes(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->descTypeDemande;
    }
}
