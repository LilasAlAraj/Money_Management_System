<?php

namespace App\Http\Controllers;

use App\Models\outgoing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OutgoingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Outgoings()
    {
        return Auth::user()->outgoings->sortby('created_at');//asc
        //  return Auth::user()->outgoings->sortbydesc('created_at');
    }

    public function OutgoingsValue($outs)
    {

        $value = 0;
        foreach ($outs as $out) {
            $value += $out->value;
        }
        return $value;
    }




    public function OutgoingsByYear($year)
    {
        return $this->Outgoings()
            ->wherebetween('created_at', [new Carbon("$year-1-1"), new Carbon("$year-12-31 11:59:59")]);
    }

    public function OutgoingsByDate($date)
    {
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {

            return [];
        }
        return $this->Outgoings()
            ->wherebetween('created_at', [new Carbon("$date"), new Carbon("$date 23:59:59")]);
    }


    public function OutgoingsByMonth($date)
    {

        if (preg_match("/^[0-9]{4}-((0(1|3|5|7|9))|11|0(2|4|6|8))|10|12$/", $date))

            return $this->Outgoings()
                ->wherebetween('created_at', [new Carbon("$date-1"), new Carbon("$date-31 23:59:59")]);
        else
            return [];


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if(((Outgoing::where('user_id', Auth::id()))->count())<10)
//            return Outgoing::all()->where('user_id', Auth::id())->sortBy('created_at');
        return Outgoing::where('user_id', Auth::id())->orderBy('created_at')->paginate(10);;//asc

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Outgoings.add');
    }


    public function display_date()
    {
        $outs = isset($_GET['date']) ? $this->OutgoingsByDate($_GET['date']) : [];
        $total = isset($_GET['date']) ? $this->OutgoingsValueOfDate($_GET['date']) : [];

        return view('Outgoings.by_date',compact('outs','total'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
            ['value' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'details' => 'required|max:100|string'
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)->with('fall', 'Fault in adding your outgoing!') // send back all errors to the login form
                ;
        }

        $outgoing = new Outgoing();
        $outgoing->value = $request->value;
        $outgoing->details = $request->details;
        $outgoing->user_id = Auth::id();


        try {
            if ($outgoing->save())
                return redirect()->back()->with('success', 'Your outgoing has been added successfully!');
            else
                return redirect()->back()->with('fall', 'Fault in adding your outgoing!');

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('fall', 'Fault in adding your incoming!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $outgoingID
     * @return \Illuminate\Http\Response
     */
    public function show($outgoingID)
    {
        return Outgoing::find($outgoingID);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\incoming $outgoing
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        return view('Outgoings.edit', ['out' => $this->show($request->ID)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\incoming $outgoing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(),
            ['value' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'details' => 'required|max:100|string'
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)->with('fall', 'Fault in editing your outgoing!') // send back all errors to the login form
                ;
        }

        try {
            if (Outgoing::where('id', $request->incomingID)->update(['value' => $request->value, 'details' => $request->details]))
                return redirect('/home')->with('success', 'Your outgoing has been edited successfully!');
            else
                return redirect('/home')->with('fall', 'Fault in editing your outgoing!');

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/home')->with('fall', 'Fault in editing your outgoing!');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\incoming $outgoing
     */
    public function destroy(Request $request)
    {
        try {
            if (Outgoing::where('id', $request->ID)->delete())
                return redirect('/home')->with('success', 'Your outgoing has been deleted successfully!');
            else
                return redirect('/home')->with('fall', 'Fault in deleting your outgoing!');

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/home')->with('fall', 'Fault in deleting your outgoing!');

        }


    }

    public function getUser($outgoingID)
    {
        return Outgoing::find($outgoingID)->user;
    }


}
