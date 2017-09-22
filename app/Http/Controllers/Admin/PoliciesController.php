<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Policie;
use Carbon\Carbon;
use Session;

class PoliciesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $policies = Policie::all();
        return view('admin.policie.index', compact('policies'));
    }

    public function create()
    {
        return view('admin.policie.create');
    }

    
    public function store(Request $request)
    {
        //dd($request->all());
        $policie = new Policie();
        $policie->use = $request->use;
        $policie->body = $request->body;
        $policie->save();

        return redirect('admin/policies');
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        $policie = Policie::findOrFail($id);
        return view('admin.policie.edit', compact('policie'));

    }

   
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, ['body'=>'required']);

        $policie = Policie::findOrFail($id);
        $policie->update($request->all());

        Session::flash('message', 'policie updated!');
        Session::flash('status', 'success');

        return redirect('admin/policies');
        
    }

   
    public function destroy($id)
    {
        
    }
}
