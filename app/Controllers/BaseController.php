<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class BaseController extends Controller
{
    protected $helpers = ['form', 'url', 'auth'];

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
    }

    // app/Controllers/BaseController.php

protected function checkLogin()
{
    if (!session()->has('user_id')) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
    }
}

protected function checkRole($allowedRoles = [])
{
    $this->checkLogin();
    
    $userRole = session()->get('role');
    if (!empty($allowedRoles) && !in_array($userRole, $allowedRoles)) {
        return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses');
    }
}
}