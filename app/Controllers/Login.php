<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;

class Login extends BaseController
{
    public function dashboard()
    {
        return view('login');
        // echo "Hello World!";
    }
    public function usersignup()
    {
        // print_r($_POST);die();
        $usersModel = new UsersModel();
        helper(['form']);
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'errors',
                'errors' => $this->validator->getErrors(),
            ]);
        }
            $usersModel->insert([
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),

            ]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'User Registered Succesfully']);
    }
}
