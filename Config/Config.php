<?php
/**
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is provided with Magento in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * Copyright © MultiSafepay, Inc. All rights reserved.
 * See DISCLAIMER.md for disclaimer details.
 */

declare(strict_types=1);

namespace MultiSafepay\OrderSaveInspector\Config;

use Magento\Store\Model\ScopeInterface;
use MultiSafepay\ConnectCore\Config\Config as CoreConfig;

class Config extends CoreConfig
{
    public const ORDER_SAVE_INSPECTOR_PATH_PATTERN = 'multisafepay/order_save_inspector/%s';
    public const ORDER_SAVE_INSPECTOR_ACTIVE = 'active';
    public const ORDER_SAVE_INSPECTOR_BACKTRACE_DEPTH = 'backtrace_depth';

    /**
     * Get the value of a OrderSaveInspector config field
     *
     * @param string $field
     * @param int|null $storeId
     * @return mixed
     */
    public function getOrderSaveInspectorValue(string $field, ?int $storeId = null)
    {
        return $this->scopeConfig->getValue(
            sprintf(self::ORDER_SAVE_INSPECTOR_PATH_PATTERN, $field),
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
