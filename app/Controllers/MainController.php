<?php

namespace App\Controllers;

use App\Models\Package;
use App\Models\Option;
use App\Models\User;
use Rumenx\Sitemap\Sitemap;

class MainController extends BaseController
{

    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    public User $UserModel;



    public function __construct()
    {
        $this->PackageModel = new Package();
    }

    public function index(): string
    {
        helper('useragentstring');
        if (isMobileDevice()) {
            $this->data['banners'] = $this->OptionModel->getOptionValue('HomeBanner');
            $this->data['packages'] = $this->PackageModel->getAllPackagesInMobile();
            $this->data['pager'] = $this->PackageModel->pager;
            return $this->Render_Page('home-mobile', $this->data);
        } else {
            $this->data['packages_1n'] = $this->PackageModel->getPackagesByNightsWeekend('1N');
            $this->data['packages_2n'] = $this->PackageModel->getPackagesByNightsWeekend('2N');
            $this->data['packages_3n'] = $this->PackageModel->getPackagesByNightsWeekend('3N');
            $this->data['domesticDests'] = $this->PackageModel->getAllDomesticDestination();

            $this->data['MainFormImage'] = $this->OptionModel->getOptionValue('MainFormImage');
            return $this->Render_Page('home', $this->data);
        }
    }

    public function about(): string
    {
        return $this->Render_Page('static/about', $this->data);
    }
    public function career(): string
    {
        return $this->Render_Page('static/career', $this->data);
    }
    public function privacypolicy(): string
    {
        return $this->Render_Page('static/privacypolicy', $this->data);
    }
    public function termsnconditions(): string
    {
        return $this->Render_Page('static/termsnconditions', $this->data);
    }
    public function cancellationPolicy(): string
    {
        return $this->Render_Page('static/cancellation-policy', $this->data);
    }
    public function recognition(): string
    {
        return $this->Render_Page('static/recognition', $this->data);
    }
    public function sitemapGenerate()
    {
        // Set the content type header to XML
        header('Content-Type: application/xml; charset=utf-8');
        $packages = $this->PackageModel->getAllPackagesInMobile();
        $packageTypes = $this->PackageModel->getAllDistinctType();
        $States = $this->PackageModel->getAllDistinctStates();
        $Countries = $this->PackageModel->getAllDistinctCountry();
        $staticPages = [
            '',
            'packages',
            'about',
            'career',
            'upcoming',
            'travelerFavorites',
            'nights/1',
            'nights/2',
            'nights/3',
        ];
        $sitemap = new Sitemap();

        foreach ($staticPages as $staticPage) {
            $sitemap->add(base_url() . $staticPage, date('c'), '1.0', 'weekly');
        }
        foreach ($packages as $package) {
            $sitemap->add(base_url() . 'package/' . $package->SLUG, date('c'), '1.0', 'weekly');
        }
        foreach ($packageTypes as $packageType) {
            $sitemap->add(base_url() . 'type/' . $packageType, date('c'), '1.0', 'weekly');
        }
        foreach ($packageTypes as $packageType) {
            $sitemap->add(base_url() . 'type/' . $packageType, date('c'), '1.0', 'weekly');
        }
        foreach ($States as $State) {
            $sitemap->add(base_url() . 'state/' . $State, date('c'), '1.0', 'weekly');
        }
        foreach ($Countries as $Country) {
            $sitemap->add(base_url() . 'country/' . $Country, date('c'), '1.0', 'weekly');
        }
        // Generates and prints the compliant XML string
        echo $sitemap->renderXml();
        exit;
    }
}
