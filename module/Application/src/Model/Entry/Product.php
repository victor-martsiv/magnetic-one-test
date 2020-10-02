<?php

namespace Application\Model\Entry;

use ArrayObject;

class Product extends ArrayObject
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
        parent::__construct($data);
        $this->id          = (int)($data['id'] ?? null);
        $this->name        = $data['name'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->prise       = $data['prise'] ?? '';
        $this->photo       = $data['photo'] ?? null;
        $this->sku         = $data['sku'] ?? '';
        $this->quantity    = (int)($data['quantity'] ?? null);
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
