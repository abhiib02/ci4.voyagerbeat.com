<?php

namespace App\Controllers;

use App\Models\Package;
use App\Models\Option;



class PackageController extends BaseController
{

    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    // public Booking $BookingModel;
    // public Category $CategoryModel;
    // public Destination $DestinationModel;
    public function __construct()
    {
        helper('json');
        $this->PackageModel = new Package();
        $this->data['States'] = $this->PackageModel->getAllDistinctStates();
        $this->data['TotalPackageCount'] = $this->PackageModel->getAllShowPackagesCount();
        $this->data['Countries'] = $this->PackageModel->getAllDistinctCountry();
    }




    public function index($locationVar = null)
    {
        $locationVar = $locationVar ? urldecode($locationVar) : null;
        $keyword = trim(strip_tags((string) $this->request->getGet("q")));

        // 1. Location in URL param
        if (!empty($locationVar)) {
            $packages = $this->PackageModel->getPackagesByDestination($locationVar);
            $name = $locationVar;
            $title = "{$locationVar} Packages | Voyagers Beat | Live to Travel";
            $metaDesc = "{$locationVar} Packages | Voyagers Beat | {$locationVar} is the best location to travel with Voyagers beat";
            $canonical = "packages/" . $locationVar;
        }
        // 2. Search query is numeric (Package ID)
        elseif (is_numeric($keyword)) {
            $packages = $this->PackageModel->getPackageByIDForSearch($keyword);
            $name = "Package ID " . $keyword;
            $title = "{$keyword} Package ID | Voyagers Beat | Live to Travel";
            $metaDesc = "Package ID {$keyword} | Voyagers Beat | we take you to the best possible destination for travel with best services on affordable prices";
            $canonical = "packages";
        }
        // 3. Search query string provided
        elseif (!empty($keyword)) {
            $packages = $this->PackageModel->getPackagesByName($keyword);
            $name = "Search Result For " . $keyword;
            $title = "{$keyword} Packages | Voyagers Beat | Live to Travel";
            $metaDesc = "{$keyword} Packages | Voyagers Beat | {$keyword} is the best location to travel with Voyagers beat";
            $canonical = "search?q=" . urlencode($keyword);
        }
        // 4. Default case (No location, no search query)
        else {
            $packages = $this->PackageModel->getAllPackages();
            $this->data['pager'] = $this->PackageModel->pager;
            $name = "All";
            $title = "All Packages | Voyagers Beat | Live to Travel";
            $metaDesc = "Explore all available travel packages with Voyagers Beat.";
            $canonical = "packages";
        }

        $this->data = array_merge($this->data ?? [], [
            'packages'  => $packages,
            'name'      => $name,
            'title'     => $title,
            'meta_desc' => $metaDesc,
            'canonical' => $canonical,
        ]);

        return $this->Render_Page('packages/packages', $this->data);
    }

    public function upcoming()
    {
        $this->data["packages"] = $this->PackageModel->getPackagesByUpcoming();
        $this->data['pager'] = $this->PackageModel->pager;
        $this->data["name"] = "Upcoming";
        $this->data["title"] = "Upcoming Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "upcoming";

        return $this->Render_Page('packages/packages', $this->data);
    }

    public function packageByID(int $ID)
    {
        if (!$this->PackageModel->isPackageExist($ID)) {
            return redirect()->to('/packages');
        }

        $this->data['package'] = $this->PackageModel->getPackageByID($ID);
        $this->data['similarPackages'] = $this->PackageModel->getSimilarPackages($this->data['package']->LOCATION, $this->data['package']->PACKAGE_TYPE);
        $this->data['title'] = $this->data['package']->PACKAGE_NAME;
        $this->data['meta_desc'] = $this->data['package']->META_DESC;
        $this->data['canonical'] = 'package/' . $this->data['package']->SLUG;
        $this->data['image'] = base_url() . 'upload/package_images/' . $this->data['package']->PACKAGE_IMAGE;
        $this->data['noindex'] = "";
        if (isMobileDevice()) {
            return $this->Render_Page('packages/package_detail_mobile', $this->data);
        } else {
            return $this->Render_Page('packages/package_detail', $this->data);
        }
    }
    public function packageBySlug(string $slug)
    {
        if (!$this->PackageModel->isSlugExist($slug)) {
            return redirect()->to('/packages');
        }

        $this->data['package'] = $this->PackageModel->getPackageBySlug($slug);
        $this->data['similarPackages'] = $this->PackageModel->getSimilarPackages($this->data['package']->LOCATION, $this->data['package']->PACKAGE_TYPE);
        $this->data['title'] = $this->data['package']->PACKAGE_NAME;
        $this->data['meta_desc'] = $this->data['package']->META_DESC;
        $this->data['canonical'] = 'package/' . $this->data['package']->SLUG;
        $this->data['image'] = base_url() . 'upload/package_images/' . $this->data['package']->PACKAGE_IMAGE;
        $this->data['noindex'] = "";
        if (isMobileDevice()) {
            return $this->Render_Page('packages/package_detail_mobile', $this->data);
        } else {
            return $this->Render_Page('packages/package_detail', $this->data);
        }
    }
    // public function packagesByDestination(string $slug)
    // {
    //     if (!$this->DestinationModel->isSlugExist($slug)) {
    //         return redirect()->to('/destinations');
    //     }

