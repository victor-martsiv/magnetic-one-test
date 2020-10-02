<?php

namespace Application\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="collections")
 */
class Collection
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
     * @ORM\ManyToMany(targetEntity="\Application\Model\Product", mappedBy="collections")
     */
    protected ArrayCollection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    public function addProduct($product): void
    {
        $this->products[] = $product;
    }
}
