<?php

namespace Kata09;

interface Purchasable
{
    public function getPrice();

    public function getQty();

    public function getBasePrice();

    public function getSku();

    public function incrementQty($qty);

    public function decrementQty($qty);
}
