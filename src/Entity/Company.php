<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company_website;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company_email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company_password;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="company", orphanRemoval=true)
     */
    private $offer;

    public function __construct()
    {
        $this->offer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function setCompanyName(string $company_name): self
    {
        $this->company_name = $company_name;

        return $this;
    }

    public function getCompanyWebsite(): ?string
    {
        return $this->company_website;
    }

    public function setCompanyWebsite(string $company_website): self
    {
        $this->company_website = $company_website;

        return $this;
    }

    public function getCompanyEmail(): ?string
    {
        return $this->company_email;
    }

    public function setCompanyEmail(string $company_email): self
    {
        $this->company_email = $company_email;

        return $this;
    }

    public function getCompanyPassword(): ?string
    {
        return $this->company_password;
    }

    public function setCompanyPassword(string $company_password): self
    {
        $this->company_password = $company_password;

        return $this;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getOffer(): Collection
    {
        return $this->offer;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offer->contains($offer)) {
            $this->offer[] = $offer;
            $offer->setCompany($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offer->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getCompany() === $this) {
                $offer->setCompany(null);
            }
        }

        return $this;
    }
}
