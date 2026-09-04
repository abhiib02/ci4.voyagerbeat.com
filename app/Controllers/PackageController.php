<?php

namespace App\Controllers;

use App\Models\Package;


class PackageController extends BaseController
{

    public $data = [];
    public $PackageModel, $DestinationModel, $OptionModel, $BookingModel, $CategoryModel;
    public function __construct()
    {
        helper('json');
        $this->PackageModel = new Package();
        
        $this->data['States'] = $this->PackageModel->getAllDistinctStates();
        $this->data['Countries'] = $this->PackageModel->getAllDistinctCountry();
        
    }

   


    public function index($locationVar = null)
    {   $locationVar = urldecode($locationVar);
        $keyword = strip_tags($this->request->getGet("q"));

        if ($locationVar != null) {

            $this->data["packages"] = $this->PackageModel->getPackagesByDestination($locationVar);
            $this->data["name"] = $locationVar;
            $this->data["title"] = $locationVar . " Packages | Voyagers Beat | Live to Travel";
            $this->data["meta_desc"] = $locationVar . " Packages | Voyagers Beat | " . $locationVar . " is the best location to travel with Voyagers beat";
            $this->data["canonical"] = "packages/" . $locationVar;
        } else {
            if(is_numeric($keyword)){
                        
                $this->data["name"] = "Package ID " . $keyword;
                $this->data["title"] = $keyword . " Package ID | Voyagers Beat | Live to Travel";
                $this->data["meta_desc"] = "Package ID " . $keyword . " | Voyagers Beat | we take you to the best possible destination for travel with best services on affordable prices";
                $this->data["canonical"] = "packages";
                $this->data["packages"] = $this->PackageModel->getPackageByIDForSearch($keyword);
            } else {
                
                $this->data["name"] =  "Search Result For ".$keyword;
                $this->data['title'] =  $keyword . " Packages | Voyagers Beat | Live to Travel";
                $this->data['meta_desc'] = $keyword . " Packages | Voyagers Beat | " . $keyword . " is the best location to travel with Voyagers beat";;
                $this->data['canonical'] = "search?q=" . $keyword;
                $this->data['packages'] = $this->PackageModel->getPackagesByName($keyword);
            }
        }
        
        return $this->Render_Page('packages/packages', $this->data);
    }

    public function upcoming()
    {
        $this->data["packages"] = $this->PackageModel->getPackagesByUpcoming();
        $this->data["name"] = "Upcoming";
        $this->data["title"] = "Upcoming Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "upcoming";

        return $this->Render_Page('packages/packages', $this->data);
    }

