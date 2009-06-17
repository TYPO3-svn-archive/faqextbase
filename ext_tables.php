<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

/**
 * A fully configured omnipotent plugin
 */
Tx_Extbase_Utility_Plugin::registerPlugin(
	'FaqExtBase',																	// The name of the extension in UpperCamelCase
	'Pi1',																			// A unique name of the plugin in UpperCamelCase
	'Faq with extbase',																// A title shown in the backend dropdown field
	array(																			// An array holding the controller-action-combinations that are accessible 
		'Faq' => 'index,show,new,create,delete,deleteAll,edit,update,populate',	// The first controller and its first action will be the default 
		),
	array(																			// An array of non-cachable controller-action-combinations (they must already be enabled)
		'Faq' => 'delete,deleteAll,edit,update,populate',
		)
);

/**
 * A minimalistic configuration
 */
// Tx_Extbase_Utility_Plugin::registerPlugin('FaqExtbase', 'Pi1', 'Faq with extbase', array('Faq' => 'index,show,edit'));

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Faq with extbase');

// remove some fields from the tt_content content element
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key';
// loading of the flexform
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_list.xml');

t3lib_extMgm::allowTableOnStandardPages('tx_faqextbase_domain_model_faq');
$TCA['tx_faqextbase_domain_model_faq'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:faqextbase/Resources/Private/Language/locallang_db.xml:tx_faqextbase_domain_model_faq',
		'label' 			=> 'name',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> true,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',	
		'transOrigPointerField' 	=> 'l18n_parent',	
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',	
		'prependAtCopy' 	=> 'LLL:EXT:lang/locallang_general.xml:LGL.prependAtCopy',
		'copyAfterDuplFields' 		=> 'sys_language_uid',
		'useColumnsForDefaultValues' => 'sys_language_uid',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_tx_faqextbase_domain_model_faq.gif'
	)
);
?>