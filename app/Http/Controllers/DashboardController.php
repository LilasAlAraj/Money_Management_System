<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
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
    public function yearly()
    {
        $incomingController = new IncomingController();
        $outgoingController = new OutgoingController();

        $ins = $incomingController->Incomings();
        $outs = $outgoingController->Outgoings();

        $inTotal = $ins->count();
        $outTotal = $outs->count();

        $inValue = $incomingController->IncomingsValue($ins);
        $outValue = $outgoingController->OutgoingsValue($outs);

        $years = [];
        foreach ($ins as $in)
            $years[] = substr_replace($in->created_at, '', 4);

        foreach ($outs as $out)
            $years[] = substr_replace($out->created_at, '', 4);


        $years = array_values(array_unique($years));
        $insByYear = [];
        foreach ($years as $year) {
            $insByYear[] = $incomingController->IncomingsValue($incomingController->IncomingsByYear($year));
        }
        $outsByYear = [];

        foreach ($years as $year) {
            $outsByYear[] = $outgoingController->OutgoingsValue($outgoingController->OutgoingsByYear($year));
        }

        return view('Dashboard.yearlyDashboard', compact('inTotal', 'inValue', 'outTotal', 'outValue', 'years', 'outsByYear', 'insByYear'));
    }

    public function monthly()
    {
        $incomingController = new IncomingController();
        $outgoingController = new OutgoingController();


        if (!isset($_GET['month']) || strlen($_GET['month']) < 1) {
            $ins =[];
        $outs = [];

        $inTotal = 0;
        $outTotal =0;

        $inValue = 0;
        $outValue = 0;

        $days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];

        $insByMonth = [];

        $outsByMonth = [];

        } else {
            $ins = $incomingController->IncomingsByMonth($_GET['month']);
        $outs = $outgoingController->OutgoingsByMonth($_GET['month']);

        $inTotal = $ins->count();
        $outTotal = $outs->count();

        $inValue = $incomingController->IncomingsValue($ins);
        $outValue = $outgoingController->OutgoingsValue($outs);

        $days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];

        $insByMonth = [];
        foreach ($days as $day) {
            $insByMonth[] = $incomingController->IncomingsValue($incomingController->IncomingsByDate($_GET['month'] . "-$day"));
        }
        $outsByMonth = [];
        foreach ($days as $day) {
            $outsByMonth[] = $outgoingController->OutgoingsValue($outgoingController->OutgoingsByDate($_GET['month'] . "-$day"));
        }
}
        return view('Dashboard.monthlyDashboard', compact('inTotal', 'inValue', 'outTotal', 'outValue', 'days', 'outsByMonth', 'insByMonth'));
    }
}
