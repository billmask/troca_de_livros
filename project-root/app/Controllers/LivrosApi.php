<?php 
// codigo baseado em: https://novebytes.com/2020/09/01/criando-uma-api-com-o-codeigniter-4/
// de Julierme Peixoto, 2020
namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\LivroApiModel;
 
class LivrosApi extends ResourceController
{
    use ResponseTrait;
    // lista todos livros
    public function index()
    {
        $model = new LivroApiModel();
        $data = $model->findAll();
        return $this->respond($data);
    }
 
    // lista um livro
    public function show($id = null)
    {
        $model = new LivroApiModel();
        $data = $model->getWhere(['id' => $id])->getResult();

        if($data){
            return $this->respond($data);
        }
        
        return $this->failNotFound('Nenhum livro encontrado com id '.$id);        
    }
 
    // adiciona um livro
    public function create()
    {
        $model = new LivroApiModel();
        $data = $this->request->getJSON();

        if($model->insert($data)){
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Livro adicionado.'
                ]
            ];
            return $this->respondCreated($response);
        }

        return $this->fail($model->errors());
    }
    
    // atualiza um livro
    public function update($id = null)
    {
        $model = new LivroApiModel();
        $data = $this->request->getJSON();
        
        if($model->update($id, $data)){
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Livro atualizado.'
                    ]
                ];
                return $this->respond($response);
            };

            return $this->fail($model->errors());
        }
 
    // deleta um livro
    public function delete($id = null)
    {
        $model = new LivroApiModel();
        $data = $model->find($id);
        
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Livro removido.'
                ]
            ];
            return $this->respondDeleted($response);
        }
        
        return $this->failNotFound('Nenhum livro encontrado com id '.$id);        
    }
 
}

?>