    //     $this->data['packages'] = $this->PackageModel->getPackagesByDestination($slug);
    //     $this->data["name"] = $slug . " Packages";
    //     $this->data["title"] = $slug . " Packages | Voyagers Beat | Live to Travel";
    //     $this->data["meta_desc"] = $slug . " Packages | Voyagers Beat | " . $slug . " is the best location to travel with Voyagers beat";
    //     $this->data["canonical"] = "upcoming";

    //     return $this->Render_Page('packages/packages', $this->data);
    // }
    public function packagesByName()
    {
        $searchString = htmlspecialchars(strip_tags($this->request->getVar('keyword')));

        $this->data['packages'] = $this->PackageModel->getPackagesByName($searchString);
        $this->data["name"] = "Upcoming";
        $this->data["title"] = "Upcoming Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "upcoming";

        return $this->Render_Page('packages/packages', $this->data);
    }
    public function packagesByCategory(string $Category)
    {

        $this->data['packages'] = $this->PackageModel->getPackagesByCategory($Category);
        $this->data["name"] = $Category;
        $this->data["title"] = $Category . " Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = $Category . " Packages | Voyagers Beat | " . $Category . " Package best to travel with Voyagers beat";
        $this->data["canonical"] = "category/" . $Category;

        return $this->Render_Page('packages/packages', $this->data);
    }
    public function packagesByBadge(string $Badge)
    {

        $this->data['packages'] = $this->PackageModel->getPackagesByBadge($Badge);
        $this->data['title'] = $Badge . ' Packages | Voyagers Beat | Live to Travel';
        $this->data['name'] = $Badge;
        $this->data['meta_desc'] = $Badge . " Packages. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";;
        $this->data['canonical'] = '';
        $this->data['image'] = '';
        $this->data['noindex'] = '';
        $this->data['pageBannerText'] = $Badge . ' Packages';

        return $this->Render_Page('packages/packages', $this->data);
    }
    public function packagesByState(string $State)
    {

        $this->data['packages'] = $this->PackageModel->getPackagesByState($State);
        $this->data["name"] = $State;
        $this->data["title"] = "$State Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "/state/$State";

        return $this->Render_Page('packages/packages', $this->data);
    }

    public function packagesByCountry(string $Country)
    {

        $this->data['packages'] = $this->PackageModel->getPackagesByCountry($Country);
        $this->data["name"] = $Country;
        $this->data["title"] = "$Country Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "#voyagersbeat";
        $this->data["canonical"] = "/country/$Country";

        return $this->Render_Page('packages/packages', $this->data);
    }
    public function hiddenPackages()
    {

        $this->data['packages'] = $this->PackageModel->getHiddenPackages();
        $this->data["name"] = "Hidden";
        $this->data["title"] = "Hidden Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "";
        $this->data['noindex'] = 1;

        return $this->Render_Page('packages/packages', $this->data);
    }


    function TripTypeMeta(string $var)
    {
        $TripType = [

            "bike" => "Bike Trip is one of the best routes that you can take  to visit the place  from Delhi. Checkout bike itinerary,#voyagersbeat",

            "road" => "Best road trip from Delhi, Spiti, Manali,leh and many more  with experts enjoy your road trip with your loved ones .#voyagersbeat ",

            "treks" => "have your list handy of  treks in India, we hope you tick most of them off your list this season #voyagersbeat",

            "chilledout" => "have your list handy of Chill out places  in India, we hope you tick most of them off your list this season #voyagersbeat",

            "backpack" => "have your list handy of backpacking places  in India, we hope you tick most of them off your list this season #voyagersbeat",

            "party" => "have your list handy of party places in India, we hope you tick most of them off your list this season #voyagersbeat",

            "xmas-new-year" => " have your list handy of festive destinations in India? We hope you get to explore most of them this holiday season! #voyagersbeat",

            "corporate" => "There are many locations in India  which are famous for corporate outing and team building activities.#voyagersbeat",

            "family-trip" => "Start the journey of Second inning of your life with .#voyagersbeat",

            "honeymoon" => "Where Love Meets Adventure! ❤️✨ .voyagersbeat",
        ];
        return array_key_exists($var, $TripType) ? $TripType[$var] : null;
    }

