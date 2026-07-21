<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\CommonDataComposer;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share only for frontend/* and layouts/*
        View::composer([
            'frontend.*',
            'layouts.*',
        ], CommonDataComposer::class);
    }

    public function register() {}
}
