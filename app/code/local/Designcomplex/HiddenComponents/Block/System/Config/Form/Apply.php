<?php

class Designcomplex_HiddenComponents_Block_System_Config_Form_Apply
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * Set template to itself
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->setTemplate('hiddencomponents/system/config/apply.phtml');
        return $this;
    }

    /**
     * Get the button and scripts contents
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $originalData = $element->getOriginalData();
        $this->addData(array(
            'button_label' => Mage::helper('hiddencomponents')->__($originalData['button_label']),
            'html_id' => $element->getHtmlId(),
            'submit_url' => Mage::getSingleton('adminhtml/url')->getUrl('adminhtml/hiddencomponents/apply')
        ));

        return $this->_toHtml();
    }
}
