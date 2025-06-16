<?php
defined('TYPO3') or die('Access denied.');

$CHAPTER_CONTAINER_CTYPE = 'container_1_columns';
$VERSE_CTYPE             = 'text';
$CHAPTER_AREA_COLPOS     = 201;

// External Import
$GLOBALS['TCA']['tt_content'] = array_replace_recursive($GLOBALS['TCA']['tt_content'], [
    'external' => [
        'general' => [
            // CHAPTER as EXT:container (EN)
            'CHAPTER_en' => [
                'group' => 'CHAPTER',
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'EXT:the_holy_bible/Resources/Public/ZafaniaXML/en/data.xml',
                ],
                'data' => 'xml',
                'priority' => 700,
                'pid' => 100,
                'nodetype' => 'CHAPTER',
                'referenceUid' => 'b_chapter_uid',
                'description' => 'CHAPTER as EXT:container (EN)',
                'whereClause' => "tt_content.sys_language_uid = 0 AND tt_content.CType = '$CHAPTER_CONTAINER_CTYPE'",
            ],
            // CHAPTER as EXT:container (DE)
            'CHAPTER_de' => [
                'group' => 'CHAPTER',
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'EXT:the_holy_bible/Resources/Public/ZafaniaXML/de/data.xml',
                ],
                'data' => 'xml',
                'nodetype' => 'CHAPTER',
                'priority' => 800,
                'pid' => 100,
                'referenceUid' => 'b_chapter_uid',
                'description' => 'CHAPTER as EXT:container (DE)',
                'whereClause' => "tt_content.sys_language_uid = 1 AND tt_content.CType = '$CHAPTER_CONTAINER_CTYPE'",
            ],
            // VERS as child of EXT:container (EN)
            'VERS_en' => [
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'EXT:the_holy_bible/Resources/Public/ZafaniaXML/en/data.xml',
                ],
                'data' => 'xml',
                'nodetype' => 'VERS',
                'priority' => 900,
                'pid' => 100,
                'referenceUid' => 'b_vers_uid',
                'description' => 'VERS → child (EN)',
                'whereClause' => "tt_content.sys_language_uid = 0 AND tt_content.CType = '$VERSE_CTYPE'",
            ],
            // VERS as child of EXT:container (DE)
            'VERS_de' => [
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'EXT:the_holy_bible/Resources/Public/ZafaniaXML/de/data.xml',
                ],
                'data' => 'xml',
                'nodetype' => 'VERS',
                'priority' => 1000,
                'pid' => 100,
                'referenceUid' => 'b_vers_uid',
                'description' => 'VERS → child (DE)',
                'whereClause' => "tt_content.sys_language_uid = 1 AND tt_content.CType = '$VERSE_CTYPE'",
            ],
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'external' => [
                'CHAPTER_en' => ['transformations' => [10 => ['value' => 0]]],
                'CHAPTER_de' => ['transformations' => [10 => ['value' => 1]]],
                'VERS_en'    => ['transformations' => [10 => ['value' => 0]]],
                'VERS_de'    => ['transformations' => [10 => ['value' => 1]]],
            ],
        ],
        // Chapter as EXT:container on BIBLEBOOK/Page
        'pid' => [
            'external' => [
                'CHAPTER_en' => [
                    'xpath' => '../@bnumber',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'pages',
                                'referenceField' => 'bnumber',
                                'whereClause' => 'pages.sys_language_uid = 0 AND pages.bnumber > 0',
                            ],
                        ],
                    ],
                ],
                'CHAPTER_de' => [
                    'xpath' => '../@bnumber',
                    'transformations' => [
                        10 => [
                            // DE-Content bleibt auf der EN-Seite (Standard-Layout)
                            'mapping' => [
                                'table' => 'pages',
                                'referenceField' => 'bnumber',
                                'whereClause' => 'pages.sys_language_uid = 0 AND pages.bnumber > 0',
                            ],
                        ],
                    ],
                ],
                'VERS_en' => [
                    'xpath' => '../../@bnumber',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'pages',
                                'referenceField' => 'bnumber',
                                'whereClause' => 'pages.sys_language_uid = 0 AND pages.bnumber > 0',
                            ],
                        ],
                    ],
                ],
                'VERS_de' => [
                    'xpath' => '../../@bnumber',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'pages',
                                'referenceField' => 'bnumber',
                                'whereClause' => 'pages.sys_language_uid = 0 AND pages.bnumber > 0',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'CType' => [
            'external' => [
                'CHAPTER_en' => ['transformations' => [10 => ['value' => $CHAPTER_CONTAINER_CTYPE]]],
                'CHAPTER_de' => ['transformations' => [10 => ['value' => $CHAPTER_CONTAINER_CTYPE]]],
                'VERS_en'    => ['transformations' => [10 => ['value' => $VERSE_CTYPE]]],
                'VERS_de'    => ['transformations' => [10 => ['value' => $VERSE_CTYPE]]],
            ],
        ],
        'colPos' => [
            'external' => [
                'CHAPTER_en' => ['transformations' => [10 => ['value' => 0]]],
                'CHAPTER_de' => ['transformations' => [10 => ['value' => 0]]],
                'VERS_en'    => ['transformations' => [10 => ['value' => $CHAPTER_AREA_COLPOS]]],
                'VERS_de'    => ['transformations' => [10 => ['value' => $CHAPTER_AREA_COLPOS]]],
            ],
        ],

        'header' => [
            'external' => [
                'CHAPTER_en' => ['xpath' => 'concat(../@bname, " ", @cnumber)'],
                'CHAPTER_de' => ['xpath' => 'concat(../@bname, " ", @cnumber)'],
//                'CHAPTER_ru' => ['xpath' => 'concat(../@bname, " ", @cnumber)'],
                'VERS_en' => ['xpath' => '@vnumber'],
                'VERS_de' => ['xpath' => '@vnumber'],
//                'VERS_ru' => ['xpath' => '@vnumber'],
            ],
        ],
        'rowDescription' => [
            'external' => [
                'CHAPTER_en' => ['xpath' => 'concat(../@bsname, ". ", @cnumber)'],
                'CHAPTER_de' => ['xpath' => 'concat(../@bsname, ". ", @cnumber)'],
//                'CHAPTER_ru' => ['xpath' => 'concat(../@bsname, ". ", @cnumber)'],
            ],
        ],

        // refs
        'bnumber' => [
            'config' => [
                'type' => 'number',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
            'external' => [
                'CHAPTER_en' => ['xpath' => '../@bnumber'],
                'CHAPTER_de' => ['xpath' => '../@bnumber'],
                'VERS_en'    => ['xpath' => '../../@bnumber'],
                'VERS_de'    => ['xpath' => '../../@bnumber'],
            ],
        ],
        'cnumber' => [
            'config' => [
                'type' => 'number',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
            'external' => [
                'CHAPTER_en' => ['xpath' => '@cnumber'],
                'CHAPTER_de' => ['xpath' => '@cnumber'],
                'VERS_en'    => ['xpath' => '../@cnumber'],
                'VERS_de'    => ['xpath' => '../@cnumber'],
            ],
        ],
        'vnumber' => [
            'config' => [
                'type' => 'number',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
            'external' => [
                'VERS_en' => ['xpath' => '@vnumber'],
                'VERS_de' => ['xpath' => '@vnumber'],
            ],
        ],
        'b_chapter_uid' => [
            'config' => [
                'type' => 'input',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
            'external' => [
                'CHAPTER_en' => [
                    'xpath' => 'concat(../@bnumber, ":", @cnumber)',
                ],
                'CHAPTER_de' => ['xpath' => 'concat(../@bnumber, ":", @cnumber)'],
                'VERS_en'    => ['xpath' => 'concat(../../@bnumber, ":", ../@cnumber)'],
                'VERS_de'    => ['xpath' => 'concat(../../@bnumber, ":", ../@cnumber)'],
            ],
        ],

        // L10N-connection DE → EN
        'l10n_parent' => [
            'external' => [
                'CHAPTER_de' => [
                    'xpath' => 'concat(../@bnumber, ":", @cnumber)',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tt_content',
                                'referenceField' => 'b_chapter_uid',
                                'whereClause' => "tt_content.sys_language_uid = 0 AND tt_content.CType = '$CHAPTER_CONTAINER_CTYPE'",
                            ],
                        ],
                        20 => ['isEmpty' => ['default' => 0,]],
                    ],
                ],
                'VERS_de' => [
                    'xpath' => 'concat(../../@bnumber, ":", ../@cnumber, ":", @vnumber)',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tt_content',
                                'referenceField' => 'b_vers_uid',
                                'whereClause' => "tt_content.sys_language_uid = 0 AND tt_content.CType = '$VERSE_CTYPE'",
                            ],
                        ],
                        20 => ['isEmpty' => ['default' => 0,]],
                    ],
                ],
            ],
        ],
        'l10n_source' => [
            'external' => [
                'CHAPTER_de' => [
                    'xpath' => 'concat(../@bnumber, ":", @cnumber)',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tt_content',
                                'referenceField' => 'b_chapter_uid',
                                'whereClause' => "tt_content.sys_language_uid = 0 AND tt_content.CType = '$CHAPTER_CONTAINER_CTYPE'",
                            ],
                        ],
                        20 => ['isEmpty' => ['default' => 0]],
                    ],
                ],
                'VERS_de' => [
                    'xpath' => 'concat(../../@bnumber, ":", ../@cnumber, ":", @vnumber)',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tt_content',
                                'referenceField' => 'b_vers_uid',
                                'whereClause' => "tt_content.sys_language_uid = 0 AND tt_content.CType = '$VERSE_CTYPE'",
                            ],
                        ],
                        20 => ['isEmpty' => ['default' => 0]],
                    ],
                ],
            ],
        ],

        // VERS connection EXT:Container
        'tx_container_parent' => [
            'external' => [
                // EN-children inside EN-Container
                'VERS_en' => [
                    'xpath' => 'concat(../../@bnumber, ":", ../@cnumber)',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tt_content',
                                'referenceField' => 'b_chapter_uid',
                                'whereClause' => "tt_content.sys_language_uid = 0 AND tt_content.CType = '$CHAPTER_CONTAINER_CTYPE'",
                            ],
                        ],
                    ],
                ],
                // DE-children inside DE-Container
                'VERS_de' => [
                    'xpath' => 'concat(../../@bnumber, ":", ../@cnumber)',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tt_content',
                                'referenceField' => 'b_chapter_uid',
                                'whereClause' => "tt_content.sys_language_uid = 1 AND tt_content.CType = '$CHAPTER_CONTAINER_CTYPE'",
                            ],
                        ],
                    ],
                ],
            ],
        ],

        // VERS-data-contents
        'b_vers_uid' => [
            'config' => [
                'type' => 'input',
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
            'external' => [
                'VERS_en' => ['xpath' => 'concat(../../@bnumber, ":", ../@cnumber, ":", @vnumber)'],
                'VERS_de' => ['xpath' => 'concat(../../@bnumber, ":", ../@cnumber, ":", @vnumber)'],
            ],
        ],
        'bodytext' => [
            'external' => [
                'VERS_en' => ['xpath' => '.'],
                'VERS_de' => ['xpath' => '.'],
            ],
        ],

        'sorting' => [
            'external' => [
                'CHAPTER_en' => ['xpath' => '@cnumber'],
                'CHAPTER_de' => ['xpath' => '@cnumber'],
                'VERS_en'    => ['xpath' => '@vnumber'],
                'VERS_de'    => ['xpath' => '@vnumber'],
            ],
        ],
    ],
]);
