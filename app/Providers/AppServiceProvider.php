<?php

namespace App\Providers;

use App\Articles\ElasticsearchArticlesRepository;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

use Elasticsearch\Client;
use App\Articles\ArticlesRepository;
use App\Articles\EloquentArticlesRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArticlesRepository::class, ElasticsearchArticlesRepository::class);
        $this->app->bind(Client::class, function () {
            return ClientBuilder::create()
                ->setHosts(config('services.search.hosts'))
                ->build();
        });

//        $this->app->singleton(ArticlesRepository::class, function($app) {
//            // This is useful in case we want to turn-off our
//            // search cluster or when deploying the search
//            // to a live, running application at first.
//            if (!config('services.search.enabled')) {
//                return new EloquentArticlesRepository();
//            }
//
//            return new ElasticsearchArticlesRepository(
//                $app->make(Client::class)
//            );
//        });
        //dd('ok');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
