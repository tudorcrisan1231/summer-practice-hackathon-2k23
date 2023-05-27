<?php

namespace App\Http\Livewire;

use App\Models\Code;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Home extends Component
{
    public $toggleModal = false, $code_name, $codes, $toggleDeleteModal = false, $delete_id, $timer, $edit_id = '';

    public function toggleModal($id = '')
    {
        if($id != ''){
            $this->edit_id = $id;
            $code = Code::find($id);
            $this->code_name = $code->name;
            $this->toggleModal = !$this->toggleModal;
        } else {
            $this->edit_id = '';
            $this->toggleModal = !$this->toggleModal;
            $this->code_name = '';
        }

 
    }

    public function addRandomName(){
        $json = json_decode(file_get_contents('https://swapi.dev/api/people/?page='.rand(1,9)), true);

        $this->code_name = $json['results'][rand(1,9)]['name'];
    }

    public function addCode(){
        if($this->edit_id){
            $code = Code::find($this->edit_id);
            $code->name = $this->code_name;
            $code->save();

            $this->toggleModal = false;
            $this->code_name = "";
            $this->codes = Code::all();
        } else {
            $code = new Code();
            $code->name = $this->code_name;
            $code->code = $this->generateCode();
            $code->add_time = '';
            $code->save();
    
            $this->toggleModal = false;
            $this->code_name = "";
            $this->codes = Code::all();
        }
    }

    public function generateCode(){
        $code = '';
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < 6; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }
        return $code;
    }

    public function deleteCode(){
        $code = Code::find($this->delete_id);
        $code->deleted = 1;
        $code->save();

        $this->toggleDeleteModal = false;
        $this->codes = Code::all();
        $this->delete_id = '';
    }

    public function toggleDeleteModal($id = ''){
        $this->toggleDeleteModal = !$this->toggleDeleteModal;
        $this->delete_id = $id;
    }



    public function timer(){
        if(date("s", time()) == 0 || date("s", time()) == 30){
        
            foreach($this->codes as $code){
                $updateCod = Code::find($code->id);
                $updateCod->code = $this->generateCode();
                $updateCod->save();
            }
            $this->timer = 30;

        } else {
            if(date("s", time()) > 30){
                $this->timer = 60 - date("s", time());
            } else {
                $this->timer = 30 - date("s", time());
            }
        }
    }

    public function callOpenAPI()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://api.openai.com/v1/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer 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',
                
            ],
            
            'json' => [
                
                'prompt' => "generate a random name",
                'max_tokens' => 100,
                'model' => 'text-davinci-001',
            ],
        ]);

        dd(json_decode($response->getBody(), true));
    }

    public function mount(){
        // $this->callOpenAPI();
        $this->codes = Code::all();

        if(date("s", time()) > 30){
            $this->timer = 60 - date("s", time());
        } else {
            $this->timer = 30 - date("s", time());
        }
    }

    public function render()
    {

        return view('livewire.home');
    }
}
