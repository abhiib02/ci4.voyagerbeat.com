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

        $this->data["title"] = 'Voyagers Beat | Offbeat Group Tours | Pack your bags & Let us do the rest';
        $this->data["meta_desc"] = 'Discover offbeat destinations, river rafting, paragliding & custom tour packages with Voyagers Beat. Just pack your bags let us do the rest!';
        $this->data["canonical"] = '';
        $this->data["OGurl"] = '/';


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
        $this->data["title"] = 'About Us | Voyagers Beat Travel & Adventure Agency';
        $this->data["meta_desc"] = 'At Voyagers Beat, we handle every detail of your trip—from hidden stays to thrilling adventures. Discover our mission and why travelers trust our journeys';
        $this->data["canonical"] = 'about';
        return $this->Render_Page('static/about', $this->data);
    }
    public function career(): string
    {
        $this->data["title"] = 'Careers at Voyagers Beat | Join Our Travel Team';
        $this->data["meta_desc"] = 'Turn your passion for travel into a career. Explore open roles in trip planning, operations & marketing at Voyagers Beat and help craft unforgettable journeys.';
        $this->data["canonical"] = 'career';
        return $this->Render_Page('static/career', $this->data);
    }
    public function privacypolicy(): string
    {
        $this->data["title"] = 'Privacy Policy | Voyagers Beat Travel Agency';
        $this->data["meta_desc"] = 'Read Voyagers Beats Privacy Policy to understand how we collect, use, and protect your personal information when you browse or book tour packages with us.';
        $this->data["canonical"] = 'privacy-policy';
        return $this->Render_Page('static/privacypolicy', $this->data);
    }
    public function termsnconditions(): string
    {
        $this->data["title"] = 'Terms and Conditions | Voyagers Beat Travel Agency';
        $this->data["meta_desc"] = 'Review the Terms and Conditions for booking tour packages with Voyagers Beat. Read our policies on trip reservations, payments, cancellations, and refunds.';
        $this->data["canonical"] = 'term-conditions';
        return $this->Render_Page('static/termsnconditions', $this->data);
    }
    public function cancellationPolicy(): string
    {
        $this->data["title"] = 'Cancellation & Refund Policy | Voyagers Beat Tours';
        $this->data["meta_desc"] = 'Review Voyagers Beats Cancellation and Refund Policy. Get clear details on trip cancellations, rescheduling timelines, refund eligibility, and booking terms.';
        $this->data["canonical"] = 'cancellation-policy';
        return $this->Render_Page('static/cancellation-policy', $this->data);
    }
    public function recognition(): string
    {
        $this->data["title"] = 'Awards & Recognition | Voyagers Beat Travel Agency';
        $this->data["meta_desc"] = 'Explore Voyagers Beats official certifications, tourism affiliations, and industry recognition. See why travelers trust our accredited adventure tour agency.';
        $this->data["canonical"] = 'recognition';
        return $this->Render_Page('static/recognition', $this->data);
    }
    public function sitemapGenerate()
    {
        $packages     = $this->PackageModel->getAllPackagesInMobile();
        $packageTypes = $this->PackageModel->getAllDistinctType();
        $States       = $this->PackageModel->getAllDistinctStates();
        $Countries    = $this->PackageModel->getAllDistinctCountry();
        $staticPages = [
            'packages',
            'about',
            'career',
            'upcoming',
            'travelerFavorites',
            'nights/1',
            'nights/2',
            'nights/3',
            'recognition',
            'blogs',
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
        foreach ($States as $State) {
            $sitemap->add(base_url() . 'state/' . $State, date('c'), '1.0', 'weekly');
        }
        foreach ($Countries as $Country) {
            $sitemap->add(base_url() . 'country/' . $Country, date('c'), '1.0', 'weekly');
        }

        $xml = trim($sitemap->renderXml());

        // Discard anything already echoed (whitespace, notices, etc.)
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: application/xml; charset=utf-8');
        echo $xml;
        exit;
    }
}
