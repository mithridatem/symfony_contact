<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ct'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['ct'])]
    private ?string $objetContact = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['ct'])]
    private ?string $contenuContact = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['ct'])]
    private ?\DateTimeInterface $dateContact = null;

    #[ORM\Column(length: 50)]
    #[Groups(['ct'])]
    private ?string $nomContact = null;

    #[ORM\Column(length: 50)]
    #[Groups(['ct'])]
    private ?string $prenomContact = null;

    #[ORM\Column(length: 50)]
    #[Groups(['ct'])]
    private ?string $mailContact = null;

    #[ORM\Column(length: 50)]
    #[Groups(['ct'])]
    private ?string $entrepriseContact = null;

    #[ORM\ManyToOne(inversedBy: 'contacts')]
    #[Groups(['ct'])]
    private ?TypeDemande $typeDemandes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjetContact(): ?string
    {
        return $this->objetContact;
    }

    public function setObjetContact(string $objetContact): self
    {
        $this->objetContact = $objetContact;

        return $this;
    }

    public function getContenuContact(): ?string
    {
        return $this->contenuContact;
    }

    public function setContenuContact(string $contenuContact): self
    {
        $this->contenuContact = $contenuContact;

        return $this;
    }

    public function getDateContact(): ?\DateTimeInterface
    {
        return $this->dateContact;
    }

    public function setDateContact(\DateTimeInterface $dateContact): self
    {
        $this->dateContact = $dateContact;

        return $this;
    }

    public function getNomContact(): ?string
    {
        return $this->nomContact;
    }

    public function setNomContact(string $nomContact): self
    {
        $this->nomContact = $nomContact;

        return $this;
    }

    public function getPrenomContact(): ?string
    {
        return $this->prenomContact;
    }

    public function setPrenomContact(string $prenomContact): self
    {
        $this->prenomContact = $prenomContact;

        return $this;
    }

    public function getMailContact(): ?string
    {
        return $this->mailContact;
    }

    public function setMailContact(string $mailContact): self
    {
        $this->mailContact = $mailContact;

        return $this;
    }

    public function getEntrepriseContact(): ?string
    {
        return $this->entrepriseContact;
    }

    public function setEntrepriseContact(string $entrepriseContact): self
    {
        $this->entrepriseContact = $entrepriseContact;

        return $this;
    }

    public function getTypeDemandes(): ?TypeDemande
    {
        return $this->typeDemandes;
    }

    public function setTypeDemandes(?TypeDemande $typeDemandes): self
    {
        $this->typeDemandes = $typeDemandes;

        return $this;
    }
}
