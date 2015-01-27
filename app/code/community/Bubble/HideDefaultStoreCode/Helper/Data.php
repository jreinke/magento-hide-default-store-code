<?php
/**
 * @category    Bubble
 * @package     Bubble_HideDefaultStoreCode
 * @version     1.0.1
 * @copyright   Copyright (c) 2015 BubbleShop (https://www.bubbleshop.net)
 */
class Bubble_HideDefaultStoreCode_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @return bool
     */
    public function isEnabled()
    {
        return Mage::getStoreConfigFlag('web/url/hide_default_store');
    }

    /**
     * Should we remove default store code from URLs?
     *
     * @return bool
     */
    public function hideDefaultStoreCode()
    {
        return Mage::isInstalled()
            && Mage::getStoreConfigFlag('web/url/use_store')
            && $this->isEnabled();
    }
}