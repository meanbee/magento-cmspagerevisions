<?php

class Meanbee_CmsPageRevisions_Block_Cms_Page_Edit_Tab_Revisions
extends Mage_Adminhtml_Block_Widget_Form
implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        // your tab code here
        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return Mage::helper('cms')->__('Revisions');
    }

    public function getTabTitle()
    {
        return Mage::helper('cms')->__('Revisions');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}