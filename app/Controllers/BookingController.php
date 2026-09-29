<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Coupon;
use App\Controllers\EmailController;


class BookingController extends BaseController
{
    public array $data;
    public Booking $BookingModel;
    public Package $PackageModel;
    public Coupon $CouponModel;
    private EmailController $EmailController;
    public function __construct()
    {

        $this->BookingModel = new Booking();
        $this->CouponModel = new Coupon();
        $this->PackageModel = new Package();
        $this->EmailController = new EmailController();
    }

    public function Book(int $packageID)
    {
        $this->data['ValidCoupons'] = $this->CouponModel->getAllValidCoupons();
        $this->data['package'] = $this->PackageModel->getPackageByID($packageID);
        return $this->Render_Page('booking/booking-form', $this->data);
    }


    public function updateField($bookingId = null)
    {
        if (! $this->request->is('patch')) {
            return $this->response->setStatusCode(405)->setJSON(['error' => 'Method not allowed']);
        }

        $bookingId = (int) $bookingId;

        $booking = $this->BookingModel->find($bookingId);
        if ($booking === null) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Booking not found']);
        }

        // Authorization — confirm the logged-in user can edit this booking
        // if ($booking->user_id !== session('id')) {
        //     return $this->response->setStatusCode(403)->setJSON(['error' => 'Forbidden']);
        // }

        $input = $this->request->getJSON(true);
        $field = $input['field'] ?? null;
        $value = $input['value'] ?? null;