    public function packagesByType(string $trip_type)
    {
        $trip_type = strtolower($trip_type);
        if ($trip_type != null && $this->TripTypeMeta($trip_type)) {
            $this->data["meta_desc"] = $this->TripTypeMeta($trip_type);
            $this->data["canonical"] = "type/" . $trip_type;
            $this->data["name"] = $trip_type;
            $this->data["title"] = $trip_type . " Packages | Voyagers Beat | Live to Travel";
            $this->data["packages"] = $this->PackageModel->getPackageByType($trip_type);
        } else {
            return $this->index();
        }
        return $this->Render_Page('packages/packages', $this->data);
    }

    public function packagesByTag(string $tag)
    {
        $tag = htmlspecialchars($tag);

        $this->data['packages'] = $this->PackageModel->getPackagesByTag($tag);
        $this->data['title'] = $tag . ' Packages | Voyagers Beat | Live to Travel';
        $this->data['name'] = $tag;
        $this->data['meta_desc'] = 'We take you to the best possible destination for travel with best services on affordable prices';
        $this->data['canonical'] = 'tag/' . $tag;

        return $this->Render_Page('packages/packages', $this->data);
    }
    public function packagesByNights(int $nights)
    {
        $numNights = $nights;
        $nights = htmlspecialchars($nights) . 'N';

        $this->data['packages'] = $this->PackageModel->getPackagesByNights($nights);
        $this->data["name"] = $numNights . "Nights";
        $this->data["title"] = $nights . " Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "nights/$numNights";

        return $this->Render_Page('packages/packages', $this->data);
    }
    public function packagesByNightsbyLocation(int $nights, string $locationVar)
    {
        $numNights = $nights;
        $nights = htmlspecialchars($nights) . 'N';

        $this->data['packages'] = $this->PackageModel->getPackagesByNightsandLocation($nights, $locationVar);
        $this->data["name"] = "Week end ";
        $this->data["title"] = $numNights . " Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "nights/$numNights/$locationVar";

        return $this->Render_Page('packages/packages', $this->data);
    }


    public function weekendTripsPackages()
    {
        $nights2 = '2N';
        $nights1 = '1N';

        $pack_2n = $this->PackageModel->getPackagesByNights($nights2);
        $pack_1n = $this->PackageModel->getPackagesByNights($nights1);

        $this->data['packages'] = array_merge($pack_2n, $pack_1n);
        $this->data['title'] = 'Weekend Packages | 2N/3D Packages | Voyagers Beat | Live to Travel';
        $this->data['name'] = 'Weekend';
        $this->data['meta_desc'] = 'Weekend Getaways, Budget Weekend Trips and Treks planned from major cities New Delhi , Travel with the community #voyagersbeat';
        $this->data['canonical'] = 'weekend/';

        return $this->Render_Page('packages/packages', $this->data);
    }

    public function bagPackingTripsPackages()
    {
        $nights5 = '5N';
        $nights4 = '4N';
        $nights3 = '3N';

        $pack_5n = $this->PackageModel->getPackagesByNights($nights5);
        $pack_4n = $this->PackageModel->getPackagesByNights($nights4);
        $pack_3n = $this->PackageModel->getPackagesByNights($nights3);

        $this->data['packages'] = array_merge($pack_5n, $pack_4n, $pack_3n);
        $this->data["name"] = "Upcoming";
        $this->data["title"] = "Upcoming Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "upcoming";

        return $this->Render_Page('packages/packages', $this->data);
    }

