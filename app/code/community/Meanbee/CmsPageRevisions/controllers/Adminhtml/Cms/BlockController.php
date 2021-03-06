<?php

require('Mage/Adminhtml/controllers/Cms/BlockController.php');

class Meanbee_CmsPageRevisions_Adminhtml_Cms_BlockController extends Mage_Adminhtml_Cms_BlockController {

    public function gridAction() {
        $this->_initAction();
        $this->loadLayout();
        $this->renderLayout();
    }

    public function deleteRevisionAction() {
        /** @var Meanbee_CmsPageRevisions_Model_Mysql4_Cms_Block_Revisions $revision */
        $revision = $this->_getRevision();
        try {
            $revision->delete();
            $this->_getSession()->addSuccess($this->__('The revision has been deleted.'));
        } catch(Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }
        $this->_redirectReferer();
    }

    public function restoreAction() {
        /** @var Meanbee_CmsPageRevisions_Model_Mysql4_Cms_Block_Revisions $revision */
        $revision = $this->_getRevision();
        try {
            $revision->restore();
            $this->_getSession()->addSuccess($this->__('Revision Restored successfully'));
        } catch(Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }
        $this->_redirectReferer();
    }

    public function reviewAction() {
        $revision = $this->_getRevision();
        $this->loadLayout();
        $block = $this->getLayout()->getBlock('meanbee.cmspagerevisions.review');
        $block->setRevision($revision);
        $this->renderLayout();
    }

    protected function _getRevision() {
        return Mage::getModel('meanbee_cmspagerevisions/cms_block_revisions')->load($this->getRequest()->getParam('id'));
    }
}
