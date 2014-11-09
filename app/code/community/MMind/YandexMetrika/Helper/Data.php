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
 * @category   helper
 * @package    MMind_YandexMetrika
 * @copyright  Copyright (c) 2014 MageMind (http://www.magemind.com)
 * @license    http://www.magemind.com/magento-license
 */
class MMind_YandexMetrika_Helper_Data extends Mage_Core_Helper_Abstract
{
    CONST XML_PATH_YANDEX_METRIKA_CODE = 'mmyandexmetrika/general/yandex_code';

    /**
     * Get Yandex Metrika Script Code
     * @return mixed
     */
    public function getYandexMetrikaCode()
    {
        return Mage::getStoreConfig(self::XML_PATH_YANDEX_METRIKA_CODE);
    }
}