        if ($field === null || $value === null) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'field and value are required']);
        }

        // Whitelist — only fields explicitly listed here can be patched via this endpoint
        $allowedFields = ['note', 'status', 'total_package_cost']; // extend as needed

        if (! in_array($field, $allowedFields, true)) {
            return $this->response->setStatusCode(422)->setJSON(['error' => 'Field not editable']);
        }

        $value = $this->sanitizeFieldValue($field, $value);

        $updated = $this->BookingModel->update($bookingId, [$field => $value]);

        if (! $updated) {
            return $this->response->setStatusCode(500)->setJSON(['error' => 'Failed to update field']);
        }

        return $this->response->setJSON([
            'success' => true,
            'field'   => $field,
            'value'   => $value,
        ]);
    }

    protected function sanitizeFieldValue(string $field, string $value)
    {
        switch ($field) {
            case 'note':
                return trim(strip_tags($value));
            case 'status':
                // e.g. validate against an enum of allowed statuses
                $validStatuses = ['Pending', 'Complete', 'Cancel', 'Failed / Unknown'];
                return in_array($value, $validStatuses, true) ? $value : null;
            default:
                return $value;
        }
    }

    public function createBookingProcess()
    {
        // 1. Validate input FIRST
        $rules = [
            'package_id'    => 'required|integer',
            'amount' => 'required|integer',
            'adults' => 'required|integer',
            'contact' => 'required|numeric|min_length[10]|max_length[10]',
            'agent' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            $this->session->setFlashdata('FlashMessage', [
                'message' => 'Invalid Data Inserted',
                'status'  => 'Danger'
            ]);
            return redirect()->back()->withInput();
        }
        // Skipping All Fields Validation 
        $this->BookingModel->skipValidation(true);

        $generated_order_id = md5(base64_encode($this->request->getPost('contact') . date('Y-m-d H:i:s')));
        $packageData = $this->PackageModel->getPackageByID($this->request->getPost('package_id'));

        $AgentFilledData = [
            'package_id' => $this->request->getPost('package_id'),
            'package_name' => $packageData->PACKAGE_NAME,
            'amount' => $this->request->getPost('amount'),
            'total_package_cost' => $this->request->getPost('total_package_cost'),
            'adults' => $this->request->getPost('adults'),
            'contact' => $this->request->getPost('contact'),
            'agent' => $this->request->getPost('agent'),
            'order_id' => $generated_order_id,
        ];

        $this->BookingModel->insertBooking($AgentFilledData);
        $this->session->setFlashdata('FlashMessage', [
            'message' => 'Booking Created ',
            'status'  => 'Success'
        ]);
        $redirectTo = match (session()->get('role')) {
            1 => '/dashboard/all-bookings',
            2      => '/employee-dashboard/booking-list',
            default  => '/employee-dashboard/booking-list',
        };
        return redirect()->to($redirectTo);
    }

    public function BookingConfirmationForm(string $order_id)
    {
        $this->data['order_id'] = $order_id;
        $this->data['BookingData'] = $this->BookingModel->getBookingByOrderId($order_id);
        if (!$this->data['BookingData']) {
            $this->session->setFlashdata('FlashMessage', [
                'message' => 'Invalid Action',
                'status'  => 'Danger'
            ]);
            $redirectTo = match (session()->get('role')) {
                1 => '/dashboard/all-bookings',
                2      => '/employee-dashboard/booking-list',
                default  => '/logout',
            };
            return redirect()->to($redirectTo);
        }

        if (!$this->data['BookingData']->customer_access) {
            return $this->RedirectWithtoast('Link Expired', 'Danger', '/');
        }
        $this->data['prefill'] = (int)esc(strip_tags($this->request->getGet('prefill') ?? 0));
        $this->data['PackageData'] = $this->PackageModel->getPackageByID($this->data['BookingData']->package_id);

        if ($this->data['prefill'] == 1) {
            return $this->Render_Page('booking/booking-prefilled-confirm-form', $this->data);
        }
        return $this->Render_Page('booking/booking-confirmation-form', $this->data);
    }
    public function BookingConfirmationProcess()
    {
        $rules = [
            'name' => 'required',
            'contact_trip' => 'required|numeric|min_length[10]|max_length[10]',
            'contact_alt' => 'required|numeric|min_length[10]|max_length[10]|differs[contact_trip]',
            'gender' => 'required|in_list[Male,Female,Other]',
            'trip_type' => 'required|in_list[community,personlised]',
            'date' => 'required',
            'travelmode' => 'required',
            'address' => 'required',
            'pax_details' => 'required',
            'boarding_city' => 'required',
            'sharing' => 'required',
            'adhaar_number' => 'required',
            'heard' => 'required',
            'payment_screenshot_file' => 'uploaded[payment_screenshot_file]|is_image[payment_screenshot_file]'

        ];
        if (! $this->validate($rules)) {
            $this->session->setFlashdata('FlashMessage', [
                'message' => 'Invalid Data Inserted',
                'status'  => 'Danger'
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $paymentScreenShot = $this->request->getFile('payment_screenshot_file');
        if ($paymentScreenShot->getSize() > 0) {

            $paymentScreenShotFileName = $this->request->getPost('order_id') . '-' . str_replace(' ', '-', $this->request->getPost('name')) . '.' . $paymentScreenShot->getExtension();
            $paymentScreenShot->move('upload/bookings/payment_screenshot', $paymentScreenShotFileName);
        } else {
            return redirect()->back()->withInput()->with('errors', 'Payment Screenshot is Invalid');
        }
        $this->BookingModel->skipValidation(true);


        $orderId = $this->request->getPost('order_id');


        $customerFilledData = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'contact_trip' => $this->request->getPost('contact_trip'),
            'contact_alt' => $this->request->getPost('contact_alt'),
            'gender' => $this->request->getPost('gender'),
            'trip_type' => $this->request->getPost('trip_type'),
            'date' => $this->request->getPost('date'),
            'travelmode' => $this->request->getPost('travelmode'),
            'pax_details' => $this->request->getPost('pax_details'),
            'address' => $this->request->getPost('boarding_city'),
            'boarding_city' => $this->request->getPost('boarding_city'),
            'sharing' => $this->request->getPost('sharing'),
            'adhaar_number' => $this->request->getPost('adhaar_number'),
            'heard' => $this->request->getPost('heard'),
            'customer_access' => 0
        ];

        $customerFilledData['pay_screenshot'] = $paymentScreenShotFileName;

        if (!((int)$this->request->getPost('prefill') == 1)) {
            $customerFilledData['paymode'] = 'UPI Advance Payment';
        }

        $this->BookingModel->updateConfirmedBooking($orderId, $customerFilledData);

        if (!$this->sendEmail($orderId)) {
            return $this->RedirectWithtoast('Booking Confirmed but Some Error Occured During Sending Mail', 'Success', '/thanks?order_id=' . $orderId);
        };

        return $this->RedirectWithtoast('Booking Confirmed', 'Success', '/thanks?order_id=' . $orderId);
    }


    public function MaximumAmount()
    {
        return $this->Render_Page('static/max-amount', $this->data);
    }


    public function sendEmail(string $order_id)
    {
        $client = service('curlrequest');

        $response = $client->get(base_url('booking-mail-process/' . $order_id), [
            'http_errors' => false,   // don't throw on 4xx/5xx
            'timeout'     => 30,
        ]);

        return $response->getBody();
    }
}
