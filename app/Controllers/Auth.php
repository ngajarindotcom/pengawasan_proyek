<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // app/Controllers/Auth.php

public function login()
{
    // Jika sudah login, redirect ke dashboard
    if (session()->has('user_id')) {
        return redirect()->to('/dashboard');
    }

    if ($this->request->getMethod() === 'post') {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah');
        }

        // Set session
        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'nama_lengkap' => $user['nama_lengkap'],
            'role' => $user['role'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard')->with('success', 'Login berhasil');
    }

    return view('auth/login');
}

public function logout()
{
    session()->destroy();
    return redirect()->to('/login')->with('success', 'Anda telah logout');
}
}