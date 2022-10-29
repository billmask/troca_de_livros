<?php

namespace App\Models;

use CodeIgniter\Model;

class LivroModel extends Model
{

  protected $table = 'livros';
  protected $primayKey = 'id';
  protected $allowedFields = ['nome', 'editora', 'tema', 'autor', 'edicao', 'id_usuario', 'novo', 'ano', 'url_img'];

  public function getLivros()
  {
    $db = db_connect();
    $sql = 'SELECT l.*, u.nome as nome_usuario FROM livros l INNER JOIN usuario u ON u.id = a.id_usuario';
    $resultado = $db->query($sql);
    return $resultado->getResultArray();
  }

  public function getLivrosDisponiveis()
  {
    $db = db_connect();
    $sql = 'SELECT l.*, u.nome as nome_usuario, u.cidade, u.estado, u.id as id_usuario FROM livros l INNER JOIN usuarios u ON u.id = l.id_usuario';
    $resultado = $db->query($sql);
    return $resultado->getResultArray();
  }

  public function getLivrosPorIdUsuario($id)
  {
    $db = db_connect();
    $sql = 'SELECT * FROM livros WHERE id_usuario = ' . $id;
    $resultado = $db->query($sql);
    return $resultado->getResultArray();
  }

  public function excluir($id)
  {
    $db = db_connect();
    $sql = 'DELETE FROM livros WHERE id = ' . $id;
    $resultado = $db->query($sql);
    return $resultado;
  }
}
