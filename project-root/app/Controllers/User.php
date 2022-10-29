<?php

namespace App\Controllers;

use App\Libraries\Hash;

class User extends BaseController
{
  public function __construct()
  {
    helper('form');
  }

  public function updateProfile()
  {
    $userModel = new \App\Models\UserModel();
    $logged_user_id = session()->get('loggedUser');

    if ($logged_user_id) {

      $validation = $this->validate([
        'name' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Campo nome não pode ficar vazio'
          ]
        ],
        'email' => [
          'rules' => 'required|valid_email',
          'errors' => [
            'required' => 'Campo email não pode ficar vazio',
            'valid_email' => 'Email inválido'
          ]
        ],
        'phone' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Campo telefone não pode ficar vazio'
          ]
        ]
      ]);

      if (!$validation) {

        $user_info = $userModel->find($logged_user_id);

        $data = [
          'title' => 'Minha conta'
        ];

        return view('templates/page/header', $data)
          . view('templates/dash/header', $data)
          . view('dash/profile', ['validation' => $this->validator, 'user_info' => $user_info])
          . view('templates/page/footer');
      } else {

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');

        $userData = $userModel->getWhere(['email' => $email, 'id' => $logged_user_id], 1);

        if ($userData->resultID->num_rows == 0) {
          $values = [
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone
          ];
        } else {
          $values = [
            'name' => $name,
            'phone_number' => $phone
          ];
        }

        $query = $userModel->update($logged_user_id, $values);

        if (!$query) {
          return redirect()->back()->with('fail', 'Erro ao salvar no banco de dados');
        } else {
          return redirect()->to('/dashboard/profile')->with('success', 'Dados atualizados com sucesso!');
        }
      }
    }
  }

  public function updatePassword()
  {
    $userModel = new \App\Models\UserModel();
    $logged_user_id = session()->get('loggedUser');

    if ($logged_user_id) {

      $validation = $this->validate([
        'password' => [
          'rules' => 'required|min_length[5]|max_length[12]',
          'errors' => [
            'required' => 'Campo senha não pode ficar vazio',
            'min_length' => 'Senha deve ter mais de 5 caracteres',
            'max_length' => 'Senha deve ter menos de 12 caracteres'
          ]
        ],
        'password2' => [
          'rules' => 'required|min_length[5]|max_length[12]|matches[password]',
          'errors' => [
            'required' => 'Campo senha não pode ficar vazio',
            'min_length' => 'Senha deve ter mais de 5 caracteres',
            'max_length' => 'Senha deve ter menos de 12 caracteres',
            'matches' => 'As senhas não correspondem',
          ]
        ]
      ]);

      if (!$validation) {

        $user_info = $userModel->find($logged_user_id);

        $data = [
          'title' => 'Minha conta'
        ];

        return view('templates/page/header', $data)
          . view('templates/dash/header', $data)
          . view('dash/profile', ['validation' => $this->validator, 'user_info' => $user_info])
          . view('templates/page/footer');
      } else {
        $password = $this->request->getPost('password');

        $values = [
          'password' => Hash::make($password),
        ];

        $query = $userModel->update($logged_user_id, $values);

        if (!$query) {
          return redirect()->back()->with('fail', 'Erro ao salvar no banco de dados');
        } else {
          return redirect()->to('/dashboard/profile')->with('success', 'Senha atualizada com sucesso!');
        }
      }
    }
  }
}
