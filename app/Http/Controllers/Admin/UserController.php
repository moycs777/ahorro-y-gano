<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use Auth;

use App\Model\admin\admin;
use App\Model\user\User;
use App\Reffer;

class UserController extends Controller
{
    use RegistersUsers;
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /*
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }*/
    
    public function index()
    {
        if (Auth::user()->level == 1) {
            # code...
            $admins = admin::where('level', '<', 5)->get();

            return view('admin.user.show', compact('admins'));
        }
        
        $admins = admin::where('admin_id', '=', Auth::user()->id)
            ->where('level', '<', 5)
            ->orWhere('id', '=', Auth::user()->id)
            ->get();

        return view('admin.user.show', compact('admins'));

    }

    
    public function create()
    {
        return view('admin.user.create');
    }

   
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

        //Tratar el evento en caso de ser referido
        if (!$request->reffered_id == null) {
           $reffered = new Reffer();
           $reffered->user_id = $user->id;
           $reffered->reffered_id = $request->reffered_id;
           $reffered->save();


           Session::flash('message', 'User added!');
           Session::flash('status', 'success');

           return redirect('admin/user');
        }

        //Cuando no se es referido
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
        $user->level = $request->level;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->save();

        Session::flash('message', 'User added!');
        Session::flash('status', 'success');

        return redirect('admin/user');
    }

    public function clientes()
    {
        $clients = User::all();
        //dd($clients);
        return view('admin.user.clients', compact('clients'));

    }

    public function destroy($id)
    {
        $admin = admin::findOrFail($id);

        $admin->delete();

        Session::flash('message', 'admin deleted!');
        Session::flash('status', 'success');

        return redirect('admin/user');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

}
