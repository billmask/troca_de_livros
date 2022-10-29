<?php

namespace App\Controllers;

use App\Libraries\Hash;

class Auth extends BaseController
{
  public function __construct()
  {
    helper('form');
  }

  public function sigin($page = 'auth/sigin')
  {

    if (session()->has('loggedUser')) {
      return redirect()->to('dashboard');
    }

    if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
      // Whoops, we don't have a page for that!
      throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $data = [
      'title' => 'Entrar'
    ];

    return view('templates/page/header', $data)
      . view('templates/external/header', $data)
      . view($page)
      . view('templates/page/footer', $data);
  }

  public function registration($page = 'auth/registration')
  {

    if (session()->has('loggedUser')) {
      return redirect()->to('dashboard');
    }

    if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
      // Whoops, we don't have a page for that!
      throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $data = [
      'title' => 'Registro'
    ];

    return view('templates/page/header', $data)
      . view('templates/external/header', $data)
      . view($page)
      . view('templates/page/footer', $data);
  }

  public function recoverPassword($page = 'auth/recover-password')
  {
    if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
      // Whoops, we don't have a page for that!
      throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $data = [
      'title' => 'Recuperar senha'
    ];

    return view('templates/page/header', $data)
      . view('auth/recover-password');
  }

  public function saveRegistration()
  {
    $validation = $this->validate([
      'name' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Campo nome não pode ficar vazio'
        ]
      ],
      'email' => [
        'rules' => 'required|valid_email|is_unique[usuarios.email]',
        'errors' => [
          'required' => 'Campo email não pode ficar vazio',
          'valid_email' => 'Email inválido',
          'is_unique' => 'Email já cadastrado'
        ]
      ],
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

      $data = [
        'title' => 'Registro'
      ];

      return view('templates/page/header', $data)
        . view('auth/registration', ['validation' => $this->validator]);
    } else {
      $name = $this->request->getPost('name');
      $email = $this->request->getPost('email');
      $password = $this->request->getPost('password');
      $city = $this->request->getPost('city');
      $estado = $this->request->getPost('state');
      $universidade = $this->request->getPost('university');
      $polo = $this->request->getPost('campusUniversity');

      $values = [
        'nome' => $name,
        'email' => $email,
        'cidade' => $city,
        'estado' => $estado,
        'universidade' => $universidade,
        'polo' => $polo,
        'senha' => Hash::make($password),
      ];

      $userModel = new \App\Models\UserModel();
      $query = $userModel->insert($values);
      if (!$query) {
        return redirect()->back()->with('fail', 'Erro ao salvar no banco de dados');
      } else {
        $id_usuario = $userModel->insertID();
        session()->set('loggedUser', $id_usuario);
        return redirect()->to('/dashboard');
      }
    }
  }

  function login()
  {
    $validation = $this->validate([
      'email' => [
        'rules' => 'required|valid_email|is_not_unique[usuarios.email]',
        'errors' => [
          'required' => 'Campo email não pode ficar vazio',
          'valid_email' => 'Email inválido',
          'is_not_unique' => 'Email não cadastrado'
        ]
      ],
      'password' => [
        'rules' => 'required|min_length[5]|max_length[12]',
        'errors' => [
          'required' => 'Campo senha não pode ficar vazio',
          'min_length' => 'Senha deve ter mais de 5 caracteres',
          'max_length' => 'Senha deve ter menos de 12 caracteres',
        ]
      ]
    ]);

    if (!$validation) {
      $data = [
        'title' => 'Entrar'
      ];
      return view('templates/page/header', $data)
        . view('auth/sigin', ['validation' => $this->validator]);
    } else {
      $email = $this->request->getPost('email');
      $senha = $this->request->getPost('password');
      $userModel = new \App\Models\UserModel();

      $usuario_info = $userModel->where('email', $email)->first();
      $check_senha = Hash::check($senha, $usuario_info['senha']);

      if (!$check_senha) {
        session()->setFlashdata('fail', 'Senha incorreta');
        return redirect()->to('auth/sigin')->withInput();
      } else {
        $user_id = $usuario_info['id'];
        session()->set('loggedUser', $user_id);
        return redirect()->to('/dashboard');
      }
    }
  }

  function logout()
  {
    if (session()->has('loggedUser')) {
      session()->remove('loggedUser');
      return redirect()->to('auth/sigin/?access=out')->with('success', 'Você saiu!');
    }
  }

  function resetPassword()
  {
    $validation = $this->validate([
      'email' => [
        'rules' => 'required|valid_email|is_not_unique[users.email]',
        'errors' => [
          'required' => 'Campo email não pode ficar vazio',
          'valid_email' => 'Email inválido',
          'is_not_unique' => 'Email não cadastrado'
        ]
      ]
    ]);

    if (!$validation) {
      $data = [
        'title' => 'Recuperar senha'
      ];
      return view('templates/page/header', $data)
        . view('auth/recover-password', ['validation' => $this->validator]);
    } else {
      $email = $this->request->getPost('email');

      $new_password = rand(1000000, 9999999);

      $userModel = new \App\Models\UserModel();

      $userData = $userModel->getWhere(['email' => $email], 1);

      $query = $userModel->resetPassword($userData->getResult()[0]->id, Hash::make($new_password));

      if (!$query) {
        return redirect()->back()->with('fail', 'Erro ao gerar nova senha');
      } else {

        helper('sendMail');
        $status_email = sendMail("templates/email/reset-password", ['new_password' => $new_password]);

        if ($status_email) {
          return redirect()->back()->with('success', 'Sua nova senha foi enviada ao seu email.');
        } else {
          return redirect()->back()->with('fail', 'Erro ao enviar email com nova senha');
        }
      }
    }
  }
}
