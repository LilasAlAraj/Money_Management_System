<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\IncomingController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ins = new IncomingController();
        $outs = new OutgoingController();
        return view('home', ['ins' => $ins->index(), 'outs' => $outs->index(), 'ins_total'=>$ins->IncomingsValue($ins->Incomings()),'outs_total'=>$outs-> OutgoingsValue($outs->Outgoings())]);
    }
}
