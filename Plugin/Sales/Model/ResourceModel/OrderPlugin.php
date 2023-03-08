<?php
/**
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is provided with Magento in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * Copyright © 2022 MultiSafepay, Inc. All rights reserved.
 * See DISCLAIMER.md for disclaimer details.
 *
 */

declare(strict_types=1);

namespace MultiSafepay\OrderSaveInspector\Plugin\Sales\Model\ResourceModel;

use Exception;
use Magento\Framework\Model\AbstractModel;
use Magento\Sales\Model\ResourceModel\Order as OrderResourceModel;
use Magento\Sales\Model\Order as OrderModel;
use MultiSafepay\ConnectCore\Logger\Logger;

class OrderPlugin
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Logger $logger
     */
    public function __construct(
        Logger $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * Log the order status and debug backtrace before saving the order
     *
     * @param OrderResourceModel $subject
     * @param AbstractModel $object
     * @return null
     * @throws Exception
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSave(OrderResourceModel $subject, AbstractModel $object)
    {
        $incrementId = 'unknown';

        if (method_exists($object, 'getIncrementId')) {
            $incrementId = $object->getIncrementId();
        }

        $state = 'unknown';

        if (method_exists($object, 'getState')) {
            $state = $object->getState();
        }

        $this->logger->logInfoForOrder($incrementId, 'Order is being saved, state: ' . $state);

        if ($state === OrderModel::STATE_PENDING_PAYMENT) {
            try {
                // Backtrace depth set to 30 as default, increase when backtrace does not provide enough information
                $backtraceMaxDepth = 30;
                $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $backtraceMaxDepth);
                $backtrace = json_encode($backtrace, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            } catch (Exception $exception) {
                $this->logger->logExceptionForOrder($incrementId, $exception);
            }

            $this->logger->logInfoForOrder(
                $incrementId,
                'Status pending_payment detected, outputting backtrace: ' . $backtrace
            );

        }

        return null;
    }
}
