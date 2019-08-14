<?php

class Designcomplex_HiddenComponents_Model_Observer
{
    public function productSaveListener(Varien_Event_Observer $observer)
    {
        $product = $observer->getProduct();
        Mage::getModel('hiddencomponents/components')->hide($product);
    }
}