<?php

namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        
        $userModel = new UserModel();
        $user = $userModel->find($this->session->get('user_id'));
        $this->checkLogin();

        $data = [
            'title' => 'Profil Saya',
            'user' => $user,
        ];

        return view('profile/index', $data);
    }

    public function update()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $user = $userModel->find($this->session->get('user_id'));

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama_lengkap' => 'required',
            ];

            if ($this->request->getPost('username') !== $user['username']) {
                $rules['username'] = 'required|is_unique[users.username]';
            }

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            ];

            $userModel->update($user['id'], $data);

            // Update session
            $this->session->set('username', $data['username']);
            $this->session->set('nama_lengkap', $data['nama_lengkap']);

            return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
        }

        return redirect()->to('/profile');
    }

    public function changePassword()
    {
        

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'current_password' => 'required',
                'new_password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[new_password]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
            }

            $userModel = new UserModel();
            $user = $userModel->find($this->session->get('user_id'));

            if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
                return redirect()->back()->with('error', 'Password saat ini salah');
            }

            $userModel->update($user['id'], [
                'password' => $this->request->getPost('new_password'),
            ]);

            return redirect()->to('/profile')->with('success', 'Password berhasil diubah');
        }

        return redirect()->to('/profile');
    }
}