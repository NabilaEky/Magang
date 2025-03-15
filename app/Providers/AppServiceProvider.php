<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Carousel;
use App\Models\Sambutan;
use App\Models\Berita;
use App\Models\Struktural;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();


        $carousels = Carousel::latest()->get();
        $sambutan = Sambutan::first();
        $strukturalImage = Struktural::first();


        $berita = Berita::latest()->paginate(5);

        View::composer('*', function ($view) use ($carousels, $sambutan, $berita, $strukturalImage) {
            $view->with(compact('carousels', 'sambutan', 'strukturalImage'));
        });

        View::composer(['admin.berita.index', 'home'], function ($view) use ($berita) {
            $view->with(compact('berita'));
        });
    }
}
