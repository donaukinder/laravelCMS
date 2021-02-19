<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use App\User;
use App\Visitor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        dd("aqui é uma alteracao");
    }

    public function index(Request $request)
    {
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;
        $interval = intval($request->input('interval', 30));
        if ($interval > 180) {
            $interval = 180;
        }
        //Contagem de visitantes
        $dateInterval = date('Y-m-d H:i:s', strtotime('-' . $interval . ' days'));
        $visitsCount = Visitor::where('date_access', '>=', $dateInterval)->count();

        //Contagem de usuários online
        $datelimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('date_access', '>=', $datelimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);

        //Contagem de Paginas
        $pageCount = Page::count();

        //Contagem de Usuários
        $userCount = User::count();

        //Contagem para o pagePie
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as c')->where('date_access', '>=', $dateInterval)->groupBy('page')->get();
        foreach ($visitsAll as $visit) {
            $pagePie[$visit['page']] = intval($visit['c']);
        }

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));

        return view('admin.home', [
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount' => $pageCount,
            'userCount' => $userCount,
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues,
            'dateInterval' => $interval
        ]);
    }
}
