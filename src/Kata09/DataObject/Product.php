<?php


namespace Kata09\DataObject;

/**
 * Class Product
 * @package Kata09\DataObject
 */
class Product
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $price;

    public function __construct($id, $price)
    {
        $this->id = $id;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
}