<?php

class Meanbee_CmsPageRevisions_Block_Adminhtml_Cms_Page_Edit_Tab_Grid_Renderer_Action extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{
    public function render(Varien_Object $row)
    {
        $actions = array( array(
                'url' => $this->getUrl('*/*/restore', array('id' => $row->getRevisionId())),
                'caption' => Mage::helper('newsletter')->__('Restore this Version')
            ),
            array(
                'url'     => $this->getUrl('*/*/delete', array('id'=>$row->getRevisionId())),
                'caption' => Mage::helper('newsletter')->__('Delete this Version')
            )
        );

        $this->getColumn()->setActions($actions);

        return parent::render($row);
    }
}
