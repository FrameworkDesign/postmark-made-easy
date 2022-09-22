<?php

namespace Weareframework\PostmarkMadeEasy;

use Illuminate\Support\Facades\Artisan;
use Weareframework\PostmarkMadeEasy\Commands\ComposerCommand;
use Statamic\Facades\CP\Nav;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;
use Weareframework\PostmarkMadeEasy\Library\Console\Composer;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__.'/../resources/dist/js/cp.js',
    ];

    protected $routes = [
        'cp'  => __DIR__.'/../routes/cp.php',
    ];

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/postmark-made-easy.php', 'statamic.postmark-made-easy');

        $this->publishes([
            __DIR__ . '/../config/postmark-made-easy.php' => config_path('statamic/postmark-made-easy.php'),
        ], 'postmark-made-easy');
    }

    public function boot()
    {
        parent::boot();

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'postmark-made-easy');

        $this->commands([
            ComposerCommand::class
        ]);

        Statamic::booted(function () {
            $this->bootAddonNav();
        });

    }

    protected function bootAddonNav()
    {
        Nav::extend(function ($nav) {
            $items = [];

            $items['Dashboard'] = cp_route('weareframework.postmark-made-easy.dashboard.index');

            $nav->tools('Postmark Made easy')
                ->route('weareframework.postmark-made-easy.dashboard.index')
                ->icon('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28" height="28"><defs><rect id="B" width="96" height="96" x="16" y="16" rx="2"/></defs><g fill="none" fill-rule="evenodd" style="transform: translate(-3px, -3px) scale(0.2)"><use xlink:href="#B" fill="#fedd00"/><path d="M50.3 86.084V42.3H43V35h25.886c16.168 0 19.522 10.664 19.522 18.06 0 5.934-2.408 10.492-4.902 12.986-4.042 4.042-9.546 4.988-17.888 4.988h-6.536v15.05h7.654v7.3H43v-7.3zm8.772-22.102h7.3c10.75 0 13.072-4.988 13.072-11.008 0-6.88-3.87-10.664-10.32-10.664H59.082z" fill="#000"/></g></svg>')
                ->children($items);
        });

        return $this;
    }
}
