<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ScraperController;
use App\Models\Carros;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index')
        ->with('carros', Carros::orderBy('id', 'DESC')->get());
    }

    public function buscar()
    {
        return view('dashboard.buscar');
    }

    public function capturar(Request $request)
    {
        $request->validate([
            'modelo' => 'required',
        ], [
            'modelo.required' => 'Informe o modelo do carro',
        ]);

        $scraper = new ScraperController();
        $carros = $scraper->scraper($request->modelo);

        if(empty($carros)) return redirect()->back()->with('message', 'Nenhum carro foi encontrado');
        echo '<pre>';
        try {
            array_map(function ($carro){
                Carros::create([
                    'nome_veiculo'  => $carro['nome'],
                    'link'          => $carro['link'],
                    'ano'           => $carro['ano'],
                    'combustivel'   => $carro['combust?vel'],
                    'portas'        => $carro['portas'],
                    'quilometragem' => $carro['quilometragem'],
                    'cambio'        => $carro['c?mbio'],
                    'cor'           => $carro['cor'],
                    'user_id'       => auth()->user()->id
                ]);

            }, $carros);

            return redirect('/dashboard')->with('message', 'A pesquisa foi salva!');

        } catch (Exception $e) {
            throw $e;
            return redirect()->back()->with('message', 'Houve um erro: '. $e);
        }
    }

    public function deletar($id)
    {
        $carro = Carros::where('id', $id);
        $carro->delete();
        return redirect()->back()->with('message', 'Carro excluído da lista.');
    }
}
