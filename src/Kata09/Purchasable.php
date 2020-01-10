<?php

namespace Kata09;

/**
 * Interface Purchasable
 * @package Kata09
 */
interface Purchasable
{
    /**
     * @return mixed
     */
    public function getPrice();

    /**
     * @return int
     */
    public function getQty();

    /**
     * @return int
     */
    public function getBasePrice();

    /**
     * @return string
     */
    public function getSku();

    /**
     * @param int $qty
     * @return void
     */
    public function incrementQty(int $qty);

    /**
     * @param $qty
     * @return void
     */
    public function decrementQty(int $qty);
}
