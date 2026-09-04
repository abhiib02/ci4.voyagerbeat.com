<?php
$DatesArr = json_decode($package->DATES);
// $has_dates = ($package->CUSTOM_DATES == NULL) && ($package->DATES != '') && ($package->DATES != '[]');
// if($has_dates){
//     $cal_date="02";
//     $cal_month="Mar";
// // $cal_date = explode('/',upcomingDates($DatesArr))[0];
// // $cal_month = explode('/',upcomingDates($DatesArr))[1];
// }
// $leastPrice = ($package->CUSTOM_PRICE != '') ? 'Price on Request' : 'from ₹'.json_decode($package->PRICE)[0]->price;
// $totalDates = count($DatesArr);

?>

<?php
    if(str_contains($package->PACKAGE_IMAGE,'http') && !str_contains($package->PACKAGE_IMAGE,'drive.google.com')){
        $Package_image = $package->PACKAGE_IMAGE;
    }
    elseif(str_contains($package->PACKAGE_IMAGE,'drive.google.com')){
      $id = explode('/',$package->PACKAGE_IMAGE)[5];
      $Package_image = "https://lh3.googleusercontent.com/d/{$id}=w1920";
    }else{
      $Package_image = '/upload/package_images/'.$package->PACKAGE_IMAGE;
    }
    ?>

<a href="/package/<?=$package->SLUG?>"
                   class="col-lg-3 col-md-4 col-sm-6 package-card text-decoration-none my-2 packageTypeItem package-card-scroll-anim px-5 position-relative"
                   data-packagename="<?=$package->PACKAGE_NAME?>"
                   >
                   <span class="position-absolute badge text-bg-warning fs-6" style="top: 0px;border-radius:0.2rem 0 10px 0; z-index:1;"><?=$package->BADGE?></span>
                   <span class="position-absolute badge text-bg-dark fs-6" style="top: 30px;border-radius: 0rem 10px 10px 0;z-index: 1;translate: 0;"><?=$package->DURATION?></span>
                    <div class="card h-100 border-0 shadow-sm">
                        
                             <img src="<?=$Package_image?>"
                                        class="card-img-top"
                                        alt="<?=$package->PACKAGE_NAME?>"
                                        style="aspect-ratio:1; object-fit: cover;"
                                        loading="lazy">

                        <div class="card-body d-flex gap-2">
                            
                            
                            <div>
                                <p class="fw-bold card-title m-0"> <?=$package->PACKAGE_NAME?></p>
                               
                            </div>
                        </div>
                    </div>
                </a>