<?php

defined('TYPO3') or die('Access denied.');

$GLOBALS['TCA']['pages'] = array_merge_recursive( $GLOBALS['TCA']['pages'], [
    'external' => [
        'general' => [
            'english' => [
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'EXT:the_holy_bible/Resources/Public/ZafaniaXML/en/data.xml',
                ],
                'pid' => 100,
                'enforcePid' => true,
                'data' => 'xml',
                'priority' => 100,
                'description' => 'Pages in 1st level as bible-book in English(default language)',
                'referenceUid' => 'bnumber',
                'nodetype' => 'BIBLEBOOK',
                'whereClause' => 'pages.sys_language_uid = 0',
            ],
            'german' => [
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'EXT:the_holy_bible/Resources/Public/ZafaniaXML/de/data.xml',
                ],
                'pid' => 100,
                'enforcePid' => true,
                'data' => 'xml',
                'priority' => 200,
                'description' => 'Pages in 1st level as bible-book in German',
                'referenceUid' => 'bnumber',
                'nodetype' => 'BIBLEBOOK',
                'whereClause' => 'pages.sys_language_uid = 1',
            ],
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'external' => [
                'english' => [
                    'transformations' => [
                        10 => [
                            'value' => 0,
                        ],
                    ],
                ],
                'german' => [
                    'transformations' => [
                        10 => [
                            'value' => 1,
                        ],
                    ],
                ],
            ],
        ],
        'bnumber' => [
            'config' => [
                'type' => 'number',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
            'external' => [
                'english' => [
                    'xpath' => './self::*',
                    'attribute' => 'bnumber',
                ],
                'german' => [
                    'xpath' => './self::*',
                    'attribute' => 'bnumber',
                ],
            ],
        ],
        'sorting' => [
            'external' => [
                'english' => [
                    'xpath' => './self::*',
                    'attribute' => 'bnumber',
                ],
                'german' => [
                    'xpath' => './self::*',
                    'attribute' => 'bnumber',
                ],
            ],
        ],
        'title' => [
            'external' => [
                'english' => [
                    'xpath' => './self::*',
                    'attribute' => 'bname',
                ],
                'german' => [
                    'xpath' => './self::*',
                    'attribute' => 'bname',
                ],
            ],
        ],
        'hidden' => [
            'external' => [
                'english' => [
                    'transformations' => [
                        10 => [
                            'value' => 0,
                        ],
                    ],
                ],
                'german' => [
                    'transformations' => [
                        10 => [
                            'value' => 0,
                        ],
                    ],
                ],
            ],
        ],
        'l10n_parent' => [
            'external' => [
                'german' => [
                    'xpath' => './self::*',
                    'attribute' => 'bnumber',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'pages',
                                'referenceField' => 'bnumber',
                                'whereClause' => 'pages.sys_language_uid = 0 AND pages.bnumber > 0 AND pages.pid = ###PID_IN_USE###',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'l10n_source' => [
            'external' => [
                'german' => [
                    'xpath' => './self::*',
                    'attribute' => 'bnumber',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'pages',
                                'referenceField' => 'bnumber',
                                'whereClause' => 'pages.sys_language_uid = 0 AND pages.bnumber > 0 AND pages.pid = ###PID_IN_USE###',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
]);
