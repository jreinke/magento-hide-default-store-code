<?php
/**
 * @category    Bubble
 * @package     Bubble_HideDefaultStoreCode
 * @version     1.0.0
 * @copyright   Copyright (c) 2014 BubbleShop (https://www.bubbleshop.net)
 */
class Bubble_HideDefaultStoreCode_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     */
    public function onFrontInitBefore(Varien_Event_Observer $observer)
    {
        if ($this->_canRewriteUri()) {
            /** @var $front Mage_Core_Controller_Varien_Front */
            $front = $observer->getEvent()->getFront();
            $request = $front->getRequest();
            $pieces = explode('/', $request->getRequestUri());
            if (!in_array($pieces[1], $this->_getStoreCodes())) {
                $storeCode = $this->_getDefaultStore()->getCode();
                if (!empty($storeCode)) {
                    $request->setRequestUri('/' . $storeCode . $request->getRequestUri());
                    $request->setActionName(null);
                }
            }
        }
    }

    /**
     * @return bool
     */
    protected function _canRewriteUri()
    {
        return !Mage::app()->getStore()->isAdmin()
            && Mage::helper('bubble_hdsc')->hideDefaultStoreCode();
    }

    /**
     * @return array
     */
    protected function _getStoreCodes()
    {
        $storeCodes = array();
        $default = $this->_getDefaultStore();
        foreach (Mage::app()->getStores() as $store) {
            /** @var $store Mage_Core_Model_Store */
            if ($store->getId() != $default->getId()) {
                $storeCodes[] = $store->getCode();
            }
        }

        return $storeCodes;
    }

    /**
     * @return Mage_Core_Model_Store
     */
    protected function _getDefaultStore()
    {
        return Mage::app()->getDefaultStoreView();
    }
}