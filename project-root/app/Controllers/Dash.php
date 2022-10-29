<?php

namespace App\Controllers;

use App\Libraries\Hash;

class Dash extends BaseController
{
  public function __construct()
  {
    helper('form');
  }

  public function index($page = 'dash/dashboard')
  {
    if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
      // Whoops, we don't have a page for that!
      throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $data = [
      'title' => 'Dashboard',
    ];

    /* return view('templates/page/header', $data)
      . view('templates/dash/header')
      . view('templates/dash/secondary-header', $data)
      . view($page)
      . view('templates/page/footer', $data); */

    return redirect()->to('/dashboard/livros');
  }

  public function livros($page = 'dash/livros')
  {
    if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
      // Whoops, we don't have a page for that!
      throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $userModel = new \App\Models\UserModel();
    $id_usuario_logado = session()->get('loggedUser');
    $info_usuario = $userModel->find($id_usuario_logado);

    $livroModel = new \App\Models\LivroModel();
    $info_livros = $livroModel->getLivrosPorIdUsuario($id_usuario_logado);

    $data = [
      'title' => 'Livros',
      'info_livros' => $info_livros
    ];

    return view('templates/page/header', $data)
      . view('templates/dash/header', $data)
      . view($page)
      . view('templates/page/footer', $data);
  }

  public function contatos($page = 'dash/contatos')
  {
    if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
      // Whoops, we don't have a page for that!
      throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $userModel = new \App\Models\UserModel();
    $id_usuario_logado = session()->get('loggedUser');
    $info_usuario = $userModel->find($id_usuario_logado);

    $mensagemModel = new \App\Models\MensagemModel();
    $info_msgs = $mensagemModel->getMsgmPorIdUsuario($id_usuario_logado);

    $qtde_msgs_disponiveis = 0;
    foreach ($info_msgs as $msg) {
      if ($msg['respondido'] == 0) {
        $qtde_msgs_disponiveis = $qtde_msgs_disponiveis + 1;
      }
    }

    $qtde_msgs_respondidos = 0;
    foreach ($info_msgs as $animal) {
      if ($animal['respondido'] == 1) {
        $qtde_msgs_respondidos = $qtde_msgs_respondidos + 1;
      }
    }

    $data = [
      'title' => 'Contatos recebidos',
      'info_msgs' => $info_msgs,
      'qtde_msgs_respondidos' => $qtde_msgs_respondidos,
      'qtde_msgs_disponiveis' => $qtde_msgs_disponiveis
    ];

    return view('templates/page/header', $data)
      . view('templates/dash/header', $data)
      . view('templates/dash/secondary-header', $data)
      . view($page)
      . view('templates/page/footer', $data);
  }
}
