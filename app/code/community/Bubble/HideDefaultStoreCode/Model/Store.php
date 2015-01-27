<?php
/**
 * @category    Bubble
 * @package     Bubble_HideDefaultStoreCode
 * @version     1.0.1
 * @copyright   Copyright (c) 2015 BubbleShop (https://www.bubbleshop.net)
 */
class Bubble_HideDefaultStoreCode_Model_Store extends Mage_Core_Model_Store
{
    /**
     * @return bool
     */
    public function getStoreInUrl()
    {
        /** @var $helper Bubble_HideDefaultStoreCode_Helper_Data */
        $helper = Mage::helper('bubble_hdsc');

        if ($this->isAdmin() || !$helper->hideDefaultStoreCode()) {
            return parent::getStoreInUrl();
        }

        return $helper->hideDefaultStoreCode()
            && $this->getCode() !== Mage::app()->getDefaultStoreView()->getCode();
    }
}