<?php

class Designcomplex_HiddenComponents_Adminhtml_HiddencomponentsController extends Mage_Adminhtml_Controller_Action
{
    public function applyAction()
    {
        try {
            Mage::getModel('hiddencomponents/components')->traverseCatalog();
            $this->_getSession()->addSuccess('Products\'s visibility has been changed.');
        } catch (Exception $e) {
            Mage::logException($e);
            $this->_getSession()->addError($e->getMessage());
        }
        $this->_redirectUrl($this->getUrl('adminhtml/system_config/edit', array('section' => 'catalog')));
    }
}