<?php
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();
$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('meanbee_cmspagerevisions/cms_page_revisions')};
CREATE TABLE {$this->getTable('meanbee_cmspagerevisions/cms_page_revisions')} (
  `revision_id` smallint(6) NOT NULL auto_increment,
  `page_id` smallint(6) NOT NULL default '0',
  `restored_from_id` smallint(6) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `root_template` varchar(255) NOT NULL default '',
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `identifier` varchar(100) NOT NULL default '',
  `content` text,
  `creation_time` datetime default NULL,
  `update_time` datetime default NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  `store_id` tinyint(4) NOT NULL default '1',
  `sort_order` tinyint(4) NOT NULL default '0',
  `layout_update_xml` text,
  PRIMARY KEY  (`revision_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CMS pages';
    ");
$installer->getConnection()
    ->addConstraint(
        'FK_CMS_PAGE_REVISIONS',
        $installer->getTable('meanbee_cmspagerevisions/cms_page_revisions'),
        'page_id',
        $installer->getTable('cms/page'),
        'page_id',
        'cascade',
        'cascade'
);
$installer->endSetup();
