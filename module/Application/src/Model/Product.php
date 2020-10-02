<?php

namespace Application\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    private int $id;
    /**
     * @ORM\Column(name="name")
     */
    private string $name;
    /**
     * @ORM\Column(name="description")
     */
    private string $description;
    /**
     * @ORM\Column(name="prise")
     */
    private string $prise;
    /**
     * @ORM\Column(name="photo")
     */
    private string $photo;
    /**
     * @ORM\Column(name="sku")
     */
    private string $sku;
    /**
     * @ORM\Column(name="quantity")
     */
    private int $quantity;

    /**
     * @ORM\ManyToMany(targetEntity="\Application\Model\Collection", inversedBy="products")
     * @ORM\JoinTable(name="product_collection",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="collection_id", referencedColumnName="id")}
     *      )
     */
    protected ArrayCollection $collections;

    public function __construct()
    {
        $this->collections = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrise(): string
    {
        return $this->prise;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    public function setPrise(string $prise): void
    {
        $this->prise = $prise;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }


    public function getCollections(): ArrayCollection
    {
        return $this->collections;
    }

    public function addCollection($collection): void
    {
        $this->collections[] = $collection;
    }


    public function removeCollectionAssociation($collection): void
    {
        $this->collections->removeElement($collection);
    }
}
