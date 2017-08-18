<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use App\Model\admin\admin;
use Auth;

class UserController extends Controller
{
    use RegistersUsers;
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }/*
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = admin::where('admin_id', '=', Auth::user()->id)
            ->orWhere('id', '=', Auth::user()->id)
            ->get();
        return view('admin.user.show', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
            'phone' => 'required',
            'status' => 'required',
            'level' => 'required']);
        
        $user = new admin;
        $user->name = $request->name;
        $user->admin_id = Auth::user()->id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->level = $request->level;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->address = $request->address;

        $user->save();

        Session::flash('message', 'User added!');
        Session::flash('status', 'success');

        return redirect('admin/user');

    }

    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $user = admin::find($id);
        return view('admin.user.edit', compact('user'));
    }
    
    public function update(Request $request, $id)
    {
        $user = admin::findOrFail($id);
        $user->name = $request->name;
        $user->admin_id = Auth::user()->id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->level = Auth::user()->level;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->save();

        Session::flash('message', 'User added!');
        Session::flash('status', 'success');

        return redirect('admin/user');
    }

    public function destroy($id)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
