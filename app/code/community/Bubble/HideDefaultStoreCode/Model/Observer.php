<?php
/**
 * @category    Bubble
 * @package     Bubble_HideDefaultStoreCode
 * @version     1.0.1
 * @copyright   Copyright (c) 2015 BubbleShop (https://www.bubbleshop.net)
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
            $requestUri = $request->getRequestUri();
            $requestUri = str_replace($request->getServer('SCRIPT_NAME'), '', $requestUri);
            $requestUri = trim($requestUri, '/');
            $pieces = explode('/', $requestUri);
            if (!in_array($pieces[0], $this->_getStoreCodes())) {
                $storeCode = $this->_getDefaultStore()->getCode();
                if (!empty($storeCode)) {
                    $requestUri = $request->getServer('SCRIPT_NAME') . '/' . $storeCode . '/' . $requestUri;
                    $request->setRequestUri($requestUri);
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