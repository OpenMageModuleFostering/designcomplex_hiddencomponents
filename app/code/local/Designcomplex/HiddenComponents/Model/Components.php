<?php

class Designcomplex_HiddenComponents_Model_Components
{
    const XML_PATH_COMPONENTS_VISIBILITY = 'catalog/components_visibility/%s';
    
    protected $_comopsites = array('configurable', 'bundle', 'grouped');
    
    
    public function hide(Mage_Catalog_Model_Product $product)
    {
        $typeId = $product->getTypeId();
        if (in_array($typeId, $this->_comopsites)) {
            $visibility = $this->_getVisibilitySetting($product);
            if ($visibility) {
                $children = $product->getTypeInstance(false)->getChildrenIds($product->getId(), false);
                foreach ($children as $components) {
                    foreach ($components as $childId) {
                        Mage::getModel('catalog/product')->setStoreId($product->getStoreId())->load($childId)
                                ->setVisibility($visibility)->save();
                    }
                }
            }
        }
    }
    
    protected function _getVisibilitySetting(Mage_Catalog_Model_Product $product)
    {
        return Mage::getStoreConfig(sprintf(self::XML_PATH_COMPONENTS_VISIBILITY, $product->getTypeId()),
                                        $product->getStoreId());
    }

    public function traverseCatalog()
    {
        foreach ($this->_comopsites as $productType) {
            $visibility = Mage::getStoreConfig(sprintf(self::XML_PATH_COMPONENTS_VISIBILITY, $productType),
                Mage::app()->getStore()->getId());
            if ($visibility) {
                /** @var Mage_Catalog_Model_Resource_Product_Collection $productCollection */
                $productCollection = Mage::getModel('catalog/product')->getResourceCollection();
                $productCollection->addAttributeToFilter('type_id', $productType);
                foreach ($productCollection as $product) {
                    $this->hide($product);
                }
            }
        }
    }
}