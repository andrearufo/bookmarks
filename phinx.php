<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'production',
        'production' => [
            'adapter' => 'sqlite',
            'host' => 'localhost',
            'name' => '%%PHINX_CONFIG_DIR%%/database/database',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
