<?php

namespace Kata09\Dao;

/**
 * Interface DaoInterface
 * @package Kata09\Dao
 */
interface DaoInterface
{
    /**
     * Finds all entities
     *
     * @return mixed
     */
    public function findAll();
}
