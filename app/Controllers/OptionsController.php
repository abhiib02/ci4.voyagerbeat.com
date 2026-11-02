<?php

namespace App\Controllers;

use App\Models;
use App\Models\Option;
use Config\Services;

class OptionsController extends BaseController
{

    protected Option $OptionModel;

    public function __construct()
    {
        $this->OptionModel = new Option();
    }

    public function createOption()
    {
        // 1. Validate input FIRST
        $rules = [
            'name'    => 'required',
            'value' => 'required',
            'datatype' => 'required|in_list[TEXT,JSON,NUMBER]',
        ];
        if (!$this->validate($rules)) {
            $this->session->setFlashdata('FlashMessage', [
                'message' => 'Invalid option name or value or datatype.',
                'status'  => 'warning'
            ]);
            return redirect()->to('/dashboard/option-list')->withInput();
        }

        $name = $this->request->getPost('name');
        $value = $this->request->getPost('value');
        $datatype = $this->request->getPost('datatype');

        $this->OptionModel->insertOption(['name' => $name, 'value' => $value, 'datatype' => $datatype]);

        return $this->RedirectWithToast('Option Created', 'Success', '/dashboard/option-list');
    }
    public function save(string $name)
    {
        $value = $this->request->getPost($name);

        $this->OptionModel->saveOption($name, $value);
        return $this->RedirectWithToast('Option Saved', 'Success', '/dashboard/option-list');
    }
}
