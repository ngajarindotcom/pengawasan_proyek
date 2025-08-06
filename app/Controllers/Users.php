<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $this->checkLogin();
        $this->checkRole(['admin']);

        $userModel = new UserModel();
        $data = [
            'title' => 'Manajemen User',
            'users' => $userModel->findAll(),
        ];

        return view('users/index', $data);
    }

    public function create()
    {
        $this->checkRole(['admin']);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|is_unique[users.username]',
                'password' => 'required|min_length[6]',
                'nama_lengkap' => 'required',
                'role' => 'required|in_list[admin,pengawas_lapangan,pengawas_material]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
            }

            $userModel = new UserModel();
            $userModel->save([
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'role' => $this->request->getPost('role'),
            ]);

            return redirect()->to('/users')->with('success', 'User berhasil ditambahkan');
        }

        $data = [
            'title' => 'Tambah User',
        ];

        return view('users/create', $data);
    }

    public function edit($id)
    {
        $this->checkRole(['admin']);

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama_lengkap' => 'required',
                'role' => 'required|in_list[admin,pengawas_lapangan,pengawas_material]',
            ];

            if ($this->request->getPost('username') !== $user['username']) {
                $rules['username'] = 'required|is_unique[users.username]';
            }

            if ($this->request->getPost('password')) {
                $rules['password'] = 'min_length[6]';
            }

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'role' => $this->request->getPost('role'),
            ];

            if ($this->request->getPost('password')) {
                $data['password'] = $this->request->getPost('password');
            }

            $userModel->update($id, $data);

            return redirect()->to('/users')->with('success', 'User berhasil diperbarui');
        }

        $data = [
            'title' => 'Edit User',
            'user' => $user,
        ];

        return view('users/edit', $data);
    }

    public function delete($id)
    {
        $this->checkRole(['admin']);

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        $userModel->delete($id);
        return redirect()->to('/users')->with('success', 'User berhasil dihapus');
    }
}