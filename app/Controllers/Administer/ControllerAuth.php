<?php
namespace App\Controllers\Administer;

use App\Controllers\BaseController;

class ControllerAuth extends BaseController {

    public function getPageLogin() {
        $this->session->stop();
        $this->session->destroy();
		return view('Pages/Login');
	}

    public function processLogin() {
        $data = $this->request->getPost();
        if (!empty($data['username']) && !empty($data['password'])) {
            $username = $data['username'];
            $password = $data['password'];
            if ($username == env('hardusername') && hash_equals(hash_hmac('sha512', env('passwordsalt') . $password, env('passwordkey')), env('hardpassword'))) {
                $this->session->set('username', $data['username']);
                return redirect()->to(base_url());
            }
        }
        return redirect()->to(base_url('/login'));
    }

    public function processLogout() {
        return redirect()->to(base_url('/login'));
    }
}
