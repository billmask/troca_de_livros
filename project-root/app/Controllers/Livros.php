<?php

namespace App\Controllers;

use App\Libraries\Hash;
use CodeIgniter\Files\File;

class Livros extends BaseController
{
  public function __construct()
  {
    helper('form');
  }

  public function index($page = 'livros/lista')
  {
    $logged_user_id = session()->get('loggedUser');

    if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
      // Whoops, we don't have a page for that!
      throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
    }

    $livroModel = new \App\Models\LivroModel();

    if (isset($_GET['buscar'])) {
      $info_livros = $livroModel->search($_GET['buscar']);
    } else {
      $info_livros = $livroModel->getLivrosDisponiveis();
    }

    $data = [
      'title' => 'Livros para doação',
      'livros' => $info_livros
    ];

    return view('templates/page/header', $data)
      . view('templates/external/header', $data)
      . view('templates/dash/secondary-header', $data)
      . view($page)
      . view('templates/page/footer', $data);
  }

  public function salvar()
  {
    $userModel = new \App\Models\UserModel();
    $id_usuario_logado = session()->get('loggedUser');
    $info_usuario = $userModel->find($id_usuario_logado);

    //registrando no banco de dados
    $nome = $this->request->getPost('nome');
    $autor = $this->request->getPost('autor');
    $editora = $this->request->getPost('editora');
    $edicao = $this->request->getPost('edicao');
    $ano = $this->request->getPost('ano');
    $tema = $this->request->getPost('tema');
    $tipo = $this->request->getPost('tipo');
    $estado = $this->request->getPost('estado');
    $img = $this->request->getFile('img');
    $id_usuario = $id_usuario_logado;

    //Img to pasta uploads
    $newName = $img->getRandomName();
    $move_img = $img->move(ROOTPATH . 'public/assets/uploads/', $newName);

    $img_url = base_url() . '/assets/uploads/' . $newName;

    $values = [
      'nome' => $nome,
      'autor' => $autor,
      'editora' => $editora,
      'edicao' => $edicao,
      'ano' => $ano,
      'tema' => $tema,
      'estado' => $estado,
      'url_img' => $img_url,
      'id_usuario' => $id_usuario,
      'tipo' => $tipo
    ];

    $livroModel = new \App\Models\LivroModel();
    $query = $livroModel->insert($values);
    if (!$query) {
      return redirect()->back()->with('fail', 'Erro ao salvar no banco de dados')->with('nome', $info_usuario['nome']);
    } else {
      $id_animal = $livroModel->insertID();

      //return redirect()->to('/dashboard');
      return redirect()->to('/dashboard/livros')->with('success', $nome . ' foi registrado com sucesso!')->with('nome', $info_usuario['nome']);
    }
  }

  public function excluir()
  {

    $userModel = new \App\Models\UserModel();
    $id_usuario_logado = session()->get('loggedUser');
    $info_usuario = $userModel->find($id_usuario_logado);

    //id do animal
    $id_livro = $this->request->getPost('id_livro');

    $livroModel = new \App\Models\LivroModel();

    $query = $livroModel->excluir($id_livro);

    if (!$query) {
      return redirect()->back()->with('fail', 'Erro ao salvar no banco de dados')->with('nome', $info_usuario['nome']);
    } else {
      return redirect()->to('/dashboard/livros')->with('success', 'Livro excluído com sucesso!')->with('nome', $info_usuario['nome']);
    }
  }
}
