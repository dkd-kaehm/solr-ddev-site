<?php
defined('TYPO3') || die();

/***************
 * Add default configuration
 */

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('
  @import \'EXT:the_holy_bible/Configuration/TypoScript/constants.typoscript\'
');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup('
  @import \'EXT:the_holy_bible/Configuration/TypoScript/setup.typoscript\'
');
