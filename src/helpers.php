<?php
/**
 * Created by PhpStorm.
 * User: dlouvard_imac
 * Date: 26/12/2016
 * Time: 19:24
 */
if (!function_exists('maintenance_status')) {
    function maintenance_status()
    {
        $maintenance = \Cache::get('maintenance', function () {
            return \Dlouvard\LaravelGestionmaintenance\Models\Maintenance::where('status', 1)->first();
        });

        if ($maintenance):
            $begin = \Carbon\Carbon::parse($maintenance->begin);
            $end = \Carbon\Carbon::parse($maintenance->end);

            if (\Carbon\Carbon::now() >= $begin && \Carbon\Carbon::now() <= $end):
                return 1;
            elseif (\Carbon\Carbon::now() <= $begin):
                return 2;
            elseif (\Carbon\Carbon::now() >= $end):
                if (!\Cache::has('alert_Maintenance')):


                    \Cache::put('alert_Maintenance', 1, 3600);
                endif;
                return 1;
            endif;
        endif;

        return false;
    }
}
if (!function_exists('maintenance_remaning')) {

    function maintenance_remaning($date = 'begin')
    {
        $maintenance = \Cache::get('maintenance', function () {
            return \Dlouvard\LaravelGestionmaintenance\Models\Maintenance::where('status', 1)->first();
        });

        $restant = \Carbon::parse($maintenance->begin)->timestamp - \Carbon::now()->timestamp;
        if ($restant < 3600):
            \Carbon::setLocale('fr');
            if ($date == 'begin'):
                return \Carbon::now()->diffForHumans(\Carbon::parse($maintenance->begin));
            else:
                return \Carbon::now()->diffForHumans(\Carbon::parse($maintenance->end));
            endif;
        endif;
    }
}

if (!function_exists('maintenance_title')) {

    function maintenance_title()
    {
        if (maintenance_status() == 1)
            return '<h4 class="text-center txt-color-red bold">Maintenance activé</h4>';
        elseif (maintenance_status() == 2)
            return '<h5 class="text-center txt-color-yellow bold font-md">Maintenance en prévision :</h5>';
        return null;
    }
}

if (!function_exists('maintenance')) {

    function maintenance()
    {
        $maintenance = \Cache::get('maintenance', function () {
            return \Dlouvard\LaravelGestionmaintenance\Models\Maintenance::where('status', 1)->first();
        });
        if ($maintenance):
            $begin = $maintenance->begin;
            $end = $maintenance->end;

            return 'Du ' . \Carbon\Carbon::parse($begin)->setTimezone('Europe/Paris')->format('d/m/Y \à H:i') . ' au ' . \Carbon\Carbon::parse($end)->setTimezone('Europe/Paris')->format('d/m/Y \v\e\r\s H:i');
        endif;
        return null;
    }
}