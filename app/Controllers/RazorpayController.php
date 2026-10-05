<?php


namespace App\Controllers;

require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Coupon;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayController extends BaseController
{
    protected Package $PackageModel;
    protected Booking $BookingModel;
    protected Coupon $CouponModel;
    protected array $BookingData;
    public function __construct()
    {
        $this->PackageModel =  new Package();
        $this->CouponModel =  new Coupon();
        $this->BookingModel =  new Booking();
        $this->session = Services::session();
    }

    protected function CouponCost(string $code, string $amount)
    {
        if (!$this->CouponModel->isCodeExist($code)) {
            return 0;
        }

        $couponData = $this->CouponModel->getCoupon($code);

        switch ($couponData->Coupon_Type) {
            case 0:
                return $couponData->Coupon_Worth;
            case 1:
                $percentile = ($couponData->Coupon_Worth) / 100;
                return $amount - ($amount * $percentile);
            default:
                return 0;
        }
    }



    public function booking_pay()
    {

        $api = new Api(env('razorKey'), env('razorSecret'));

        /// Validation Defination
        $validationRules = [
            'name' => [
                'rules'  => 'required|min_length[2]|max_length[100]|string',
                'errors' => [
                    'required'   => 'Name is required.',
                    'min_length' => 'Name must be at least 2 characters.',
                ],
            ],
            'gender' => [
                'rules'  => 'required|in_list[Male,Female,Other,M,F,O]',
                'errors' => [
                    'in_list' => 'Please select a valid gender option.',
                ],
            ],
            'mobile' => [
                'rules'  => 'required|numeric|exact_length[10]',
                'errors' => [
                    'required'     => 'Mobile number is required.',
                    'exact_length' => 'Mobile number must be exactly 10 digits.',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email address is required.',
                    'valid_email' => 'Please provide a valid email address.',
                ],
            ],
            'sharing' => [
                'rules'  => 'permit_empty',
                'required'    => 'Sharing is required.',
            ],
            'sharing.*' => [
                'rules'  => 'permit_empty|string',
                'required'    => 'Sharing is required.',
            ],

            'pax_details' => [
                'rules'  => 'permit_empty',
            ],
            'adults' => [
                'rules'  => 'required|integer|greater_than_equal_to[1]',
                'errors' => [
                    'required'              => 'Number of adults is required.',
                    'greater_than_equal_to' => 'At least 1 adult is required.',
                ],
            ],
            'id' => [
                'rules'  => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'Package ID is missing.',
                ],
            ],
            'package_name' => [
                'rules'  => 'required|string',
            ],
            'bookingamount' => [
                'rules'  => 'required|numeric|greater_than_equal_to[0]',
            ],
            'amounttopay' => [
                'rules'  => 'required|numeric|greater_than_equal_to[0]',
            ],
            'date' => [
                'rules'  => 'required|string',
                'errors' => [
                    'required' => 'Please select a travel date.',
                ],
            ],
            'travelmode' => [
                'rules'  => 'required|string',
            ],
            'paymode' => [
                'rules'  => 'required|string|in_list[full,booking]',
            ],
            'coupon_code' => [
                'rules'  => 'permit_empty|alpha_numeric|max_length[50]',
            ],
        ];

        if (! $this->validate($validationRules)) {

            // Get all errors as an array [field => message]
            $errors = $this->validator->getErrors();

            // Extract the very first error message as a string
            $firstError = !empty($errors) ? array_values($errors)[0] : '';

            print_r($errors);

            //return $this->RedirectWithtoast("errors : $firstError", 'Danger', '/book/' . $this->request->getPost('id'));
            //return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $PackagePriceDetails = $this->PackageModel->getPackageByID($this->request->getPost('id'));

        $GST = 0.05;

        $priceArr = [
            $PackagePriceDetails->PRICE_5,
            $PackagePriceDetails->PRICE_4,
            $PackagePriceDetails->PRICE_3,
            $PackagePriceDetails->PRICE_2,
            $PackagePriceDetails->PRICE_1
        ];
        $WTpriceArr = [
            $PackagePriceDetails->WT_PRICE_5,
            $PackagePriceDetails->WT_PRICE_4,
            $PackagePriceDetails->WT_PRICE_3,
            $PackagePriceDetails->WT_PRICE_2,
            $PackagePriceDetails->WT_PRICE_1
        ];
        $WT2priceArr = [
            $PackagePriceDetails->WT2_PRICE_5,
            $PackagePriceDetails->WT2_PRICE_4,
            $PackagePriceDetails->WT2_PRICE_3,
            $PackagePriceDetails->WT2_PRICE_2,
            $PackagePriceDetails->WT2_PRICE_1
        ];

        /////////////////////////////////////////////////////////////
        //                                                         //
        // You can calculate payment amount as per your logic      //
        // Always set the amount from backend for security reasons //
        // data used for backend price verification                //
        //                                                         //
        /////////////////////////////////////////////////////////////



        // Get All the Data from the post request

        //required Data After Confirmed Payment
        $BookingData['trip_type'] = 'N/A';
        $BookingData['boarding_city'] = 'N/A';
        $BookingData['address'] = 'N/A';
        $BookingData['contact_trip'] = '0';
        $BookingData['contact_alt'] = '0';
        $BookingData['heard'] = 'N/A';
        $BookingData['pay_screenshot'] = 'N/A';
        $BookingData['adhaar_number'] = '0';


        //Customer Details
        $BookingData['name'] = $this->request->getPost('name');
        $BookingData['gender'] = $this->request->getPost('gender');
        $BookingData['contact'] = $this->request->getPost('mobile');
        $BookingData['email'] = $this->request->getPost('email');
        $BookingData['sharingArr'] = $this->request->getPost('sharing');

        //TravelBuddies Details
        $BookingData['pax_details'] = $this->request->getPost('pax_details');
        $BookingData['adults'] = $this->request->getPost('adults');

        //Package Related Details
        $BookingData['package_id'] = $this->request->getPost('id');
        $BookingData['package_name'] = $this->request->getPost('package_name');
        $BookingData['booking_amount'] = $this->request->getPost('bookingamount');
        $BookingData['total_amount'] = $this->request->getPost('amounttopay');
        $BookingData['coupon_code'] = $this->request->getPost('coupon_code');
        $BookingData['paymode'] = $this->request->getPost('paymode');

        $BookingData['date'] = explode('#', $this->request->getPost('date'))[0] ?? $this->request->getPost('date');
        $BookingData['dateSurcharge'] = explode('#', $this->request->getPost('date'))[1] ?? 0;
        $BookingData['travelmode'] = $this->request->getPost('travelmode');
        $travelmodeInt = substr($this->request->getPost('travelmode'), 0, 1);



        // Will Calculate again With Given Data by Customer
        $BookingData['AmountPayable'] = 0;
        $BookingData['GrandTotal'] = 0;
        // Calculating Amount Using Sharing for Each Person
        $BookingData['each_person_sharing'] = [];
        $BookingData['personCostSum'] = 0;
        foreach ($BookingData['sharingArr'] as $customerSharing) {
            array_push($BookingData['each_person_sharing'], substr($customerSharing, 0, 1));
        }



        // Price Calculation According to Travel Mode
        // Calculated Amount Using Each Adult with its sharing ex: trav1 - quad,trav2 = double => 1* quad(price) + 1 * double(price)

        switch ($travelmodeInt) {
            case 1:
                foreach ($BookingData['each_person_sharing'] as $eachSharing) {
                    if ($WT2priceArr[$eachSharing] > 0) {
                        $BookingData['personCostSum'] += $WT2priceArr[$eachSharing];
                    } else {
                        return redirect()->to("packageid/" . $BookingData['package_id'] . '?paymentError=tm1');
                    }
                }
                break;
            case 2:
                foreach ($BookingData['each_person_sharing'] as $eachSharing) {
                    if ($WTpriceArr[$eachSharing] > 0) {
                        $BookingData['personCostSum'] += $WTpriceArr[$eachSharing];
                    } else {
                        return redirect()->to("packageid/" . $BookingData['package_id'] . '?paymentError=tm2');
                    }
                }
                break;
            case 3:
                foreach ($BookingData['each_person_sharing'] as $eachSharing) {
                    if ($priceArr[$eachSharing] > 0) {
                        $BookingData['personCostSum'] += $priceArr[$eachSharing];
                    } else {
                        return redirect()->to("packageid/" . $BookingData['package_id'] . '?paymentError=tm2');
                    }
                }
                break;
            default:
                return redirect()->to("packageid/" . $BookingData['package_id'] . '?paymentError=tminvalid');
        }

        // add all cost each ( sharing (ACCORDING TO PICKUP) + surcharge + gst )
        $TOTAL_SURCHARGE = ($BookingData['dateSurcharge'] * $BookingData['adults']);

        $TOTAL_COST = round(($BookingData['personCostSum'] + $TOTAL_SURCHARGE) + ($GST * ($BookingData['personCostSum'] + $TOTAL_SURCHARGE)));

        $TOTAL_COST_BOOKING = $BookingData['adults'] * $BookingData['booking_amount'];

        // Subtract all offers from total cost ( spacial offer + coupon + loyalty points)

        $TOTAL_COST = $TOTAL_COST - $this->CouponCost($BookingData['coupon_code'], $TOTAL_COST); // Append Loyalty Point Subtraction Here




        switch ($BookingData['paymode']) {
            case 'full':
                $BookingData['AmountPayable'] = $TOTAL_COST;
                $BookingData['GrandTotal'] = $TOTAL_COST;
                break;
            case 'booking':
                $BookingData['AmountPayable'] = $TOTAL_COST_BOOKING;
                $BookingData['GrandTotal'] = $TOTAL_COST;
                break;
            default:
                return $this->RedirectWithtoast('PaymentError : Paymode_is_invalid', 'Danger', "packageid/" . $BookingData['package_id'] . '?paymentError=Paymode_is_invalid');
        }

        //Checks For Exceptions

        if ($BookingData['AmountPayable'] >= 500000) {
            return redirect()->to("book/" . $BookingData['package_id'] . "?paymentError=1");
        }

        // Generating Order ID

        $BookingData['BookingID'] = $BookingData['package_id'] . '-' . $BookingData['contact'] . '-' . $BookingData['GrandTotal'];

        $razorpayOrder = $api->order->create(array(
            'receipt'         => $BookingData['BookingID'],
            'amount'          => $BookingData['AmountPayable'] * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ));

        $amount = $razorpayOrder['amount'];
        $razorpayOrderId = $razorpayOrder['id'];

        $this->session->set(['razorpay_order_id' => $razorpayOrderId]);
        $this->session->set(['payable_amount' => $BookingData['AmountPayable']]);

        $data = $this->prepareData($amount, $razorpayOrderId, $BookingData);
        $BookingData = $this->saveBookingData($razorpayOrderId, $BookingData);

        return view('razorpay', ['data' => $data]);
    }


    public function prepareData(int $amount, string $razorpayOrderId, array $data)
    {
        $data = array(
            "key" => env('razorKey'),
            "amount" => $amount,
            "name" => env('appName'),
            "description" => env('appName'),
            "image" => env('applogoPath'),
            "prefill" => array(
                "name"  => $data['name'],
                "email"  => $data['email'],
                "contact" => $data['contact']
            ),
            "notes"  => array(
                "address"  => "",
                "merchant_order_id" => rand(),
            ),
            "theme"  => array(
                "color"  => env('appThemeHex')
            ),
            "order_id" => $razorpayOrderId,
        );
        return $data;
    }

    public function verify()
    {
        $orderId = session()->get('razorpay_order_id');

        if (empty($orderId)) {
            return redirect()->to('/')->with('error', 'Session expired. Please try again.');
        }

        $paymentId = $this->request->getPost('razorpay_payment_id');
        $signature = $this->request->getPost('razorpay_signature');
        $status    = $this->request->getPost('payment_status'); // 'cancelled' when modal dismissed

        // 1. User closed the Razorpay modal
        if ($status === 'cancelled') {
            $this->BookingModel->updateStatus($orderId, 'Cancelled');
            return redirect()->to('/payment-failed')->with('error', 'Payment was cancelled. You can try again.');
        }

        // 2. No payment data = failure (never assume success)
        if (empty($paymentId) || empty($signature)) {
            $this->BookingModel->updateStatus($orderId, 'Failed');
            return redirect()->to('/payment-failed');
        }

        // 3. Verify the signature
        try {
            $api = new Api(env('razorKey'), env('razorSecret'));
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature'  => $signature,
            ]);
        } catch (SignatureVerificationError $e) {
            log_message('error', 'Razorpay signature failed: ' . $e->getMessage());
            $this->BookingModel->updateStatus($orderId, 'Failed');
            return redirect()->to('/payment-failed');
        }

        // 4. Only reached when the signature is valid
        $this->BookingModel->updateStatus($orderId, 'Complete');

        return $this->sendBookingConfirmationForm($orderId, true);
    }

    public function saveBookingData(string $order_id, array $BookingData)
    {
        $data['user_id'] = (int)session()->get('id');
        $data['order_id'] = $order_id;
        $data['name'] = (string)$BookingData['name'];
        $data['email'] = (string)$BookingData['email'];
        $data['gender'] = (string)$BookingData['gender'];
        $data['package_id'] = (int)$BookingData['package_id'];
        $data['package_name'] = (string)$BookingData['package_name'];
        $data['adults'] = (int)$BookingData['adults'];
        $data['pax_details'] = (string)$BookingData['pax_details'];
        $data['sharing'] = $BookingData['sharingArr'][0];
        $data['coupon_used'] = (string)$BookingData['coupon_code'];
        $data['date'] = (string)$BookingData['date'];
        $data['trip_type'] = (string)$BookingData['trip_type'];
        $data['boarding_city'] = (string)$BookingData['boarding_city'];
        $data['address'] = (string)$BookingData['address'];
        $data['travelmode'] = (string)$BookingData['travelmode'];
        $data['paymode'] = (string)$BookingData['paymode'];
        $data['contact'] = (string)$BookingData['contact'];
        $data['contact_trip'] = (int)$BookingData['contact_trip'];
        $data['contact_alt'] = (int)$BookingData['contact_alt'];
        $data['heard'] = (string)$BookingData['heard'];
        $data['amount'] = (int)$BookingData['AmountPayable'];
        $data['status'] = 'Pending';
        $data['pay_screenshot'] = (string)$BookingData['pay_screenshot'];
        $data['total_package_cost'] = (int)$BookingData['GrandTotal'];


        $insertResult = $this->BookingModel->insertBooking($data); // Calling Modal Function for Insertion

        if ($insertResult === false) {
            log_message('error', 'Booking insert failed: ' . json_encode($this->BookingModel->errors()));
            return $this->BookingModel->errors();
        }

        return $this->BookingModel->errors();
    }
    public function PaymentSuccess()
    {
        $order_ID = $this->request->getGet('order_id');
        if (empty($order_ID)) {
            return $this->Render_Page('static/booking-thanks-unpaid', $this->data);
        }
        if (!$this->BookingModel->isBookingExistByOrderId($order_ID)) {
            return $this->Render_Page('static/booking-thanks-unpaid', $this->data);
        }
        $this->data['bookingData'] = $this->BookingModel->getBookingByOrderId($order_ID);
        return $this->Render_Page('static/booking-thanks', $this->data);
    }

    public function Paymentfailed()
    {
        return $this->Render_Page('static/payment-failed', $this->data);
    }
    public function MaximumAmount()
    {
        return $this->Render_Page('static/max-amount', $this->data);
    }

    public function sendBookingConfirmationForm(string $order_id, bool $prefill = true)
    {
        return redirect()->to('/booking-confirmation-form/' . $order_id . '?prefill=' . $prefill);
    }
}
