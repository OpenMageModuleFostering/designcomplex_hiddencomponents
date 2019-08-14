<?php


class Designcomplex_HiddenComponents_Model_System_Config_Source_ComponentVisibility
{
    public function toOptionArray()
    {
        $options = Mage::getModel('catalog/product_visibility')->getAllOptions();
        if ($options[0]['value'] != '') {
            throw new Exception('Unexpected default value of product visibility');
        }
        $options[0]['label'] = 'Leave As Is';
        return $options;
    }
}