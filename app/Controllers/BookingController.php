<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Coupon;


class BookingController extends BaseController
{
    public array $data;
    public Booking $BookingModel;
    public Package $PackageModel;
    public Coupon $CouponModel;
    public function __construct()
    {

        $this->BookingModel = new Booking();
        $this->CouponModel = new Coupon();
        $this->PackageModel = new Package();
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

    protected function sanitizeFieldValue(string $field, $value)
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
        return redirect()->to('/employee-dashboard/booking-list')->withInput();
    }

    public function BookingConfirmationForm(string $order_id)
    {
        $this->data['order_id'] = $order_id;
        return $this->Render_Page('booking/booking-confirmation-form', $this->data);
        // Make This Form 
    }
    public function BookingConfirmationProcess()
    {
        // This Function Handle BookingConfirmationForm Submission
    }




    public function MaximumAmount()
    {
        return $this->Render_Page('static/max-amount', $this->data);
    }
}
