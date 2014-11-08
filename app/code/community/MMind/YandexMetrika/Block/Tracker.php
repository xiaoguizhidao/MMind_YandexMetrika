<?php

/**
 * MageMind
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magemind.com/magento-license
 *
 * @category   block
 * @package    MMind_YandexMetrika
 * @copyright  Copyright (c) 2014 MageMind (http://www.magemind.com)
 * @license    http://www.magemind.com/magento-license
 */
class MMind_YandexMetrika_Block_Tracker extends Mage_Core_Block_Template
{
    /**
     * Get Yandex Metrika Code Script
     * @return mixed
     */
    public function getYandexMetrikaCode()
    {
        $helper = Mage::helper('mmind_yandexmetrika');
        return $helper->getYandexMetrikaCode();
    }

    /**
     * Get Yandex Metrika Code with Goal Checkout Success
     * @return string
     */
    public function getYandexMetrikaCodeGoalSuccess()
    {
        $lastid = Mage::getSingleton('checkout/type_onepage')->getCheckout()->getLastOrderId();
        if (!$lastid)
            return false;

        $order = Mage::getSingleton('sales/order');
        $order->load($lastid);
        if (!$order)
            return false;

        $options = array();

        $options['order_id'] = (string)$order->getIncrementId();
        $options['currency'] = Mage::app()->getStore()->getCurrentCurrencyCode();
        $options['exchange_rate'] = 1;
        $options['goods'] = array();
        $options['order_price'] = $order->getGrandTotal();
        foreach ($order->getAllVisibleItems() as $item) {
            $options['goods'][] = array('id' => $item->getSku(),
                'name' => $item->getName(),
                'price' => $item->getPrice(),
                'quantity' => (int)$item->getQtyOrdered());
        }
        $json = json_encode($options);

        $options = <<<EOF
<script>
var yaParams = {$json};
</script>
EOF;
        return $options . $this->getYandexMetrikaCode();
    }
}