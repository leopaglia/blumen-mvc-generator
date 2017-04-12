<?php

return [
    'route' => [
        [
            'stub' => 'Base/Route',
            'path' => '/app/Http/Routes',
            'filename' => '{{class}}.php'
        ]
    ],
    'controller' => [
        [
            'stub' => 'Base/Controller',
            'path' => '/app/Http/Controllers',
            'filename' => '{{class}}Controller.php'
        ]
    ],
    'service' => [
        [
            'stub' => 'Base/Service',
            'path' => '/app/Services',
            'filename' => '{{class}}Service.php'
        ]
    ],
    'repository' => [
        [
            'stub' => 'Base/Repository',
            'path' => '/app/Repositories',
            'filename' => '{{class}}Repository.php'
        ],
        [
            'stub' => 'Base/RepositoryInterface',
            'path' => '/app/Repositories/Contracts',
            'filename' => '{{class}}RepositoryInterface.php'
        ],
        [
            'stub' => 'Base/RepositoryCache',
            'path' => '/app/Repositories/Decorators',
            'filename' => '{{class}}RepositoryCache.php'
        ]
    ],
    'model' => [
        [
            'stub' => 'Base/Model',
            'path' => '/app/Models',
            'filename' => '{{class}}.php'
        ]
    ],
    'db' => [
        [
            'stub' => 'Base/Factory',
            'path' => '/database/factories',
            'filename' => '{{class}}Factory.php'
        ],
        [
            'stub' => 'Base/Seeder',
            'path' => '/database/seeds',
            'filename' => '{{class}}TableSeeder.php'
        ]
    ]
];