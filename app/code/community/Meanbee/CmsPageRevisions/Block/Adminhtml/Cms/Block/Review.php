<?php

class Meanbee_CmsPageRevisions_Block_Adminhtml_Cms_Block_Review extends Mage_Core_Block_Template {

    public function isHtml($string) {
        if ( $string != strip_tags($string) )
            return true; // Contains HTML
    }

    public function getDisplayName($name) {
        return ucwords(str_replace('_', ' ', $name));
    }
}