    public function update_package_form(int $id)
    {
        $this->data['package'] = $this->PackageModel->getPackageByID($id);
        $this->data['UsedTags'] = $this->PackageModel->getAllDistinctTags();
        $this->data['UsedTags'] = $this->PackageModel->getAllDistinctTags();
        $this->data['UsedBadges'] = $this->PackageModel->getAllDistinctBadges();
        $this->data['Countries'] = $this->PackageModel->getAllDistinctCountry();
        return
            view('dashboard/admin/layout/empty-header', $this->data) .
            view('dashboard/admin/pages/package-form/package-edit', $this->data) .
            view('dashboard/admin/layout/empty-footer', $this->data);
    }
    //////////////// Extra Functions //////////////////////////

    public function GetLikedPackages()
    {
        $this->data["packages"] = $this->PackageModel->getPackagesByLikes();
        $this->data['pager'] = $this->PackageModel->pager;
        $this->data["name"] = "Traveler Favorites";
        $this->data["title"] = "Traveler Favorites Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "Favorites";

        return $this->Render_Page('packages/packages', $this->data);
    }


    public function GetFavoriteCount(int $PACKAGE_ID)
    {
        $count = $this->PackageModel->getFavoritecount($PACKAGE_ID);

        return $this->response->setJSON([
            'package_id' => $PACKAGE_ID,
            'Count'      => $count,
        ]);
    }

    public function IncreaseFavoriteCount(int $PACKAGE_ID)
    {
        //$CurrentCount = $this->PackageModel->getFavoritecount($PACKAGE_ID);

        $this->PackageModel->UpdateFavoriteCount($PACKAGE_ID, 1);

        return $this->response->setJSON([
            "package_id" => $PACKAGE_ID,
            "message" => "Added To Favorites",

        ]);
    }
    public function DecreaseFavoriteCount(int $PACKAGE_ID)
    {
        $CurrentCount = $this->PackageModel->getFavoritecount($PACKAGE_ID);
        if ($CurrentCount > 0) {
            $this->PackageModel->UpdateFavoriteCount($PACKAGE_ID, -1);
        }
        return $this->response->setJSON([
            "package_id" => $PACKAGE_ID,
            "message" => "Removed From Favorites",
        ]);
    }


