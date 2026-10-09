<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Point;



class BookingController extends BaseController
{
    public array $data;
    public Booking $BookingModel;
    public Package $PackageModel;
    public Coupon $CouponModel;
    public User $UserModel;
    public Point $PointModel;

    public function __construct()
    {
        $this->UserModel = new User();
        $this->BookingModel = new Booking();
        $this->CouponModel = new Coupon();
        $this->PackageModel = new Package();
        $this->PointModel = new Point();
    }

    public function Book(int $packageID)
    {
        if (!auth('User') && !auth('Admin') && !auth('Employee')) {
            return $this->RedirectWithtoast('Please Login to Book', 'info', '/login');
        }
        $this->data['UsablePoints'] = $this->PointModel->getUserOneTimePointsBalance((int)session()->get('id')) ?? 0;
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
        $allowedFields = ['date', 'note', 'status', 'amount', 'total_package_cost', 'customer_access', 'adults']; // extend as needed

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
                $validStatuses = ['Pending', 'Complete', 'Complete_no_points', 'Cancel', 'Postponed', 'Failed / Unknown'];
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
            'trip_type' => 'required|in_list[community,personalised]',
            'date' => 'required',
            'travelmode' => 'required',
            'address' => 'required',
            'pax_details' => 'required',
            'heard' => 'required',
            'adhaarCard_file' => [
                'uploaded[adhaarCard_file]',
                'is_image[adhaarCard_file]',
                'mime_in[adhaarCard_file,image/jpg,image/jpeg,image/png,image/webp]',
                'max_size[adhaarCard_file,4096]', // 4MB limit
            ],
            'payment_screenshot_file' => 'uploaded[payment_screenshot_file]|is_image[payment_screenshot_file]',
        ];
        if (! $this->validate($rules)) {
            $this->session->setFlashdata('FlashMessage', [
                'message' => 'Invalid Data Inserted',
                'status'  => 'Danger'
            ]);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user_id = $this->createUserAccountifNotExist($this->request->getPost('email'), $this->request->getPost('name'), $this->request->getPost('contact_trip'));

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
            'user_id' => $user_id,
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'contact_trip' => $this->request->getPost('contact_trip'),
            'contact_alt' => $this->request->getPost('contact_alt'),
            'gender' => $this->request->getPost('gender'),
            'trip_type' => $this->request->getPost('trip_type'),
            'date' => $this->request->getPost('date'),
            'travelmode' => $this->request->getPost('travelmode'),
            'pax_details' => $this->request->getPost('pax_details'),
            'address' => $this->request->getPost('address'),
            'heard' => $this->request->getPost('heard'),
            'status' => 'Pending',
            'customer_access' => 0
        ];

        //uploading Adhaar of Travelers
        $customerFilledData['pax_details'] = $this->AdhaarImagesUpload($customerFilledData['pax_details']);

        $customerFilledData['pay_screenshot'] = $paymentScreenShotFileName;

        if (!((int)$this->request->getPost('prefill') == 1)) {
            $customerFilledData['paymode'] = 'UPI Advance Payment';
        }

        //--------Loyalty Points-------------------
        $this->UsingLoyalityPoints((int)$user_id, $orderId);



        $this->BookingModel->updateConfirmedBooking($orderId, $customerFilledData);

        if (!$this->sendEmail($orderId)) {
            return $this->RedirectWithtoast('Booking Confirmed but Some Error Occured During Sending Mail', 'Success', '/thanks?order_id=' . $orderId);
        };

        return $this->RedirectWithtoast('Booking Confirmed', 'Success', '/thanks?order_id=' . $orderId);
    }


    public function createUserAccountifNotExist(string $email, string $name, string $contact)
    {
        $user = $this->UserModel->getUser($email);
        if (!$user) {
            $generatedPassword = $this->generateRandomPassword();
            $AccountData = [
                'USER_NAME' => $name,
                'USER_EMAIL' => $email,
                'USER_CONTACT' => $contact,
                'PASSWORD' => password_hash($generatedPassword, PASSWORD_DEFAULT),
                'ROLE' => 0, // Assuming 0 is the role for customers
                'STATUS' => 1, // Assuming 1 is the status for active customers
            ];
            return $this->UserModel->insertUser($AccountData);
        }
        return $user->USER_ID; // Return existing user ID if user already exists
    }

    public function generateRandomPassword($length = 8)
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, $length);
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

    public function PaymentScreenshotUpload() {}
    public function AdhaarImagesUpload(string $paxDetails)
    {
        $pax_details = json_decode($paxDetails, true);

        $adhaarImages = $this->request->getFileMultiple('adhaarCard_file');
        $uploadedFiles = [];

        if ($adhaarImages) {
            foreach ($adhaarImages as $index => $file) {

                // Check if file is valid and hasn't been moved
                if ($file->isValid() && !$file->hasMoved()) {

                    // Generate a random unique name
                    $fileNamePrefix = $pax_details[$index]['adhaarCard_file'];
                    $newName = $fileNamePrefix . '.' . $file->getExtension();
                    $pax_details[$index]['adhaarCard_file'] = $newName;

                    // Move file to writable/uploads/adhaar folder
                    $file->move('upload/adhaar/', $newName);

                    $uploadedFiles[] = $newName;
                }
            }
        }
        if (!empty($uploadedFiles)) {
            return json_encode($pax_details);
        }
    }

    public function AddingLoyalityPoints(int $user_id, string $order_id)
    {
        $bookingData = $this->BookingModel->getBookingByOrderId($order_id);
        $PointsEarned = ($bookingData->total_package_cost * POINTS_EARNING_RATE);
        $this->PointModel->UpdatePointsEarned($user_id, (int)$PointsEarned);
        return $PointsEarned;
    }
    public function UsingLoyalityPoints(int $user_id, string $order_id)
    {
        $bookingData = $this->BookingModel->getBookingByOrderId($order_id);
        $PointsUsed = ($bookingData->points_used);
        $this->PointModel->UpdatePointsUsed($user_id, (int)$PointsUsed);
        return $PointsUsed;
    }
}
