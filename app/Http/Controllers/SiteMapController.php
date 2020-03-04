<?php

namespace App\Http\Controllers;
use App\Models\SiteMap;
use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SiteMapController extends Controller
{
    private $siteMap;

    public function index()
    {
        $siteMapXml = Cache::remember('sitemap', 3, function () {
            $this->siteMap = new SiteMap();

            $this->addUniqueRoutes();
            $this->addArticles();
            $this->addCategories();
            $this->addDynamicPages();
            $this->addTags();
            $this->addProjects();
            $this->addProfilePages();

            return $this->siteMap->build();
        });

        return response($siteMapXml, 200)
            ->header('Content-Type', 'text/xml');
    }

    private function addUniqueRoutes()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->format('c');

        $this->siteMap->add(
            Url::create('/')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('1.00')
        );

        $this->siteMap->add(
            Url::create('/associacio')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.8')
        );

        $this->siteMap->add(
            Url::create('/blog')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.8')
        );

        $this->siteMap->add(
            Url::create('/socis')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.8')
        );

        $this->siteMap->add(
            Url::create('/fes-te-soci')
                ->lastUpdate($startOfMonth)
                ->frequency('monthly')
                ->priority('0.8')
        );
    }
    private function addProfilePages()
    {
        // ...
    }

    private function addArticles()
    {
        // ...
    }

    private function addCategories()
    {
        // ...
    }

    private function addTags()
    {
        // ...
    }

    private function addProjects()
    {
        // ...
    }

    private function addDynamicPages()
    {
        // ...
    }
}
