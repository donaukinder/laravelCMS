<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use App\User;
use App\Visitor;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;

        //Contagem de visitantes
        $visitsCount = Visitor::count();

        //Contagem de usuários online
        $datelimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('date_access', '>=', $datelimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);

        //Contagem de Paginas
        $pageCount = Page::count();

        //Contagem de Usuários
        $userCount = User::count();

        $pagePie = [
            'Teste 1' => 100,
            'Teste 2' => 200,
            'Teste 3' => 300,
        ];

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));

        return view('admin.home', [
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount' => $pageCount,
            'userCount' => $userCount,
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues,
        ]);
    }
}
