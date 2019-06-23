<?php


namespace UserForce\Scraper;

use Illuminate\Support\ServiceProvider;

class ScraperServiceProvider extends ServiceProvider
{
    const COMPONENT_NAME = 'uf.scraper';

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->registerComponent();
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {

    }

    private function registerComponent()
    {
        $this->app->bindIf(
            ScraperServiceProvider::COMPONENT_NAME,
            function () {
                return new Scraper;
            },
            true
        );

        $this->app->alias(ScraperServiceProvider::COMPONENT_NAME, Scraper::class);
    }
}