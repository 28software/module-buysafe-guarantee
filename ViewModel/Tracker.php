<?php
/**
 * Copyright © 28Software (https://28software.com)
 * See LICENSE for the license details.
 */
declare(strict_types = 1);

namespace TESoftware\BuySafeGuarantee\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Sales\Model\Order;
use TESoftware\BuySafeGuarantee\Model\Config;

/**
 * Class CheckoutTracker
 */
class Tracker implements ArgumentInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Order
     */
    private $order;

    /**
     * CheckoutTracker constructor.
     *
     * @param Config $config
     * @param Order  $order
     */
    public function __construct(
        Config $config,
        Order $order
    ) {
        $this->config = $config;
        $this->order = $order;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->config->isActive();
    }

    /**
     * @return string
     */
    public function getStoreNumber(): string
    {
        return $this->config->getStoreNumber();
    }

    /**
     * @return string
     */
    public function getScriptUrl(): string
    {
        return $this->config->getBaseUrl() . $this->config->getStoreNumber();
    }

    /**
     * @param string $incrementId
     *
     * @return string
     */
    public function getOrderCurrencyCode(string $incrementId): string
    {
        return (string) $this->getOrder($incrementId)->getOrderCurrencyCode();
    }

    /**
     * @param string $incrementId
     *
     * @return float
     */
    public function getOrderSubtotal(string $incrementId): float
    {
        return (float) $this->getOrder($incrementId)->getSubtotal();
    }

    /**
     * @param string $incrementId
     *
     * @return string
     */
    public function getOrderCustomerEmail(string $incrementId): string
    {
        return $this->getOrder($incrementId)->getCustomerEmail();
    }

    /**
     * @param string $incrementId
     *
     * @return Order
     */
    private function getOrder(string $incrementId): Order
    {
        return $this->order->loadByIncrementId($incrementId);
    }
}
