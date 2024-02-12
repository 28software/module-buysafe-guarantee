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
 * ViewModel Tracker for the BuySafe Guarantee
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
     * Is the module active?
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->config->isActive();
    }

    /**
     * Is the PDP image hidden?
     *
     * @return bool
     */
    public function isPdpImageHidden(): bool
    {
        return !$this->config->isShowPdpImage();
    }

    /**
     * Get the store number
     *
     * @return string
     */
    public function getStoreNumber(): string
    {
        return $this->config->getStoreNumber();
    }

    /**
     * Get the script URL
     *
     * @return string
     */
    public function getScriptUrl(): string
    {
        return $this->config->getBasePath() . '?SN=' . $this->config->getStoreNumber() . '&t10';
    }

    /**
     * Get the order currency code
     *
     * @param string $incrementId
     *
     * @return string
     */
    public function getOrderCurrencyCode(string $incrementId): string
    {
        return (string) $this->getOrder($incrementId)->getOrderCurrencyCode();
    }

    /**
     * Get the order subtotal
     *
     * @param string $incrementId
     *
     * @return float
     */
    public function getOrderSubtotal(string $incrementId): float
    {
        return (float) $this->getOrder($incrementId)->getSubtotal();
    }

    /**
     * Get the order customer email
     *
     * @param string $incrementId
     *
     * @return string
     */
    public function getOrderCustomerEmail(string $incrementId): string
    {
        return $this->getOrder($incrementId)->getCustomerEmail();
    }

    /**
     * Get the order by incrementId
     *
     * @param string $incrementId
     *
     * @return Order
     */
    private function getOrder(string $incrementId): Order
    {
        return $this->order->loadByIncrementId($incrementId);
    }
}
