<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Promotion;
use App\Store;
use App\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DateTime;

class PromotionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $store = Store::where( 'auth_id',  Auth::user()->id )->first();
        //si no tiene ofertas creadas sera redireccionado para crear 
        if (is_null($store) && Auth::user()->level == 5 ) {
            $store = Store::where('auth_id', '=', Auth::user()->id)->first();
            dd($store);
            return view('admin.promotion.create', compact('store'));
        }
        if (Auth::user()->level != 5 ) {
            return redirect()->back();
            //return "no eres una tienda tienda";
        }
        $promotion = Promotion::where('store_id', '=', $store->id)->get();
        //dd($promotion[0]);
        
        return view('admin.promotion.index', compact('promotion','seguro'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $store = Store::where('auth_id', '=', Auth::user()->id)->get();
        //dd($store);
        return view('admin.promotion.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, ['store_id' => 'required', 'name' => 'required', 'description' => 'required', 'price_not_offert' => 'required', 'price_with_offert' => 'required', 'picture' => 'image', 'location' => 'required', 'points' => 'required', 'type' => 'required', ]);
       
        if ($request->hasFile('file')) {
            /*$imageName = $request->file->store('public');
            $imageName = substr($imageName, 7);
            $imageName = "/storage/" . $imageName;
            $request->picture = $imageName;*/

            $files = Input::file('file');
            //$tipo_archivo = Input::file('file')->getMimeType();
            /* verifica si el directorio donde las imagenes se subiran esta creado */
            if(!file_exists(public_path() . '/images')){
                mkdir(public_path() . '/images',0777);
            }
            $destinationPath = public_path() . '/images'; // upload folder in public directory
            $now = new DateTime();
            $timestring = $now->format('s');
            $filename = $timestring . $files->getClientOriginalName();

                                
            $img = Image::make($files->getRealPath());
            $img->resize(320, 240);
            $img->save( public_path() . '/images/'. $filename );
            
        }else{
            return 'No';
        }
        

        $Promotion = new Promotion;
        $Promotion->store_id = $request->store_id;
        $Promotion->name = $request->name;
        $Promotion->description = $request->description;
        $Promotion->price_not_offert = $request->price_not_offert;
        $Promotion->price_with_offert = $request->price_with_offert;
        $Promotion->picture = '/images/' . $filename;
        /*$Promotion->picture = $request->picture;*/
        $Promotion->expires = $request->expires;
        $Promotion->location = $request->location;
        $Promotion->points = $request->points;
        $Promotion->type = $request->type;
        $Promotion->save();
        //Promotion::create($request->all());
 

        Session::flash('message', 'Promotion added!');
        Session::flash('status', 'success');

        return redirect('admin/promotion');
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
        $promotion = Promotion::findOrFail($id);

        return view('admin.promotion.show', compact('promotion'));
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
        $promotion = Promotion::findOrFail($id);

        return view('admin.promotion.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        //dd($request->all());
        $this->validate($request, ['store_id' => 'required', 'name' => 'required', 'description' => 'required', 'price_not_offert' => 'required', 'price_with_offert' => 'required', 'picture' => 'image', 'location' => 'required', 'points' => 'required', 'type' => 'required', ]);

        $promotion = Promotion::findOrFail($id);
        //$promotion->update($request->all());

        if ($request->hasFile('file')) {
            $files = Input::file('file');
            if(!file_exists(public_path() . '/images')){
                mkdir(public_path() . '/images',0777);
            }
            $destinationPath = public_path() . '/images'; // upload folder in public directory
            $now = new DateTime();
            $timestring = $now->format('s');
            $filename = $timestring . $files->getClientOriginalName();

                                
            $img = Image::make($files->getRealPath());
            $img->resize(320, 240);
            $img->save( public_path() . '/images/'. $filename );
            
        }else{
            return 'No hay imagen seleccionada';
        }


        $promotion->store_id = intval($request->store_id);
        $promotion->name = $request->name;
        $promotion->description = $request->description;
        $promotion->price_not_offert = $request->price_not_offert;
        $promotion->price_with_offert = $request->price_with_offert;
        $promotion->picture = '/images/' . $filename;
        /*$promotion->picture = $request->picture;*/
        $promotion->expires = $request->expires;
        $promotion->location = $request->location;
        $promotion->points = $request->points;
        $promotion->type = $request->type;
        $promotion->save();

        Session::flash('message', 'Promotion updated!');
        Session::flash('status', 'success');

        return redirect('admin/promotion');
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
        $promotion = Promotion::findOrFail($id);

        $promotion->delete();

        Session::flash('message', 'Promotion deleted!');
        Session::flash('status', 'success');

        return redirect('admin/promotion');
    }

}
