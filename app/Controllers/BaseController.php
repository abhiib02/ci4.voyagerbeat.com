<?php

namespace App\Controllers;


use App\Models\Package;
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
    protected array $data = [];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];


        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);


        $this->session = service('session');

        // Preload any models, libraries, etc, here.
        $this->PackageModel = new Package();
        $this->data['AllPackagesNameAndID'] = $this->PackageModel->getAllPackagesNameAndID();

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
        return
            view('dashboard/admin/layout/dashboard-header', $data) .
            view('dashboard/admin/' . $view, $data) .
            view('dashboard/admin/layout/dashboard-footer', $data);
    }
    protected function Render_Page_dashboard($view, $data)
    {
        return
            view('dashboard/user/layout/dashboard-header', $data) .
            view('dashboard/user/' . $view, $data) .
            view('dashboard/user/layout/dashboard-footer', $data);
    }
}
