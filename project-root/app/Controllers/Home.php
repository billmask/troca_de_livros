<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index($page = 'pages/homepage')
    {
        $logged_user_id = session()->get('loggedUser');

        if ($logged_user_id) {
            return redirect()->to('/dashboard');
        }

        if (!is_file(APPPATH . 'Views/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data = [
            'title' => 'Home Page'
        ];

        return view('templates/page/header', $data)
            . view('templates/external/header', $data)
            . view($page)
            . view('templates/page/footer', $data);
    }
}
