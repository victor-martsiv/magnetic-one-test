<?php

namespace Application\Model;

class Product
{
    private int $id;
    private string $name;
    private ?string $description;
    private string $prise;
    private ?string $photo;
    private string $sku;
    private int $quantity;

    public function __construct(array $data = [])
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrise(): string
    {
        return $this->prise;
    }

    public function getPhoto(): ?string
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
}
