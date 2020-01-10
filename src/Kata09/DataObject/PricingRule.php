<?php

namespace Kata09\DataObject;

/**
 * Class PricingRule
 * @package Kata09\DataObject
 */
class PricingRule
{
    /**
     * @var string
     */
    private $sku;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $dsl;

    /**
     * PricingRule constructor.
     * @param string $sku
     * @param string $type
     * @param string $dsl
     */
    public function __construct($sku, $type, $dsl)
    {
        $this->sku = $sku;
        $this->type = $type;
        $this->dsl = $dsl;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getDsl(): string
    {
        return $this->dsl;
    }

    /**
     * @param string $dsl
     */
    public function setDsl(string $dsl)
    {
        $this->dsl = $dsl;
    }
}