    public function packageByID($ID)
    {

        
        if (!$this->PackageModel->isPackageExist($ID)) {
            return redirect()->to('/packages');
        }
        
        $this->data['package'] = $this->PackageModel->getPackageByID($ID);
        
        $this->data['title'] = $this->data['package']->PACKAGE_NAME;
        $this->data['meta_desc'] = $this->data['package']->META_DESC;
        $this->data['canonical'] = 'package/' . $this->data['package']->SLUG;
        $this->data['image'] = base_url() . 'upload/package_images/' . $this->data['package']->PACKAGE_IMAGE;
        $this->data['noindex'] = "";

        return $this->Render_Page('packages/package_detail', $this->data);
        
    }
    public function packageBySlug($slug)
    {

        if (!$this->PackageModel->isSlugExist($slug)) {
            return redirect()->to('/packages');
        }
        
        $this->data['package'] = $this->PackageModel->getPackageBySlug($slug);
        $this->data['title'] = $this->data['package']->PACKAGE_NAME;
        $this->data['meta_desc'] = $this->data['package']->META_DESC;
        $this->data['canonical'] = 'package/' . $this->data['package']->SLUG;
        $this->data['image'] = base_url() . 'upload/package_images/' . $this->data['package']->PACKAGE_IMAGE;
        $this->data['noindex'] = "";
        return $this->Render_Page('packages/package_detail', $this->data);
        
    }
    public function packagesByDestination($slug)
    {

        if (!$this->DestinationModel->isSlugExist($slug)) {
            return redirect()->to('/destinations');
        }

        $this->data['packages'] = $this->PackageModel->getPackagesByDestination($slug);
        $this->data["name"] = $slug." Packages";
        $this->data["title"] = $slug." Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = $slug." Packages | Voyagers Beat | ".$slug." is the best location to travel with Voyagers beat";
        $this->data["canonical"] = "upcoming";

        return $this->Render_Page('packages/packages', $this->data);
    }
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
    public function packagesByCategory($Category)
    {
        
        $this->data['packages'] = $this->PackageModel->getPackagesByCategory($Category);
        $this->data["name"] = $Category;
        $this->data["title"] = $Category." Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = $Category." Packages | Voyagers Beat | ".$Category." Package best to travel with Voyagers beat";
        $this->data["canonical"] = "category/".$Category;
        
        return $this->Render_Page('packages/packages', $this->data);
    }
    public function packagesByBadge($Badge)
    {
        
        $this->data['packages'] = $this->PackageModel->getPackagesByBadge($Badge);
        $this->data['title'] = $Badge .' Packages | Voyagers Beat | Live to Travel';
        $this->data['name'] = $Badge;
        $this->data['meta_desc'] = $Badge."     Packages. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";;
        $this->data['canonical'] = '';
        $this->data['image'] = '';
        $this->data['noindex'] = '';
        $this->data['pageBannerText'] = $Badge.' Packages';
        //$this->data['pageBannerImage'] = $this->DestinationModel->getDestinationBySlug($slug)->IMAGE;
        
        return $this->Render_Page('packages/packages', $this->data);
    }
    public function packagesByState($State)
    {
        
        $this->data['packages'] = $this->PackageModel->getPackagesByState($State);
        $this->data["name"] = "Upcoming";
        $this->data["title"] = "Upcoming Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "upcoming";
        
        return $this->Render_Page('packages/packages', $this->data);
    }

    public function packagesByCountry($Country)
    {
        
        $this->data['packages'] = $this->PackageModel->getPackagesByCountry($Country);
        $this->data["name"] = "Upcoming";
        $this->data["title"] = "Upcoming Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "upcoming";
        
        return $this->Render_Page('packages/packages', $this->data);
    }

    
    public function packagesByTag($tag)
    {
        $tag = htmlspecialchars($tag);

        $this->data['packages'] = $this->PackageModel->getPackagesByTag($tag);
        $this->data['title'] = $tag.' Packages | Voyagers Beat | Live to Travel';
        $this->data['name'] = $tag;
        $this->data['meta_desc'] = 'We take you to the best possible destination for travel with best services on affordable prices';
        $this->data['canonical'] = 'tag/'.$tag;

        return $this->Render_Page('packages/packages', $this->data);
    }
    public function packagesByNights($nights)
    {
        $nights = htmlspecialchars($nights).'N';

        $this->data['packages'] = $this->PackageModel->getPackagesByNights($nights);
        $this->data["name"] = $nights."inghts";
        $this->data["title"] = $nights." Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "upcoming";

        return $this->Render_Page('packages/packages', $this->data);
    }

    public function weekendTripsPackages()
    {
        $nights2 = '2N';
        $nights1 = '1N';

        $pack_2n = $this->PackageModel->getPackagesByNights($nights2);
        $pack_1n = $this->PackageModel->getPackagesByNights($nights1);

        $this->data['packages'] = array_merge($pack_2n,$pack_1n);
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

        $this->data['packages'] = array_merge($pack_5n,$pack_4n,$pack_3n);
        $this->data["name"] = "Upcoming";
        $this->data["title"] = "Upcoming Packages | Voyagers Beat | Live to Travel";
        $this->data["meta_desc"] = "upcoming weekends, road trips and treks from Delhi. Join upcoming group trips from INDIA and experience seamless travel itineraries.#voyagersbeat";
        $this->data["canonical"] = "upcoming";
        
        return $this->Render_Page('packages/packages', $this->data);
    }

    


    public function add_package_process()
    {


        $Featured_Image = $this->request->getFile('featured_image');
        
        $inputFile = $this->validate([
            'featured_image' => [
                'uploaded[featured_image]',
                'mime_in[featured_image,image/png,image/jpg,image/jpeg,,image/webp]',
            ]
        ]);
        if (!$inputFile) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Image is Invalid.', 'status' => 'Danger']);
            return redirect()->to('/packages-list');
        };
        $newName = $Featured_Image->getRandomName();
        $Featured_Image->move('upload/package_images/', $newName);

