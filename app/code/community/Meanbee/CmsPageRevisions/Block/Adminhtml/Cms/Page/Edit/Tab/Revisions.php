<?php
class Meanbee_CmsPageRevisions_Block_Adminhtml_Cms_Page_Edit_Tab_Revisions extends Mage_Adminhtml_Block_Widget_Grid implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('revisions_section');
        $this->setDefaultSort('revision_id');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('meanbee_cmspagerevisions/cms_page_revisions')->getCollection()
            ->addFieldToFilter('page_id', array('eq' => $this->getRequest()->getParam('page_id')));
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('revision_id', array(
            'header'    => Mage::helper('meanbee_cmspagerevisions')->__('ID'),
            'sortable'  => true,
            'width'     => '60',
            'index'     => 'revision_id'
        ));
        $this->addColumn('revision_creation_time', array(
            'header'    => Mage::helper('meanbee_cmspagerevisions')->__('Creation Time'),
            'width'     => '80',
            'index'     => 'creation_time'
        ));
        $this->addColumn('revision_restore', array(
            'header' => Mage::helper('meanbee_cmspagerevisions')->__('Actions'),
            'align' => 'center',
            'renderer' => 'meanbee_cmspagerevisions/adminhtml_cms_page_edit_tab_grid_renderer_action',
            'index' => 'revision_id',
            'width' => '40'
        ));

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
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