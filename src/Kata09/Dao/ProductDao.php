<?php

namespace Kata09\Dao;

use Kata09\DataObject\Product;

/**
 * Class ProductDao
 * @package Kata09\Dao
 */
class ProductDao implements DaoInterface
{

    /**
     * Static product list just for the purpose of this kata, otherwise this data would come from a database
     *
     * Note: As this just represents the data from the kata, you can stub them in the tests if you want to try
     * different sets.
     *
     * @var array
     */
    private $products;

    /**
     * ProductDao constructor.
     */
    public function __construct()
    {
        $this->products = [
            'A' => new Product('A', 50),
            'B' => new Product('B', 30),
            'C' => new Product('C', 20),
            'D' => new Product('D', 15),
        ];
    }

    /**
     * @return array|mixed
     */
    public function findAll()
    {
        return array_values($this->products);
    }

    /**
     * @param $id
     * @return Product|null
     */
    public function findOneById($id)
    {
        return $this->products[$id] ?? null;
    }
}
