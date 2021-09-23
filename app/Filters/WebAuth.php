<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class WebAuth implements FilterInterface {

    public function before(RequestInterface $request, $arguments = NULL) {
        $options = Services::router()->getMatchedRouteOptions();

        if (isset($options['no_auth'])) return;

        if (!Services::session()->has('username')) {
            return redirect()->to(base_url('/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL) {
    }

}
