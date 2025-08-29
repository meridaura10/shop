<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\MonobankProvider::class,
    App\Providers\RouteBindingServiceProvider::class,
    App\Providers\ViewServiceProvider::class,
    Maatwebsite\Excel\ExcelServiceProvider::class,
    NotificationChannels\TurboSms\TurboSmsServiceProvider::class,
    Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,
];
