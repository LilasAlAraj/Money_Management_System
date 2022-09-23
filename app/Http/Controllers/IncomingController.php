<?php

namespace App\Http\Controllers;

use App\Models\incoming;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IncomingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Incomings()
    {
        return Auth::user()->incomings->sortby('created_at');//asc
        //  return Auth::user()->incomings->sortbydesc('created_at');


    }

    public function IncomingsValue($ins)
    {

        $value = 0;
        foreach ($ins as $in) {
            $value += $in->value;
        }
        return $value;
    }

    public function IncomingsByYear($year)
    {
        return $this->Incomings()
            ->wherebetween('created_at', [new Carbon("$year-1-1"), new Carbon("$year-12-31 11:59:59")]);
    }

    public function IncomingsByDate($date)
    {

        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {

            return [];
        }
        return $this->Incomings()
            ->wherebetween('created_at', [new Carbon("$date"), new Carbon("$date 23:59:59")]);

    }

    public function IncomingsByMonth($date)
    {

        if (preg_match("/^[0-9]{4}-((0(1|3|5|7|9))|11|0(2|4|6|8))|10|12$/", $date))

            return $this->Incomings()
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
//        if (((Incoming::where('user_id', Auth::id()))->count()) < 10)
//            return Incoming::all()->where('user_id', Auth::id())->sortBy('created_at');

        return Incoming::where('user_id', Auth::id())->orderBy('created_at')->paginate(10);;//asc
        //  ->sortbydesc('created_at');

    }

    /**
     * Show the form for creating a new resource.
     *
     * //     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Incomings.add');
    }

    public function display_date()
    {
        $ins = isset($_GET['date']) ? $this->IncomingsByDate($_GET['date']) : [];
        $total = isset($_GET['date']) ? $this->IncomingsValueOfDate($_GET['date']) : [];

        return view('Incomings.by_date', compact('ins', 'total'));
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
                ->withErrors($validator)->with('fall', 'Fault in adding your incoming!') // send back all errors to the login form
                ;
        }

        $incoming = new Incoming();
        $incoming->value = $request->value;
        $incoming->details = $request->details;
        $incoming->user_id = Auth::id();


        try {
            if ($incoming->save())
                return redirect()->back()->with('success', 'Your incoming has been added successfully!');
            else
                return redirect()->back()->with('fall', 'Fault in adding your incoming!');

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('fall', 'Fault in adding your incoming!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $incomingID
     * @return \Illuminate\Http\Response
     */
    public function show($incomingID)
    {
        return Incoming::find($incomingID);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\incoming $incoming
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('Incomings.edit', ['in' => $this->show($request->ID)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\incoming $incoming
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
                ->withErrors($validator)->with('fall', 'Fault in editing your incoming!') // send back all errors to the login form
                ;
        }

        try {
            if (Incoming::where('id', $request->incomingID)->update(['value' => $request->value, 'details' => $request->details]))
                return redirect('/home')->with('success', 'Your incoming has been edited successfully!');
            else
                return redirect('/home')->with('fall', 'Fault in editing your incoming!');

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/home')->with('fall', 'Fault in editing your incoming!');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\incoming $incoming
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            if (Incoming::where('id', $request->ID)->delete())
                return redirect('/home')->with('success', 'Your incoming has been deleted successfully!');
            else
                return redirect('/home')->with('fall', 'Fault in deleting your incoming!');

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/home')->with('fall', 'Fault in deleting your incoming!');

        }

        return redirect()->back();
    }

}
