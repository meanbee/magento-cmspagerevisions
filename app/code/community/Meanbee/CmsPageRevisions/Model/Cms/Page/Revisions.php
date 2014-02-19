<?php
class Meanbee_CmsPageRevisions_Model_Cms_Page_Revisions extends Mage_Core_Model_Abstract {

    protected function _construct() {
        $this->_init('meanbee_cmspagerevisions/cms_page_revisions');
    }

    public function restore() {
        if($this->_getLastRevision()->getId() == $this->getId()) {
            throw new Exception("You cannot restore the current version!", 1);
        }
        $this->setRestoredFromId($this->_getLastRevision()->getId())->save();
        $cmsPage = Mage::getModel('cms/page')->load($this->getPageId());
        $cmsPage->setTitle($this->getTitle())
            ->setRootTemplate($this->getRootTemplate())
            ->setMetaKeywords($this->getMetaKeywords())
            ->setMetaDescription($this->getMetaDescription())
            ->setIdentifier($this->getIdentifier())
            ->setContentHeading($this->getContentHeading())
            ->setContent($this->getContent())
            ->setCreationTime(Mage::getSingleton('core/date')->gmtDate())
            ->setUpdateTime(Mage::getSingleton('core/date')->gmtDate())
            ->setIsActive($this->getIsActive())
            ->setSortOrder($this->getSortOrder())
            ->setLayoutUpdateXml($this->getLayoutUpdateXml())
            ->setCustomTheme($this->getCustomTheme())
            ->setCustomRootTemplate($this->getCustomRootTemplate())
            ->setCustomLayoutUpdateXml($this->getCustomLayoutUpdateXml())
            ->setCustomThemeTo($this->getCustomThemeTo())
            ->setCustomThemeFrom($this->getCustomThemeFrom())
            ->setRestoredFromId($this->_getLastRevision()->getId())
            ->save();
    }

    protected function _getLastRevision() {
        return Mage::getModel('meanbee_cmspagerevisions/cms_page_revisions')
            ->getCollection()
            ->addFieldToFilter('page_id', array('eq' => $this->getPageId()))
            ->setOrder('revision_id', 'desc')
            ->getFirstItem();
    }
}