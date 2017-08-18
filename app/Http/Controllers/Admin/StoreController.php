<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Store;
use App\Clasification;
use App\Model\admin\admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

  
    public function index()
    {
        $store = Store::where('admin_id', '=', Auth::user()->id)->get();
        //dd($store);
        if ( is_null($store) ){
           return "vacio";   
        }
        return view('admin.store.index', compact('store'));
    }

    
    public function create()
    {   
        
        $clasifications = Clasification::all();

        return view('admin.store.create', compact('clasifications'));
    }

    
    public function store(Request $request)
    {
        //return Auth::id();
        $this->validate($request, ['name' => 'required','auth_id'=>'required', 'admin_id'=>'required', 'nif_cif' => 'required', 'clasification_id' => 'required', 'address' => 'required', 'billing_address' => 'required', 'state' => 'required', 'city' => 'required', 'location' => 'required', 'phone_1' => 'required', 'email' => 'required|string|email|max:255|unique:admins', 'password' => 'required', 'debt_level' => 'required', 'status' => 'required', ]);

        $store = Store::create($request->all());

        Session::flash('message', 'Store added!');
        Session::flash('status', 'success');
        
        $id_store = $store->id;
        //dd($id_store);
        //guardamos la realcion con la categoria de la tienda en la tabla pivote
        DB::table('clasification_store')->insert([
            ['clasification_id' => $request->clasification_id, 'store_id' => $id_store]
        ]);

        // guardamos la informacion de autenticacion de la tienda
        $admin = new admin;
        $admin->name = $request->name;
        $admin->admin_id = Auth::user()->id;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->phone = $request->phone_1;
        $admin->status = $request->status;
        $admin->level = 5;
        $admin->state = $request->state;
        $admin->city = $request->city;
        $admin->address = $request->address;
        $admin->save();

        $store->auth_id = $admin->id;
        $store->save();
        
        return redirect('admin/store');
    }

    public function show($id)
    {
        $store = Store::findOrFail($id);

        return view('admin.store.show', compact('store'));
    }
    
    public function edit($id)
    {
        $store = Store::findOrFail($id);

        return view('admin.store.edit', compact('store'));
    }

    
    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => 'required','auth_id'=>'required', 'nif_cif' => 'required', 'clasification_id' => 'required', 'address' => 'required', 'billing_address' => 'required', 'state' => 'required', 'city' => 'required', 'location' => 'required', 'phone_1' => 'required', 'email' => 'required|string|email|max:255|unique:admins',  'debt_level' => 'required', 'status' => 'required', ]);

        $store = Store::findOrFail($id);
        $store->update($request->all());

        Session::flash('message', 'Store updated!');
        Session::flash('status', 'success');

        return redirect('admin/store');
    }

    
    public function destroy($id)
    {
        $store = Store::findOrFail($id);

        $store->delete();

        Session::flash('message', 'Store deleted!');
        Session::flash('status', 'success');

        return redirect('admin/store');
    }

}
