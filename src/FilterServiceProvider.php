<?php

namespace Iq500\Filters;

use Illuminate\Support\Facades\App;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    protected static $availableTranslations = [
        'ru'
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('multiselect-filter', __DIR__.'/../dist/js/filter.js');
            Nova::style('multiselect-filter', __DIR__.'/../dist/css/filter.css');

            $translations = FilterServiceProvider::getTranslationsFromAppLocale();
            if(!is_null($translations))
                Nova::translations($translations);
        });
    }

    public static function getTranslationsFromAppLocale()
    {
        $locale = App::getLocale();

        if(in_array($locale, static::$availableTranslations))
            return __DIR__ . "/../resources/lang/$locale.json";

        return null;
    }
}
