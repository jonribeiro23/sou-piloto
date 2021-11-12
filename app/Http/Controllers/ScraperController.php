<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class ScraperController extends Controller
{
    private $results = array();
    private $temp = array();

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function scraper($termoDeBusca)
    {
        $client = new Client();
        $url = 'https://www.questmultimarcas.com.br/estoque?termo=' . $termoDeBusca;
        $page = $client->request('GET', $url);

        try{
            // For para percorrer cada card da página
            $page->filter('.card')->each(function ($element){

                // For para pegar os atributos do carro e colocar em um array.
                // O primeiro 'span' é a chave e o segundo o valor
                $element->filter('.card-list__row')->each(function ($info){
                    $index = strtolower(str_replace(':', '', $info->filter('.card-list__title')->text()));
                    $this->temp += [
                        utf8_decode($index) => $info->filter('.card-list__info')->text()
                        
                    ];
                });


                $link = $element->filter('.wp-post-image')->extract(array('src'));
                
                $this->temp += [
                    'nome' => $element->filter('.card__title')->text(),
                    'link' => $link[0]
                ];

                array_push($this->results, $this->temp);

                //Limpando o array temporário
                $this->temp = array();
                
            });

        }  catch (InvalidArgumentException $e) {
            throw $e;
            return [];
        } finally {
            return $this->results;
        }
    }
}
