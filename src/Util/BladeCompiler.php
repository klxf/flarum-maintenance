<?php

namespace Klxf\MaintenanceMode\Util;

class BladeCompiler
{
    public static function render($view, $data = [])
    {
        $phpView = resolve('blade.compiler')->compileString($view);

        ob_start();
        extract($data, EXTR_SKIP);

        try {
            eval('?>' . $phpView);
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }

        return ob_get_clean();
    }
}