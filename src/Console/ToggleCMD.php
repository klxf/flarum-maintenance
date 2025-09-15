<?php

namespace Klxf\MaintenanceMode\Console;

use Flarum\Console\AbstractCommand;
use Flarum\Settings\SettingsRepositoryInterface;
use Symfony\Component\Console\Input\InputArgument;

class ToggleCMD extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('maintenanceMode:toggle')
            ->setDescription('Enable or disable maintenance mode');
    }

    protected function fire()
    {
        $settings = resolve(SettingsRepositoryInterface::class);
        $enable = $settings->get('klxf-maintenance.enabled');

        if ($enable === '1') {
            $settings->set('klxf-maintenance.enabled', false);
            $this->info('Maintenance mode has been disabled.');
        } elseif ($enable === '0') {
            $settings->set('klxf-maintenance.enabled', true);
            $this->info('Maintenance mode has been enabled.');
        }
    }
}
