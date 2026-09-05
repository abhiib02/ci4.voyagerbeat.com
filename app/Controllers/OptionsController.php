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

    public function save(string $name)
    {
        $value = $this->request->getPost($name);

        $this->OptionModel->saveOption($name, $value);
        return $this->RedirectWithToast('Option Saved', 'Success', '/dashboard/option-list');
    }
}
