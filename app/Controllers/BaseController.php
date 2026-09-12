<?php

namespace App\Controllers;


use App\Models\Package;
use App\Models\Option;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    protected Session $session;
    protected Package $PackageModel;
    protected Option $OptionModel;
    protected array $data = [];
    protected array $navbardata = [];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        $this->helpers = ['country', 'userAgent'];


        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);


        $this->session = service('session');

        // Preload any models, libraries, etc, here.
        $this->PackageModel = new Package();
        $this->OptionModel = new Option();
        $this->data['AllPackagesNameAndID'] = $this->PackageModel->getAllPackagesNameAndID();
        $this->data['defaultContact'] = $this->OptionModel->getOptionValue('contact');
        $this->data['navDataLadakh'] = $this->PackageModel->getPackagesByField('PACKAGE_NAME,SLUG,PACKAGE_DAYS,BADGE', 'LOCATION', 'leh');
        $this->data['navDataSpiti'] = $this->PackageModel->getPackagesByField('PACKAGE_NAME,SLUG,PACKAGE_DAYS,BADGE', 'LOCATION', 'spiti');
        $this->data['navDataInternational'] = $this->PackageModel->getAllDistinctCountry();
        $this->data['navDataPackageType'] = $this->PackageModel->getAllDistinctType();
        $this->data['navDataHoneymoon'] = $this->PackageModel->getPackagesByTagForNav('honeymoon');




        \Config\Services::renderer()->setData([
            'isAdmin' => $this->AuthCheckAdmin(),
            'isUser'  => $this->AuthCheck(),
        ]);
    }
    protected function AuthCheckAdmin()
    {
        $condition = ($this->session->has('logged_in') && $this->session->get('role') == 1);
        return ($condition) ? 1 : 0;
    }
    protected function AuthCheck()
    {
        $condition = ($this->session->has('logged_in') && $this->session->get('role') == 0);
        return ($condition) ? 1 : 0;
    }
    protected function Render_Page($view, $data)
    {
        return
            view('layout/header', $data) .
            view('pages/' . $view, $data) .
            view('layout/footer', $data);
    }
    protected function Render_Page_Admin_dashboard($view, $data)
    {
        $mergedData = array_merge($this->data, $data);
        return
            view('dashboard/admin/layout/dashboard-header', $mergedData) .
            view('dashboard/admin/' . $view, $mergedData) .
            view('dashboard/admin/layout/dashboard-footer', $mergedData);
    }
    protected function Render_Page_dashboard($view, $data)
    {
        $mergedData = array_merge($this->data, $data);
        return
            view('dashboard/user/layout/dashboard-header', $mergedData) .
            view('dashboard/user/' . $view, $mergedData) .
            view('dashboard/user/layout/dashboard-footer', $mergedData);
    }
    protected function RedirectWithtoast($message, $status, $redirect)
    {
        // $redirect contains . then it is a named route
        $this->session->setFlashdata('FlashMessage', ['message' => $message, 'status' => $status]);
        return (str_contains($redirect, '.'))
            ? redirect()->to(route_to($redirect))
            : redirect()->to($redirect);
    }
}
