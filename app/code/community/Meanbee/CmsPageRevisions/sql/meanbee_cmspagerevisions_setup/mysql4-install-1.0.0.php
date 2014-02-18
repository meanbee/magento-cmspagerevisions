<?php
/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();


/**
 * Create table cms_page_revisions
 */
$table = $installer->getConnection()
->newTable($installer->getTable('meanbee_cmspagerevisions/cms_page_revisions'))
->addColumn('revision_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity' => true,
        'nullable' => false,
        'primary' => true,
    ),
    'Revision ID')
->addColumn('page_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
'nullable'  => false,
), 'Page ID')
->addColumn('restored_from_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
    'nullable'  => false,
), 'Restored From ID')
->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
'nullable'  => true
), 'Page Title')
->addColumn('root_template', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
'nullable'  => true
), 'Page Template')
->addColumn('meta_keywords', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
'nullable'  => true,
), 'Page Meta Keywords')
->addColumn('meta_description', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
'nullable'  => true,
), 'Page Meta Description')
->addColumn('identifier', Varien_Db_Ddl_Table::TYPE_TEXT, 100, array(
'nullable'  => true,
'default'   => null,
), 'Page String Identifier')
->addColumn('content_heading', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
'nullable'  => true,
), 'Page Content Heading')
->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '2M', array(
), 'Page Content')
->addColumn('creation_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
), 'Revision Creation Time')
->addColumn('update_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
), 'Revision Modification Time')
->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
'nullable'  => false,
'default'   => '1',
), 'Is Page Active')
->addColumn('sort_order', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
'nullable'  => false,
'default'   => '0',
), 'Page Sort Order')
->addColumn('layout_update_xml', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
'nullable'  => true,
), 'Page Layout Update Content')
->addColumn('custom_theme', Varien_Db_Ddl_Table::TYPE_TEXT, 100, array(
'nullable'  => true,
), 'Page Custom Theme')
->addColumn('custom_root_template', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
'nullable'  => true,
), 'Page Custom Template')
->addColumn('custom_layout_update_xml', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
'nullable'  => true,
), 'Page Custom Layout Update Content')
->addColumn('custom_theme_from', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
'nullable'  => true,
), 'Page Custom Theme Active From Date')
->addColumn('custom_theme_to', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
'nullable'  => true,
), 'Page Custom Theme Active To Date')
->addIndex($installer->getIdxName('cms/page', array('identifier')),
array('identifier'))
->setComment('CMS Page Revisions Table');
$installer->getConnection()->createTable($table);
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