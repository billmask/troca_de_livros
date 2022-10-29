<?php

namespace App\Controllers;

use App\Libraries\Hash;

class Mensagens extends BaseController
{
  public function __construct()
  {
    helper('form');
  }

  public function salvar()
  {
    //registrando no banco de dados
    $nome = $this->request->getPost('nome');
    $email = $this->request->getPost('email');
    $telefone = $this->request->getPost('telefone');
    $mensagem = $this->request->getPost('mensagem');
    $id_usuario = $this->request->getPost('id_usuario');
    $nome_animal = $this->request->getPost('nome_livro');

    $values = [
      'nome' => $nome,
      'email' => $email,
      'telefone' => $telefone,
      'mensagem' => $mensagem,
      'id_usuario' => $id_usuario,
      'livro' => $nome_animal
    ];

    $mensagemModel = new \App\Models\MensagemModel();
    $query = $mensagemModel->insert($values);
    if (!$query) {
      return redirect()->back()->with('fail', 'Erro ao salvar no banco de dados');
    } else {
      $id_contato = $mensagemModel->insertID();

      //return redirect()->to('/dashboard');
      return redirect()->to('/livros')->with('success', 'Contato foi registrado com sucesso!');
    }
  }

  public function marcarRespondida()
  {

    $userModel = new \App\Models\UserModel();
    $id_usuario_logado = session()->get('loggedUser');
    $info_usuario = $userModel->find($id_usuario_logado);

    //id mensagem
    $id_mensagem = $this->request->getPost('id-mensagem');

    $mensagemModel = new \App\Models\MensagemModel();

    $query = $mensagemModel->atualizaMsgParaRespondido($id_mensagem);

    if (!$query) {
      return redirect()->back()->with('fail', 'Erro ao salvar no banco de dados')->with('nome', $info_usuario['nome']);
    } else {
      return redirect()->to('dashboard/contatos')->with('success', 'Contato marcado como respondido!')->with('nome', $info_usuario['nome']);
    }
  }

  public function excluir()
  {

    $userModel = new \App\Models\UserModel();
    $id_usuario_logado = session()->get('loggedUser');
    $info_usuario = $userModel->find($id_usuario_logado);

    //id do animal
    $id_mensagem = $this->request->getPost('id-mensagem');

    $mensagemModel = new \App\Models\MensagemModel();

    $query = $mensagemModel->excluirMensagem($id_mensagem);

    if (!$query) {
      return redirect()->back()->with('fail', 'Erro ao salvar no banco de dados')->with('nome', $info_usuario['nome']);
    } else {
      return redirect()->to('dashboard/contatos')->with('success', 'Mensagem excluída!')->with('nome', $info_usuario['nome']);
    }
  }
}
