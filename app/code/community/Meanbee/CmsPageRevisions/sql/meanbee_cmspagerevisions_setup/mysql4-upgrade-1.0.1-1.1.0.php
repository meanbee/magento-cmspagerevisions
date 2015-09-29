<?php
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();
$installer->run("

DROP TABLE IF EXISTS {$this->getTable('meanbee_cmspagerevisions/cms_block_revisions')};
CREATE TABLE {$this->getTable('meanbee_cmspagerevisions/cms_block_revisions')} (
  `revision_id` smallint(6) NOT NULL auto_increment,
  `block_id` smallint(6) NOT NULL default '0',
  `restored_from_id` smallint(6) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `identifier` varchar(255) NOT NULL default '',
  `content` text,
  `creation_time` datetime default NULL,
  `update_time` datetime default NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`revision_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CMS blocks';
    ");
$installer->getConnection()
    ->addConstraint(
        'FK_CMS_BLOCK_REVISIONS',
        $installer->getTable('meanbee_cmspagerevisions/cms_block_revisions'),
        'block_id',
        $installer->getTable('cms/block'),
        'block_id',
        'cascade',
        'cascade'
);
$installer->endSetup();
