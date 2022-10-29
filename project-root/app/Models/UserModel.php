<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

  protected $table = 'usuarios';
  protected $primayKey = 'id';
  protected $allowedFields = ['nome', 'cidade', 'email', 'universidade', 'polo', 'estado', 'senha'];

  public function getUsers()
  {
    $db = db_connect();
    $sql = 'SELECT * FROM usuarios';
    $resultado = $db->query($sql);
    return $resultado->getResultArray();
  }

  public function resetPassword($id, $hash)
  {
    $db = db_connect();
    $sql = "UPDATE usuarios SET password = '$hash' WHERE id = $id";
    $resultado = $db->query($sql);
    return $resultado;
  }
}
