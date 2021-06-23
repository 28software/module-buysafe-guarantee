<?php
/**
 * Copyright © 28Software (https://28software.com)
 * See LICENSE for the license details.
 */
declare(strict_types = 1);

namespace TESoftware\BuySafeGuarantee\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Config
 */
class Config
{
    private const PATH_ACTIVE       = 'buysafe/general/active';
    private const PATH_STORE_NUMBER = 'buysafe/general/store_number';
    private const PATH_BASE_URL     = 'buysafe/general/base_url';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool)$this->scopeConfig->isSetFlag(self::PATH_ACTIVE);
    }

    /**
     * @return string
     */
    public function getStoreNumber(): string
    {
        return (string)$this->scopeConfig->getValue(self::PATH_STORE_NUMBER);
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return (string)$this->scopeConfig->getValue(self::PATH_BASE_URL);
    }
}
