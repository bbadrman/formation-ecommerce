<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="le nom du produit est obligatoire")
     * @Assert\Length(min=3, max=255, minMessage="le nom du produit doivent superieur au 3 caractaires")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="le prix du produit est obligatoirement")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(message="le photo principale doit etre une url valide")
     * @Assert\NotBlank(message="la photo principale est obligatoirement")
     */
    private $mainPicture;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="la discription  du produit est obligatoirement")
     * @Assert\Length(min=20, max=255, minMessage="la discription du produit doivent étre au moins au 20 caractaires")
     */
    private $shortDescription;

    /**
     * @ORM\ManyToMany(targetEntity=Purchase::class, mappedBy="products")
     */
    private $purchases;

    public function __construct()
    {
        $this->purchases = new ArrayCollection();
    }

    // public static function loadValidatorMetadata(ClassMetadata $metadata){
    //     $metadata->addPropertyConstraints('name',[
    //         new Assert\NotBlank(['message' => 'Le nom du produit est obligatoir']),
    //         new Assert\Length(['min' =>3, 'max' => 255, 'minMessage' => 'Le nom du produit doit contenaire ou mois 3 caractaires '])
        
    //     ]); 
    //     $metadata->addPropertyConstraint('price', new Assert\NotBlank(['message' => 'Le prix du produit est oobligatoir']));

    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMajName(): ?string{
        return strtoupper($this->name);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getMainPicture(): ?string
    {
        return $this->mainPicture;
    }

    public function setMainPicture(?string $mainPicture): self
    {
        $this->mainPicture = $mainPicture;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * @return Collection<int, Purchase>
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchase $purchase): self
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases[] = $purchase;
            $purchase->addProduct($this);
        }

        return $this;
    }

    public function removePurchase(Purchase $purchase): self
    {
        if ($this->purchases->removeElement($purchase)) {
            $purchase->removeProduct($this);
        }

        return $this;
    }
}
