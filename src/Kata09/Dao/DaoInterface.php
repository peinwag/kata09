<?php


namespace Kata09\Dao;


interface DaoInterface
{
    /**
     * Finds all entities
     *
     * @return mixed
     */
    public function findAll();

    /**
     * Find one entity by its id
     *
     * @param $id
     * @return mixed
     */
    public function findOneById($id);
}