        $pdf = $this->request->getFile('pdf');
        if($pdf->getSize() > 0){
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
            $newPDFName = $this->request->getPost('slug').'-'.$pdf->getRandomName();
            $pdf->move('upload/package_pdf/', $newPDFName);
        }
        else{
            $newPDFName = '';
        }
        
        

        $rules = [
            'name' => 'required',
            'slug' => 'required',
            'destination' => 'required',
            'state' => 'required',
            'country' => 'required',
            'description' => 'required|max_length[255]',
            'is_international' => 'required',
            'category' => 'required',
            'booking_amount' => 'required',
            'price' => 'required',
            'stay' => 'required',
            'itinerary' => 'required',
            'duration' => 'required',
        ];
        $DataArr = [
            'NAME' => $this->request->getPost('name'),
            'SLUG' => $this->request->getPost('slug'),
            'CATEGORY' => $this->request->getPost('category'),
            'TAGS' =>  strtolower($this->request->getPost('tags')),
            'IS_INTERNATIONAL' => $this->request->getPost('is_international'),
            'DESTINATION' => $this->request->getPost('destination'),
            'STATE' => $this->request->getPost('state'),
            'COUNTRY' => $this->request->getPost('country'),
            'DESCRIPTION' => $this->request->getPost('description'),
            'PRICE' => $this->request->getPost('price'),
            'STAY' => $this->request->getPost('stay'),
            'BADGE' => $this->request->getPost('badge'),
            'BOOKING_AMOUNT' => $this->request->getPost('booking_amount'),
            'CONTACT' => $this->request->getPost('contact_number'),
            'CUSTOM_DATES' => $this->request->getPost('custom_dates'),
            'CUSTOM_PRICE' => $this->request->getPost('custom_price'),
            'FEATURED_IMAGE' => $newName,
            'PDF' => $newPDFName,
            'HIGHLIGHTS' => $this->request->getPost('highlights'),
            'INCLUSION' => $this->request->getPost('inclusion'),
            'EXCLUSION' => $this->request->getPost('exclusion'),
            'ITINERARY' => $this->request->getPost('itinerary'),
            'DATES' => $this->request->getPost('dates'),
            'DURATION' => $this->request->getPost('duration'),
            'IMAGES' => $this->request->getPost('images'),
            'VIDEOS' => $this->request->getPost('videos'),
            'MISC' => $this->request->getPost('misc'),
        ];
        
