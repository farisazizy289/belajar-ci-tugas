<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $user;


    //function helper
    function __construct()
    {
    helper('form');
    $this->user = new UserModel();
    }

    //function login
    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUser = $this->user->where(['username' => $username])->first();

            if ($dataUser) {
                if (md5($password) == $dataUser['password']) {
                    session()->set([
                        'username' => $dataUser['username'],
                        'role' => $dataUser['role'],
                        'isLoggedIn' => TRUE
                    ]);

                    return redirect()->to(base_url('/'));
                } else {
                    session()->setFlashdata('failed', 'Username & Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        } else {
            return view('v_login');
        }
    }

    //function logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }

    //register
    public function register_view()
    {
        return view('v_register');
    }

    public function register()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUser = $this->user->where(['username' => $username])->first();

            if ($dataUser) {
                session()->setFlashdata('failed', 'Username Sudah Ada.');
                return redirect()->back();
            } else {
                $newPassword = md5($password);
                $sql = "INSERT into user (username,password,role) values ('$username', '$newPassword','guest')";
        
                $this->user->query($sql);

                return view('v_login');
            }
        } else {
            return view('v_register');
        }
    }

    
}
