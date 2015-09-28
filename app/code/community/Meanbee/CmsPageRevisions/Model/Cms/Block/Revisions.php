<?php
class Meanbee_CmsPageRevisions_Model_Cms_Block_Revisions extends Mage_Core_Model_Abstract {

    protected function _construct() {
        $this->_init('meanbee_cmspagerevisions/cms_block_revisions');
    }

    public function restore() {
        if($this->_getLastRevision()->getId() == $this->getId()) {
            throw new Exception(Mage::helper('meanbee_cmspagerevisions')->__('You cannot restore the current version!'), 1);
        }
        $this->setRestoredFromId($this->_getLastRevision()->getId())->save();
        $cmsPage = Mage::getModel('cms/page')->load($this->getPageId());
        $cmsPage->setTitle($this->getTitle())
            ->setIdentifier($this->getIdentifier())
            ->setContent($this->getContent())
            ->setCreationTime(Mage::getSingleton('core/date')->gmtDate())
            ->setUpdateTime(Mage::getSingleton('core/date')->gmtDate())
            ->setIsActive($this->getIsActive())
            ->setRestoredFromId($this->_getLastRevision()->getId())
            ->save();
    }

    protected function _getLastRevision() {
        return Mage::getModel('meanbee_cmspagerevisions/cms_block_revisions')
            ->getCollection()
            ->addFieldToFilter('block_id', array('eq' => $this->getBlockId()))
            ->setOrder('revision_id', 'desc')
            ->setPageSize(1)
            ->getFirstItem();
    }
}
