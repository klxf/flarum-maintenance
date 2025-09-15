<?php

/*
 * This file is part of klxf/flarum-maintenance.
 *
 * Copyright (c) 2025 Fang_Zhijian.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Klxf\MaintenanceMode;

use Flarum\Extend;
use Klxf\MaintenanceMode\Middleware\MaintenanceForumMiddleware;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    new Extend\Locales(__DIR__.'/resources/locale'),

    (new Extend\Settings)
        ->default('klxf-maintenance.enabled', false),
    (new Extend\Settings)
        ->default('klxf-maintenance.title', 'Maintenance'),
    (new Extend\Settings)
        ->default('klxf-maintenance.message', 'The forum is under maintenance, please come back later.'),

    (new Extend\Middleware('forum'))
        ->add(MaintenanceForumMiddleware::class),

    (new Extend\View)
        ->namespace('klxf.maintenance-mode', __DIR__.'/resources/defaults'),
];
