<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppProduct
 *
 * @ORM\Table(name="app_product")
 * @ORM\Entity
 */
class AppProduct
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagen", type="string", length=100, nullable=true)
     */
    private $imagen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getImagen(): string
    {
        return $this->imagen;
    }

    /**
     * @param string|null $imagen
     */
    public function setImagen(string $imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @return string|null
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
}
