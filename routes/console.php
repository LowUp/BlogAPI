<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $title = 'Daily Post - ' . date('Y-m-d');
    $content = 'This is a daily post generated on ' . date('Y-m-d');
    $author = 'Automated Post Generator';

    DB::table('posts')->insert([
        'title' => $title,
        'content' => $content,
        'author' => $author,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

})->everyMinute();