    //////////////// Process Functions /////////////////////////
    public function add_package_process()
    {

        $pdf = $this->request->getFile('pdf');
        if ($pdf->getSize() > 0) {
            $inputPDF = $this->validate([
                'pdf' => [
                    'uploaded[pdf]',
                    'mime_in[pdf,application/pdf]',
                ]
            ]);
            if (!$inputPDF) {
                $this->session->setFlashdata('FlashMessage', ['message' => 'File is Invalid.', 'status' => 'Danger']);
                return redirect()->to('/packages-list');
            };
            $newPDFName = $this->request->getPost('slug') . '-' . $pdf->getRandomName();
            $pdf->move('upload/package_pdf/', $newPDFName);
        } else {
            $newPDFName = '';
        }

        $rules = [
            'package_name' => 'required',
            'slug' => 'required',
            'Location' => 'required',
            'State' => 'required',
            'Country' => 'required',
            'META_DESC' => 'required|max_length[255]',
            'type' => 'required',
            'BOOKING_AMOUNT' => 'required',
            'PRICE_1' => 'required',
            'days' => 'required',
            'it' => 'required',
            'duration' => 'required',
        ];
        if (!$this->validate($rules)) {
            print_r($this->validator->listErrors());
            exit;
        }

        $DataArr = [
            'PACKAGE_NAME'      => $this->request->getPost('package_name'),
            'SLUG'      => $this->request->getPost('slug'),
            'PACKAGE_PDF'       => $newPDFName,
            'PICKNDROP'         => $this->request->getPost('PICKNDROP'),
            'PACKAGE_DAYS'      => $this->request->getPost('days'),
            'DURATION'          => $this->request->getPost('duration'),
            'STAY'              => convertDuration($this->request->getPost('days')),
            'PACKAGE_TYPE'      => $this->request->getPost('type'),
            'TAGS'              => $this->request->getPost('tags'),
            'BADGE'             => $this->request->getPost('badge'),
            'WEEKEND'           => $this->request->getPost('WEEKEND'),
            'WHATSAPP_LINK'     => $this->request->getPost('WHATSAPP_LINK'),
            'HOTEL_IMG_LINK'    => $this->request->getPost('HOTEL_IMG_LINK'),
            'HIDDEN'            => $this->request->getPost('HIDDEN'),
            'CUSTOM_TRIP'       => $this->request->getPost('CUSTOM_TRIP'),
            'UPCOMING'          => $this->request->getPost('UPCOMING'),
            'INCLUSION'         => $this->request->getPost('Inclusion'),
            'EXCLUSION'         => $this->request->getPost('Exclusion'),
            'LOCATION'          => $this->request->getPost('Location'),
            'STATE'             => $this->request->getPost('State'),
            'COUNTRY'           => $this->request->getPost('Country'),
            'TRIP_HIGHLIGHT'    => $this->request->getPost('TRIP_HIGHLIGHT'),
            'META_DESC'         => $this->request->getPost('META_DESC'),
            'PACKAGE_IMAGE'     => $this->request->getPost('image'),
            'PACKAGE_THUMBNAIL' => $this->request->getPost('image'),
            'IMAGE_1'           => $this->request->getPost('IMAGE_1'),
            'IMAGE_2'           => $this->request->getPost('IMAGE_2'),
            'IMAGE_3'           => $this->request->getPost('IMAGE_3'),
            'IMAGE_4'           => $this->request->getPost('IMAGE_4'),
            'PACKAGE_MISC'      => $this->request->getPost('PACKAGE_MISC'),
            'PACKAGE_TNC'       => $this->request->getPost('PACKAGE_TNC'),
            'PACKAGE_FAQ'       => $this->request->getPost('PACKAGE_FAQ'),
            'PACK_IT'           => $this->request->getPost('it'),
            'SPACIAL_OFFER'     => $this->request->getPost('SPACIAL_OFFER'),
            'BOOKING_AMOUNT'    => $this->request->getPost('BOOKING_AMOUNT'),
            'REQUEST_PRICE'     => $this->request->getPost('REQUEST_PRICE'),
            'HEAD_PRICE'        => $this->request->getPost('HEAD_PRICE'),
            'HEAD_WTPRICE'      => $this->request->getPost('HEAD_WTPRICE'),
            'HEAD_WT2PRICE'     => $this->request->getPost('HEAD_WT2PRICE'),
            'PRICE_1'           => $this->request->getPost('PRICE_1'),
            'PRICE_2'           => $this->request->getPost('PRICE_2'),
            'PRICE_3'           => $this->request->getPost('PRICE_3'),
            'PRICE_4'           => $this->request->getPost('PRICE_4'),
            'PRICE_5'           => $this->request->getPost('PRICE_5'),
            'S_PRICE_1'         => $this->request->getPost('S_PRICE_1'),
            'S_PRICE_2'         => $this->request->getPost('S_PRICE_2'),
            'S_PRICE_3'         => $this->request->getPost('S_PRICE_3'),
            'S_PRICE_4'         => $this->request->getPost('S_PRICE_4'),
            'S_PRICE_5'         => $this->request->getPost('S_PRICE_5'),
            'WT_PRICE_1'        => $this->request->getPost('WT_PRICE_1'),
            'WT_PRICE_2'        => $this->request->getPost('WT_PRICE_2'),
            'WT_PRICE_3'        => $this->request->getPost('WT_PRICE_3'),
            'WT_PRICE_4'        => $this->request->getPost('WT_PRICE_4'),
            'WT_PRICE_5'        => $this->request->getPost('WT_PRICE_5'),
            'WT2_PRICE_1'       => $this->request->getPost('WT2_PRICE_1'),
            'WT2_PRICE_2'       => $this->request->getPost('WT2_PRICE_2'),
            'WT2_PRICE_3'       => $this->request->getPost('WT2_PRICE_3'),
            'WT2_PRICE_4'       => $this->request->getPost('WT2_PRICE_4'),
            'WT2_PRICE_5'       => $this->request->getPost('WT2_PRICE_5'),
            'INFO_P1'           => $this->request->getPost('INFO_P1'),
            'INFO_P2'           => $this->request->getPost('INFO_P2'),
            'INFO_P3'           => $this->request->getPost('INFO_P3'),
            'INFO_P4'           => $this->request->getPost('INFO_P4'),
            'INFO_P5'           => $this->request->getPost('INFO_P5'),
            'DATES'             => $this->request->getPost('DATES'),
        ];

        if ($this->PackageModel->isSlugExist($this->request->getPost('slug'))) {
            $DataArr['SLUG'] = $this->request->getPost('slug') . date('his');
        }
        $this->PackageModel->insertPackage($DataArr);
        //print_r($this->PackageModel->errors());
        $this->session->setFlashdata('FlashMessage', ['message' => 'Package Added Sucessfully.', 'status' => 'success']);
        return redirect()->to('/dashboard/packages-list');
    }
    public function update_package_process()
    {

        $ID = $this->request->getPost('PACKAGE_ID');

        // 1. Validate incoming POST request directly
        $rules = [
            'package_name'   => 'required',
            'slug'           => 'required',
            'Location'       => 'required',
            'State'          => 'required',
            'Country'        => 'required',
            'META_DESC'      => 'required|max_length[255]',
            'type'           => 'required',
            'BOOKING_AMOUNT' => 'required',
            'PRICE_1'        => 'required',
            'days'           => 'required',
            'it'             => 'required',
            'duration'       => 'required',
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('FlashMessage', [
                'message' => 'Check All Fields Before Submit',
                'status'  => 'Warning',
            ]);

            return redirect()->back()->withInput();
        }
        $DataArr = [
            'PACKAGE_NAME'      => $this->request->getPost('package_name'),
            'SLUG'              => $this->request->getPost('slug'),
            'PICKNDROP'         => $this->request->getPost('PICKNDROP'),
            'PACKAGE_DAYS'      => $this->request->getPost('days'),
            'DURATION'          => $this->request->getPost('duration'),
            'STAY'              => convertDuration($this->request->getPost('days')),
            'PACKAGE_TYPE'      => $this->request->getPost('type'),
            'TAGS'              => $this->request->getPost('tags'),
            'BADGE'             => $this->request->getPost('badge'),
            'WEEKEND'           => $this->request->getPost('WEEKEND'),
            'WHATSAPP_LINK'     => $this->request->getPost('WHATSAPP_LINK'),
            'HOTEL_IMG_LINK'    => $this->request->getPost('HOTEL_IMG_LINK'),
            'HIDDEN'            => $this->request->getPost('HIDDEN'),
            'CUSTOM_TRIP'       => $this->request->getPost('CUSTOM_TRIP'),
            'UPCOMING'          => $this->request->getPost('UPCOMING'),
            'INCLUSION'         => $this->request->getPost('Inclusion'),
            'EXCLUSION'         => $this->request->getPost('Exclusion'),
            'LOCATION'          => $this->request->getPost('Location'),
            'STATE'             => $this->request->getPost('State'),
            'COUNTRY'           => $this->request->getPost('Country'),
            'TRIP_HIGHLIGHT'    => $this->request->getPost('TRIP_HIGHLIGHT'),
            'META_DESC'         => $this->request->getPost('META_DESC'),
            'PACKAGE_IMAGE'     => $this->request->getPost('image'),
            'PACKAGE_THUMBNAIL' => $this->request->getPost('image'),
            'IMAGE_1'           => $this->request->getPost('IMAGE_1'),
            'IMAGE_2'           => $this->request->getPost('IMAGE_2'),
            'IMAGE_3'           => $this->request->getPost('IMAGE_3'),
            'IMAGE_4'           => $this->request->getPost('IMAGE_4'),
            'PACKAGE_MISC'      => $this->request->getPost('PACKAGE_MISC'),
            'PACKAGE_TNC'       => $this->request->getPost('PACKAGE_TNC'),
            'PACKAGE_FAQ'       => $this->request->getPost('PACKAGE_FAQ'),
            'PACK_IT'           => $this->request->getPost('it'),
            'SPACIAL_OFFER'     => $this->request->getPost('SPACIAL_OFFER'),
            'BOOKING_AMOUNT'    => $this->request->getPost('BOOKING_AMOUNT'),
            'REQUEST_PRICE'     => $this->request->getPost('REQUEST_PRICE'),
            'HEAD_PRICE'        => $this->request->getPost('HEAD_PRICE'),
            'HEAD_WTPRICE'      => $this->request->getPost('HEAD_WTPRICE'),
            'HEAD_WT2PRICE'     => $this->request->getPost('HEAD_WT2PRICE'),
            'PRICE_1'           => $this->request->getPost('PRICE_1'),
            'PRICE_2'           => $this->request->getPost('PRICE_2'),
            'PRICE_3'           => $this->request->getPost('PRICE_3'),
            'PRICE_4'           => $this->request->getPost('PRICE_4'),
            'PRICE_5'           => $this->request->getPost('PRICE_5'),
            'S_PRICE_1'         => $this->request->getPost('S_PRICE_1'),
            'S_PRICE_2'         => $this->request->getPost('S_PRICE_2'),
            'S_PRICE_3'         => $this->request->getPost('S_PRICE_3'),
            'S_PRICE_4'         => $this->request->getPost('S_PRICE_4'),
            'S_PRICE_5'         => $this->request->getPost('S_PRICE_5'),
            'WT_PRICE_1'        => $this->request->getPost('WT_PRICE_1'),
            'WT_PRICE_2'        => $this->request->getPost('WT_PRICE_2'),
            'WT_PRICE_3'        => $this->request->getPost('WT_PRICE_3'),
            'WT_PRICE_4'        => $this->request->getPost('WT_PRICE_4'),
            'WT_PRICE_5'        => $this->request->getPost('WT_PRICE_5'),
            'WT2_PRICE_1'       => $this->request->getPost('WT2_PRICE_1'),
            'WT2_PRICE_2'       => $this->request->getPost('WT2_PRICE_2'),
            'WT2_PRICE_3'       => $this->request->getPost('WT2_PRICE_3'),
            'WT2_PRICE_4'       => $this->request->getPost('WT2_PRICE_4'),
            'WT2_PRICE_5'       => $this->request->getPost('WT2_PRICE_5'),
            'INFO_P1'           => $this->request->getPost('INFO_P1'),
            'INFO_P2'           => $this->request->getPost('INFO_P2'),
            'INFO_P3'           => $this->request->getPost('INFO_P3'),
            'INFO_P4'           => $this->request->getPost('INFO_P4'),
            'INFO_P5'           => $this->request->getPost('INFO_P5'),
            'DATES'             => $this->request->getPost('DATES'),
        ];




        $pdf = $this->request->getFile('pdf');
        if ($pdf && $pdf->isValid() && !$pdf->hasMoved()) {
            if ($pdf->getSize() > 0) {
                $newPDFName = $this->request->getPost('slug') . '-' . $pdf->getRandomName();
                $pdf->move('upload/package_pdf/', $newPDFName);
                $DataArr['PACKAGE_PDF'] = $newPDFName;

                // Clean up old PDF if it exists
                $oldpdfPath = 'upload/package_pdf/' . $this->request->getPost('pdf_old');
                if (!is_dir($oldpdfPath) && file_exists($oldpdfPath)) {
                    unlink($oldpdfPath);
                }
            }
        }

        $this->PackageModel->UpdatePackage($ID, $DataArr);
        $this->session->setFlashdata('FlashMessage', ['message' => 'Package ID:' . $ID . ' Update', 'status' => 'info']);
        if ($this->request->getGet('Adminlist') == '1') {
            return redirect()->to('/dashboard/packages-list');
        } else {
            return redirect()->to('/packageid/' . $ID);
        }
    }
    public function duplicate_package_process(int $PACKAGE_ID)
    {

        $package = $this->PackageModel->getPackageByID($PACKAGE_ID);
        $packageData = (array) $package;
        unset($packageData['PACKAGE_ID']);
        $packageData['SLUG'] =  $packageData['SLUG'] . '-' . date("hidmy");
        $packageData['PACKAGE_NAME']  =  $packageData['PACKAGE_NAME']  . '-copy';
        $this->PackageModel->insertPackage($packageData);
        return redirect()->to('/package/' . $packageData['SLUG']);
    }