        if ($this->PackageModel->isSlugExist($this->request->getPost('slug'))) {
            $DataArr['SLUG'] = $this->request->getPost('slug') . date('his');
        }
        if (!$this->validate($rules)) {
            //print_r($this->validate($rules));
            print_r($this->validator->listErrors());
            exit;
            //$this->session->setFlashdata('FlashMessage', ['message' => 'Please Check All Field Before submit', 'status' => 'warning']);
            //return redirect()->to('/packages-list');
        } else {
            $this->PackageModel->insertPackage($DataArr);
        }
        $this->session->setFlashdata('FlashMessage', ['message' => 'Package Added Sucessfully.', 'status' => 'success']);
        return redirect()->to('/packages-list');
    }
    public function update_package_process()
    {
        $ID = $this->request->getPost('id');
        $DataArr = [
            'NAME' => $this->request->getPost('name'),
            'SLUG' => $this->request->getPost('slug'),
            'CATEGORY' => $this->request->getPost('category'),
            'TAGS' => strtolower($this->request->getPost('tags')),
            'IS_INTERNATIONAL' => $this->request->getPost('is_international'),
            'DESTINATION' => $this->request->getPost('destination'),
            'STATE' => $this->request->getPost('state'),
            'COUNTRY' => $this->request->getPost('country'),
            'DESCRIPTION' => $this->request->getPost('description'),
            'PRICE' => $this->request->getPost('price'),
            'STAY' => $this->request->getPost('stay'),
            'BADGE' => $this->request->getPost('badge'),
            'BOOKING_AMOUNT' => $this->request->getPost('booking_amount'),
            'CONTACT' => $this->request->getPost('contact_number'),
            'CUSTOM_DATES' => $this->request->getPost('custom_dates'),
            'CUSTOM_PRICE' => $this->request->getPost('custom_price'),
            'HIGHLIGHTS' => $this->request->getPost('highlights'),
            'INCLUSION' => $this->request->getPost('inclusion'),
            'EXCLUSION' => $this->request->getPost('exclusion'),
            'ITINERARY' => $this->request->getPost('itinerary'),
            'DATES' => $this->request->getPost('dates'),
            'DURATION' => $this->request->getPost('duration'),
            'IMAGES' => $this->request->getPost('images'),
            'VIDEOS' => $this->request->getPost('videos'),
            'MISC' => $this->request->getPost('misc'),
        ];


        $isValid = $this->validateData($DataArr, [
            'name' => 'required',
            'slug' => 'required',
            'destination' => 'required',
            'state' => 'required',
            'country' => 'required',
            'description' => 'required|max_length[255]',
            'is_international' => 'required',
            'category' => 'required',
            'booking_amount' => 'required',
            'price' => 'required',
            'stay' => 'required',
            'duration' => 'required',
            'itinerary' => 'required',
        ]);
        if (!$isValid) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Check All Fields Before Submit', 'status' => 'Warning']);
        }
        $Featured_Image = $this->request->getFile('featured_image');
        $inputFile = $this->validate([
            'featured_image' => [
                'uploaded[featured_image]',
                'mime_in[featured_image,image/png,image/jpg,image/jpeg,image/webp]',
            ]
        ]);
        if (!$inputFile) {
        }
        if ($Featured_Image->getSize() > 0) {
            $newName = $Featured_Image->getRandomName();
            $Featured_Image->move('upload/package_images/', $newName);
            $DataArr['FEATURED_IMAGE'] = $newName;
            $oldimagePath = 'upload/package_images/'.$this->request->getPost('featured_image_old');
            if (!is_dir($oldimagePath) && file_exists($oldimagePath)) {
                unlink($oldimagePath);
            }
        } else {
            $DataArr['FEATURED_IMAGE'] = $this->request->getPost('featured_image_old');
        }
        $pdf = $this->request->getFile('pdf');
        $inputPDF = $this->validate([
            'pdf' => [
                'uploaded[pdf]',
                'mime_in[application/pdf]',
            ]
        ]);
        if (!$inputPDF) {
        }
        if ($pdf->getSize() > 0) {
            $newPDFName = $this->request->getPost('slug').'-'.$pdf->getRandomName();
            $pdf->move('upload/package_pdf/', $newPDFName);
            $DataArr['PDF'] = $newPDFName;
            $oldpdfPath = 'upload/package_pdf/'.$this->request->getPost('pdf_old');
            if (!is_dir($oldpdfPath) && file_exists($oldpdfPath)) {
                unlink($oldpdfPath);
            }
        } else {
            $DataArr['PDF'] = $this->request->getPost('pdf_old');
        }

        $this->PackageModel->UpdatePackage($ID, $DataArr);
        $this->session->setFlashdata('FlashMessage', ['message' => 'Package ID:' . $ID . ' Update', 'status' => 'info']);
        return redirect()->to('/packages-list');
    }
    public function delete_package_process()
    {
        $id = $this->request->getPost('id');
        $imagePath = 'upload/package_images/'.$this->request->getPost('image');
        $pdfPath = 'upload/package_pdf/'.$this->request->getPost('pdf');
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        if (!is_dir($pdfPath) && file_exists($pdfPath)) {
            unlink($pdfPath);
        }
        if (!$this->PackageModel->deletePackageByID($id)) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Error Occured', 'status' => 'Danger']);
            return redirect()->to('/packages-list');
        }
        $this->session->setFlashdata('FlashMessage', ['message' => 'Package ID:' . $id . ' Deleted', 'status' => 'Danger']);
        return redirect()->to('/packages-list');
    }
    public function import_package_process(){
        helper(['dateFormat','itinerary']);
       $Imported_json = $this->request->getFile('imported_json');
        
        $inputJSON = $this->validate([
            'imported_json' => [
                'uploaded[imported_json]',
                'mime_in[imported_json,application/json]',
            ]
        ]);

        if (!$inputJSON) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'File is Invalid.', 'status' => 'Danger']);
            return redirect()->to('/packages-list');
        };
       
        $json = file_get_contents($Imported_json);

        $obj  = json_decode($json);
        
        if($obj[0]->PACKAGE_PDF != ""){
            $PDF = 'https://voyagersbeat.com/pdf/'.$obj[0]->PACKAGE_PDF;
        }
        else{
            $PDF = "";
        }
        
        $slug = strtolower(str_replace(" ","-",$obj[0]->PACKAGE_NAME));
        if ($this->PackageModel->isSlugExist($slug)) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Package Already Exist.', 'status' => 'Danger']);
            return redirect()->to('/packages-list');
        }

        $nights = substr($obj[0]->PACKAGE_DAYS,0,1);
        
        
        
        $stay = $nights."N/".($nights+1)."D";

        

        $OBJIMGARR = [
            $obj[0]->IMAGE_1,
            $obj[0]->IMAGE_2,
            $obj[0]->IMAGE_3,
            $obj[0]->IMAGE_4
        ];

        $ImagesArr=[];

        foreach($OBJIMGARR as $Image){
            if($Image!=''){
                array_push($ImagesArr,$Image);
            }
        }
        
        $OBJPrice = [
            ["sharing" => $obj[0]->INFO_P1, "price" => $obj[0]->PRICE_1],
            ["sharing" => $obj[0]->INFO_P2, "price" => $obj[0]->PRICE_2],
            ["sharing" => $obj[0]->INFO_P3, "price" => $obj[0]->PRICE_3],
            ["sharing" => $obj[0]->INFO_P4, "price" => $obj[0]->PRICE_4],
            ["sharing" => $obj[0]->INFO_P5, "price" => $obj[0]->PRICE_5],
        ];

        $Price=[];

        foreach($OBJPrice as $row){
            if(($row['price'] != "") &&($row['price'] != "0")){
                array_push($Price,$row);
            }
        }

        $vb_datesArr = explode(',',$obj[0]->DATES);
        $Dates = [];
        foreach($vb_datesArr as $date){
            array_push($Dates,["date" => formatDateRange($date)]);
        }
        $raw = $obj[0]->PACK_IT;
        $itinerary = mergeTitleandDesc($raw);
        

        
        
        $DataArr = [
            'NAME' => $obj[0]->PACKAGE_NAME,
            'SLUG' => $slug,
            'CATEGORY' => '',
            'TAGS' =>  strtolower($obj[0]->TAGS),
            'IS_INTERNATIONAL' => 0,
            'DESTINATION' => $obj[0]->LOCATION,
            'STATE' => $obj[0]->STATE,
            'COUNTRY' => '',
            'DESCRIPTION' => $obj[0]->META_DESC,
            'PRICE' => json_encode($Price),
            'STAY' => $stay,
            'BADGE' => '',
            'BOOKING_AMOUNT' => 3000,
            'CONTACT' => '',
            'CUSTOM_DATES' => NULL,
            'CUSTOM_PRICE' => NULL,
            'FEATURED_IMAGE' => $obj[0]->PACKAGE_IMAGE,
            'PDF' =>  $PDF,
            'HIGHLIGHTS' => $obj[0]->TRIP_HIGHLIGHT,
            'INCLUSION' => $obj[0]->INCLUSION,
            'EXCLUSION' => $obj[0]->EXCLUSION,
            'ITINERARY' => $itinerary,
            'DATES' => json_encode($Dates),
            'DURATION' => $obj[0]->DURATION,
            'IMAGES' => json_encode($ImagesArr),
            'VIDEOS' => '',
            'MISC' => $obj[0]->PACKAGE_MISC,
        ];
        
       
        $this->PackageModel->insertPackage($DataArr);
        $ID = $this->PackageModel->getIDfromSlug($DataArr['SLUG'])[0]->ID;
        
        $this->session->setFlashdata('FlashMessage', ['message' => 'Package Imported Sucessfully.', 'status' => 'success']);
        return redirect()->to("/update-package/$ID");
        
    }
}

