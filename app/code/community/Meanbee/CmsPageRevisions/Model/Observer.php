<?php
class Meanbee_CmsPageRevisions_Model_Observer {

    public function saveRevision($observer) {
        /** @var $observer Mage_Core_Model_Abstract */

        /** @var Mage_Cms_Model_Page $cmsPage */
        $cmsPage = $observer->getDataObject();

        if ($cmsPage->isObjectNew()) {
            return;
        }

        if (!$cmsPage->dataHasChangedFor('title') &&
            !$cmsPage->dataHasChangedFor('root_template') &&
            !$cmsPage->dataHasChangedFor('meta_keywords') &&
            !$cmsPage->dataHasChangedFor('meta_description') &&
            !$cmsPage->dataHasChangedFor('identifier') &&
            !$cmsPage->dataHasChangedFor('content_heading') &&
            !$cmsPage->dataHasChangedFor('content') &&
            !$cmsPage->dataHasChangedFor('is_active') &&
            !$cmsPage->dataHasChangedFor('layout_update_xml') &&
            !$cmsPage->dataHasChangedFor('custom_theme') &&
            !$cmsPage->dataHasChangedFor('custom_root_template') &&
            !$cmsPage->dataHasChangedFor('custom_layout_update_xml') &&
            !$cmsPage->dataHasChangedFor('custom_theme_from') &&
            !$cmsPage->dataHasChangedFor('custom_theme_to') &&
            $this->_hasRevisions($cmsPage->getId())
        ) {
            return;
        }
        $revision = Mage::getModel('meanbee_cmspagerevisions/cms_page_revisions');
        $revision->setPageId($cmsPage->getId())
            ->setTitle($cmsPage->getTitle())
            ->setRootTemplate($cmsPage->getRootTemplate())
            ->setMetaKeywords($cmsPage->getMetaKeywords())
            ->setMetaDescription($cmsPage->getMetaDescription())
            ->setIdentifier($cmsPage->getIdentifier())
            ->setContentHeading($cmsPage->getContentHeading())
            ->setContent($cmsPage->getContent())
            ->setCreationTime(Mage::getSingleton('core/date')->gmtDate())
            ->setUpdateTime(Mage::getSingleton('core/date')->gmtDate())
            ->setIsActive($cmsPage->getIsActive())
            ->setSortOrder($cmsPage->getSortOrder())
            ->setLayoutUpdateXml($cmsPage->getLayoutUpdateXml())
            ->setCustomTheme($cmsPage->getCustomTheme())
            ->setCustomRootTemplate($cmsPage->getCustomRootTemplate())
            ->setCustomLayoutUpdateXml($cmsPage->getCustomLayoutUpdateXml())
            ->setCustomThemeFrom($cmsPage->getCustomThemeFrom())
            ->setCustomThemeTo($cmsPage->getCustomThemeTo())
            ->save();
    }

    private function _hasRevisions($pageId) {
        return Mage::getModel('meanbee_cmspagerevisions/cms_page_revisions')->getCollection()->addFieldToFilter('page_id', array('eq' => $pageId))->count();
    }
}
