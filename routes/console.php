<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Schedule::command('reverb:start')
    ->everyMinute()
    ->withoutOverlapping()
    ->runInBackground();

Schedule::command('queue:work')
    ->everyFifteenMinutes()
    ->withoutOverlapping()
    ->runInBackground();

Schedule::command('pulse:check')
    ->everyMinute()
    ->withoutOverlapping()
    ->runInBackground();
