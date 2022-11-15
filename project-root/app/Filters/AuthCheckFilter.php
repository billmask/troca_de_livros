<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthCheckFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    if (!session()->has('loggedUser')) {
      return redirect()->to('auth/sigin')->with('fail', 'Você deve estar logado para acessar o dashboard!');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
