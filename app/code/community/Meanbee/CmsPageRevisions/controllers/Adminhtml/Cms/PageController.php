<?php

require('Mage/Adminhtml/controllers/Cms/PageController.php');

class Meanbee_CmsPageRevisions_Adminhtml_Cms_PageController extends Mage_Adminhtml_Cms_PageController {

    public function gridAction() {
        $this->_initAction();
        $this->loadLayout();
        $block = $this->getLayout()->getBlock('cms_page_edit_tab_revisions');
        $this->renderLayout();
    }

    public function deleteAction() {
        /** @var Meanbee_CmsPageRevisions_Model_Mysql4_Cms_Page_Revisions $revision */
        $revision = $this->_getRevision();
        try {
            $revision->delete();
            $this->_getSession()->addSuccess($this->__('The revision has been deleted.'));
        } catch(Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }
        $this->getResponse()->setRedirect($this->getUrl('*/*/', array('store' => $this->getRequest()->getParam('store'))));
    }

    public function restoreAction() {
        /** @var Meanbee_CmsPageRevisions_Model_Mysql4_Cms_Page_Revisions $revision */
        $revision = $this->_getRevision();
        try {
            $revision->restore();
            $this->_getSession()->addSuccess($this->__('Revision Restored successfully'));
        } catch(Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }
        $this->getResponse()->setRedirect($this->getUrl('*/*/', array('store' => $this->getRequest()->getParam('store'))));
    }

    protected function _getRevision() {
        return Mage::getModel('meanbee_cmspagerevisions/cms_page_revisions')->load($this->getRequest()->getParam('id'));
    }
}