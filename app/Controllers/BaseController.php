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
        $this->helpers = ['country', 'useragentstring', 'navbar', 'custom', 'dates', 'role', 'datetime'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Define a unique cache key


        // Preload any models, libraries, etc, here.
        $this->PackageModel = new Package();
        $this->OptionModel = new Option();
        $this->session = service('session');

        //Caching Nav Data As it will be used on every page ⬇
        $cacheKeys = [
            'navDataLadakh' => fn() => $this->PackageModel->getPackagesByField('PACKAGE_NAME,SLUG,PACKAGE_DAYS,BADGE', 'LOCATION', 'leh'),
            'navDataSpiti' => fn() => $this->PackageModel->getPackagesByField('PACKAGE_NAME,SLUG,PACKAGE_DAYS,BADGE', 'LOCATION', 'spiti'),
            'navDataInternational' => fn() => $this->PackageModel->getAllDistinctCountry(),
            'navDataPackageType' => fn() => $this->PackageModel->getAllDistinctType(),
            'navDataHoneymoon' => fn() => $this->PackageModel->getPackagesByTagForNav('honeymoon'),
            'AllPackagesNameAndID' => fn() => $this->PackageModel->getAllPackagesNameAndID(),
            'defaultContact' => fn() => $this->OptionModel->getOptionValue('contact'),
            'defaultmails' => fn() => $this->OptionModel->getOptionValue('mails'),
            'AnnouncementText' => fn() => $this->OptionModel->getOptionValue('AnnouncementText'),
            'AnnouncementLink' => fn() => $this->OptionModel->getOptionValue('AnnouncementLink'),
            'PopupSwitch' => fn() => $this->OptionModel->getOptionValue('PopupSwitch'),
            'cssversion' => fn() => $this->OptionModel->getOptionValue('cssversion'),
        ];

        foreach ($cacheKeys as $cacheKey => $callback) {
            $cachedData = cache($cacheKey);

            if ($cachedData === null) {
                $cachedData = $callback();
                cache()->save($cacheKey, $cachedData, 300);
            }

            $this->data[$cacheKey] = $cachedData;
        }
        //Caching Nav Data As it will be used on every page ⬆


    }
    protected function Render_Page(string $view, array $data)
    {
        return
            view('layout/header', $data) .
            view('pages/' . $view, $data) .
            view('layout/footer', $data);
    }
    protected function Render_Page_dashboard(string $view, array $data, string $role)
    {
        $mergedData = array_merge($this->data, $data);
        return
            view("dashboard/$role/layout/dashboard-header", $mergedData) .
            view("dashboard/$role/" . $view, $mergedData) .
            view("dashboard/$role/layout/dashboard-footer", $mergedData);
    }
    protected function RedirectWithtoast(string $message, string $status, string $redirect)
    {
        // $redirect contains . then it is a named route
        $this->session->setFlashdata('FlashMessage', ['message' => $message, 'status' => $status]);
        return (str_contains($redirect, '.'))
            ? redirect()->to(route_to($redirect))
            : redirect()->to($redirect);
    }
}
