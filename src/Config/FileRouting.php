<?php

return [
    'route' => [
        [
            'stub' => 'Route',
            'path' => '/app/Http/Routes',
            'filename' => '{{class}}.php'
        ]
    ],
    'controller' => [
        [
            'stub' => 'Controller',
            'path' => '/app/Http/Controllers',
            'filename' => '{{class}}Controller.php'
        ],
        [
            'stub' => 'ControllerDependencies',
            'path' => '/app/Http/Controllers/Dependencies',
            'filename' => '{{class}}Controller.php'
        ]
    ],
    'service' => [
        [
            'stub' => 'Service',
            'path' => '/app/Services',
            'filename' => '{{class}}Service.php'
        ],
        [
            'stub' => 'ServiceDependencies',
            'path' => '/app/Services/Dependencies',
            'filename' => '{{class}}Service.php'
        ]
    ],
    'repository' => [
        [
            'stub' => 'Repository',
            'path' => '/app/Repositories',
            'filename' => '{{class}}Repository.php'
        ],
        [
            'stub' => 'RepositoryInterface',
            'path' => '/app/Repositories/Contracts',
            'filename' => '{{class}}RepositoryInterface.php'
        ],
        [
            'stub' => 'RepositoryCache',
            'path' => '/app/Repositories/Decorators',
            'filename' => '{{class}}RepositoryCache.php'
        ]
    ],
    'model' => [
        [
            'stub' => 'Model',
            'path' => '/app/Models',
            'filename' => '{{class}}.php'
        ]
    ],
    'db' => [
        [
            'stub' => 'Factory',
            'path' => '/database/factories',
            'filename' => '{{class}}Factory.php'
        ],
        [
            'stub' => 'Seeder',
            'path' => '/database/seeds',
            'filename' => '{{class}}TableSeeder.php'
        ]
    ]
];