    public function delete_package_process()
    {
        $id = $this->request->getPost('id');
        $pdfPath = 'upload/package_pdf/' . $this->request->getPost('pdf');
        if (!is_dir($pdfPath) && file_exists($pdfPath)) {
            unlink($pdfPath);
        }
        if (!$this->PackageModel->deletePackageByID($id)) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Error Occured', 'status' => 'Danger']);
            return redirect()->to('/dashboard/packages-list');
        }
        $this->session->setFlashdata('FlashMessage', ['message' => 'Package ID:' . $id . ' Deleted', 'status' => 'Danger']);
        return redirect()->to('/dashboard/packages-list');
    }
    // public function import_package_process()
    // {
    //     helper(['dateFormat', 'itinerary']);
    //     $Imported_json = $this->request->getFile('imported_json');

    //     $inputJSON = $this->validate([
    //         'imported_json' => [
    //             'uploaded[imported_json]',
    //             'mime_in[imported_json,application/json]',
    //         ]
    //     ]);

    //     if (!$inputJSON) {
    //         $this->session->setFlashdata('FlashMessage', ['message' => 'File is Invalid.', 'status' => 'Danger']);
    //         return redirect()->to('/packages-list');
    //     };

    //     $json = file_get_contents($Imported_json);

    //     $obj  = json_decode($json);

    //     if ($obj[0]->PACKAGE_PDF != "") {
    //         $PDF = 'https://voyagersbeat.com/pdf/' . $obj[0]->PACKAGE_PDF;
    //     } else {
    //         $PDF = "";
    //     }

    //     $slug = strtolower(str_replace(" ", "-", $obj[0]->PACKAGE_NAME));
    //     if ($this->PackageModel->isSlugExist($slug)) {
    //         $this->session->setFlashdata('FlashMessage', ['message' => 'Package Already Exist.', 'status' => 'Danger']);
    //         return redirect()->to('/packages-list');
    //     }

    //     $nights = substr($obj[0]->PACKAGE_DAYS, 0, 1);



    //     $stay = $nights . "N/" . ($nights + 1) . "D";



    //     $OBJIMGARR = [
    //         $obj[0]->IMAGE_1,
    //         $obj[0]->IMAGE_2,
    //         $obj[0]->IMAGE_3,
    //         $obj[0]->IMAGE_4
    //     ];

    //     $ImagesArr = [];

    //     foreach ($OBJIMGARR as $Image) {
    //         if ($Image != '') {
    //             array_push($ImagesArr, $Image);
    //         }
    //     }

    //     $OBJPrice = [
    //         ["sharing" => $obj[0]->INFO_P1, "price" => $obj[0]->PRICE_1],
    //         ["sharing" => $obj[0]->INFO_P2, "price" => $obj[0]->PRICE_2],
    //         ["sharing" => $obj[0]->INFO_P3, "price" => $obj[0]->PRICE_3],
    //         ["sharing" => $obj[0]->INFO_P4, "price" => $obj[0]->PRICE_4],
    //         ["sharing" => $obj[0]->INFO_P5, "price" => $obj[0]->PRICE_5],
    //     ];

    //     $Price = [];

    //     foreach ($OBJPrice as $row) {
    //         if (($row['price'] != "") && ($row['price'] != "0")) {
    //             array_push($Price, $row);
    //         }
    //     }

    //     $vb_datesArr = explode(',', $obj[0]->DATES);
    //     $Dates = [];
    //     foreach ($vb_datesArr as $date) {
    //         array_push($Dates, ["date" => formatDateRange($date)]);
    //     }
    //     $raw = $obj[0]->PACK_IT;
    //     $itinerary = mergeTitleandDesc($raw);




    //     $DataArr = [
    //         'NAME' => $obj[0]->PACKAGE_NAME,
    //         'SLUG' => $slug,
    //         'CATEGORY' => '',
    //         'TAGS' =>  strtolower($obj[0]->TAGS),
    //         'IS_INTERNATIONAL' => 0,
    //         'DESTINATION' => $obj[0]->LOCATION,
    //         'STATE' => $obj[0]->STATE,
    //         'COUNTRY' => '',
    //         'DESCRIPTION' => $obj[0]->META_DESC,
    //         'PRICE' => json_encode($Price),
    //         'STAY' => $stay,
    //         'BADGE' => '',
    //         'BOOKING_AMOUNT' => BOOKING_AMOUNT,
    //         'CONTACT' => '',
    //         'CUSTOM_DATES' => NULL,
    //         'CUSTOM_PRICE' => NULL,
    //         'FEATURED_IMAGE' => $obj[0]->PACKAGE_IMAGE,
    //         'PDF' =>  $PDF,
    //         'HIGHLIGHTS' => $obj[0]->TRIP_HIGHLIGHT,
    //         'INCLUSION' => $obj[0]->INCLUSION,
    //         'EXCLUSION' => $obj[0]->EXCLUSION,
    //         'ITINERARY' => $itinerary,
    //         'DATES' => json_encode($Dates),
    //         'DURATION' => $obj[0]->DURATION,
    //         'IMAGES' => json_encode($ImagesArr),
    //         'VIDEOS' => '',
    //         'MISC' => $obj[0]->PACKAGE_MISC,
    //     ];


    //     $this->PackageModel->insertPackage($DataArr);
    //     $ID = $this->PackageModel->getIDfromSlug($DataArr['SLUG'])[0]->ID;

    //     $this->session->setFlashdata('FlashMessage', ['message' => 'Package Imported Sucessfully.', 'status' => 'success']);
    //     return redirect()->to("/update-package/$ID");
    // }

    public function packageDatesJSON(int $id)
    {
        $this->data['packageDates'] = $this->PackageModel->getPackageDatesByID($id);
        return $this->response->setJSON($this->data['packageDates']);
    }
}
