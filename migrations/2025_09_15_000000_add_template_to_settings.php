<?php

use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $settings = resolve('flarum.settings');

        $template = $settings->get('klxf-maintenance.template');

        if (!$template) {
            $settings->set(
                'klxf-maintenance.template',
                file_get_contents(__DIR__."/../resources/defaults/template.blade.php")
            );
        }
    },
    'down' => function (Builder $schema) {
        // down migration
    }
];
