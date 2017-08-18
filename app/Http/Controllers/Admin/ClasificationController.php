<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Clasification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class ClasificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $clasification = Clasification::all();

        return view('admin.clasification.index', compact('clasification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.clasification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'doubt_percentage' => 'required', 'status' => 'required', ]);

        Clasification::create($request->all());

        Session::flash('message', 'Clasification added!');
        Session::flash('status', 'success');

        return redirect('admin/clasification');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clasification = Clasification::findOrFail($id);

        return view('admin.clasification.show', compact('clasification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clasification = Clasification::findOrFail($id);

        return view('admin.clasification.edit', compact('clasification'));
    }

    
    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required', 'doubt_percentage' => 'required', 'status' => 'required', ]);

        $clasification = Clasification::findOrFail($id);
        $clasification->update($request->all());

        Session::flash('message', 'Clasification updated!');
        Session::flash('status', 'success');

        return redirect('admin/clasification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clasification = Clasification::findOrFail($id);

        $clasification->delete();

        Session::flash('message', 'Clasification deleted!');
        Session::flash('status', 'success');

        return redirect('admin/clasification');
    }

}
