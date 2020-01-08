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
     * static product store just for the purpose of this kata, otherwise this data would come from a database
     *
     * @var array
     */
    private $products;

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
     * @return mixed|null
     */
    public function findOneById($id)
    {
        return $this->products[$id] ?? null;
    }
}
