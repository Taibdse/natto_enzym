<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 9/5/2019
 * Time: 10:14 PM
 */

return [
    'news' => [
        'title' => 'news',
        'route' => 'admin.cms',
        'icon' => 'fa-users',
        'items' => [
            [
                'title' => 'news',
                'route' => 'admin.cms.news',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
            [
                'title' => 'category',
                'route' => 'admin.cms.category',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
            [
                'title' => 'tags',
                'route' => 'admin.cms.tags',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
        ],
    ],

    'courses' => [
        'title' => 'courses',
        'route' => 'admin.cms',
        'icon' => 'fa-users',
        'items' => [
            [
                'title' => 'questions',
                'route' => 'admin.cms.questions',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
            [
                'title' => 'video_course',
                'route' => 'admin.cms.video_course',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
        ],
    ],

    'videos' => [
        'title' => 'medias',
        'route' => 'admin.videos',
        'icon' => 'fa-users',
        'items' => [
            [
                'title' => 'videos',
                'route' => 'admin.cms.videos',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
            [
                'title' => 'category',
                'route' => 'admin.cms.videos_category',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'Update', 'action' => 'update', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
        ],
    ],
    'comment' => [
        'title' => 'comment',
        'route' => 'admin.cms.comment',
        'icon' => 'fa-users',
        'permission' => [
            ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
            ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
            ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
            ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
            ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
        ],
    ],
    'test' => [
        'title' => 'test',
        'route' => 'admin.cms.test',
        'icon' => 'fa-users',
        'permission' => [
            ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
            ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
            ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
            ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
            ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
        ],
    ],
    'contact' => [
        'title' => 'contact',
        'route' => 'admin.cms.contact',
        'icon' => 'fa-users',
        'permission' => [
            ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
            ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
            ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
            ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
            ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
        ],
    ],
    'staff' => [
        'title' => 'staff',
        'route' => 'admin.cms.staff',
        'icon' => 'fa-users',
        'permission' => [
            ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
            ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
            ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
            ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
            ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
        ],
    ],
    'subscribe' => [
        'title' => 'subscribe',
        'route' => 'admin.cms.subscribe',
        'icon' => 'fa-users',
        'permission' => [
            ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
            ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
            ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
            ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
            ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
        ],
    ],
    'pages' => [
        'title' => 'pages',
        'route' => 'admin.cms.pages',
        'icon' => 'fa-users',
        'permission' => [
            ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
            ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
            ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
            ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
            ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
        ],
    ],
    'banners' => [
        'title' => 'banners',
        'route' => 'admin.cms.banners',
        'icon' => 'fa-users',
        'permission' => [
            ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
            ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
            ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
            ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
            ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
        ],
    ],
    'member' => [
        'title' => 'member',
        'route' => 'admin.system.users',
        'icon' => 'fa-users',
        'permission' => [
            ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
            ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
            ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
            ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
            ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
        ],
    ],
    'system' => [
        'title' => 'system',
        'route' => 'admin.system',
        'icon' => 'fa-users',
        'items' => [
            [
                'title' => 'setting',
                'route' => 'admin.system.setting',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                ],
            ],
            [
                'title' => 'language',
                'route' => 'admin.system.language',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
            [
                'title' => 'menu',
                'route' => 'admin.cms.menu',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
            'users' => [
                'title' => 'admin',
                'route' => 'admin.system.admin',
                'icon' => 'fa-users',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
            [
                'title' => 'role_permission',
                'route' => 'admin.system.role',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                    ['title' => 'create', 'action' => 'create', 'icon' => 'fa-plus'],
                    ['title' => 'edit', 'action' => 'edit', 'icon' => 'fa-file'],
                    ['title' => 'delete', 'action' => 'delete', 'icon' => 'fa-trash'],
                    ['title' => 'publish', 'action' => 'publish', 'icon' => 'fa-check'],
                ],
            ],
            [
                'title' => 'backup_restore',
                'route' => 'admin.system.backup',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                ],
            ],
            [
                'title' => 'cache',
                'route' => 'admin.system.cache',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                ],
            ],
            [
                'title' => 'information',
                'route' => 'admin.system.information',
                'permission' => [
                    ['title' => 'view', 'action' => 'view', 'icon' => 'fa-list'],
                ],
            ],
        ],
    ],
];
