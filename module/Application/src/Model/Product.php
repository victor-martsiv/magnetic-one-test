<?php

namespace Application\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as DoctrineCollection;
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
     * @ORM\Column(name="id",type="integer")
     */
    private int $id;
    /**
     * @ORM\Column(name="shopify_product_id", type="bigint",nullable=false)
     */
    private int $shopifyProductId;
    /**
     * @ORM\Column(name="title",type="string",length=255,nullable=false)
     */
    private string $title;
    /**
     * @ORM\Column(name="description",type="text")
     */
    private string $description;
    /**
     * @ORM\Column(name="prise",type="string",length=255,nullable=false)
     */
    private string $prise;
    /**
     * @ORM\Column(name="photo",type="string",length=255,nullable=false)
     */
    private string $photo;
    /**
     * @ORM\Column(name="sku",type="string",length=255,nullable=false)
     */
    private string $sku;
    /**
     * @ORM\Column(name="quantity",type="string",length=255,nullable=false)
     */
    private string $quantity;

    /**
     * @ORM\ManyToMany(targetEntity="\Application\Model\Collection", inversedBy="products")
     * @ORM\JoinTable(name="product_collection",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="collection_id", referencedColumnName="id")}
     *      )
     */
    protected DoctrineCollection $collections;

    public function __construct()
    {
        $this->collections = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
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

    public function getQuantity(): string
    {
        return $this->quantity;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
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

    public function setQuantity(string $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getShopifyProductId(): int
    {
        return $this->shopifyProductId;
    }

    public function setShopifyProductId(int $shopifyProductId): void
    {
        $this->shopifyProductId = $shopifyProductId;
    }

    public function getCollections(): DoctrineCollection
    {
        return $this->collections;
    }

    public function addCollection(Collection $collection): void
    {
        $this->collections[] = $collection;
    }

    public function removeCollectionAssociation(Collection $collection): void
    {
        $this->collections->removeElement($collection);
    }


}
