<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Customer;
use App\Provinsi;
use App\Kota;
use App\Kecamatan;
use App\Kelurahan;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::all();
        $prov = Provinsi::all();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        return view('customer.customer', compact('customers','prov','kota','kecamatan','kelurahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $prov = DB::table('provinces')->pluck("name","id");
        return view('customer.customer_create',compact('prov'));
    }
    /////////////////////////////
    public function getCities($id) 
    {        
        $kota = DB::table("regencies")->where("province_id",$id)->pluck("name","id");
        return json_encode($kota);
    }
    public function getDistricts($id) 
    {        
        $kecamatan = DB::table("districts")->where("regency_id",$id)->pluck("name","id");
        return json_encode($kecamatan);
    }
    public function getSubdistricts($id) 
    {        
        $kelurahan = DB::table("villages")->where("district_id",$id)->pluck("name","id");
        return json_encode($kelurahan);
    }

    ////////////////////////////////
    // public function loadData_provinsi(Request $request)
    // {
    //     if ($request->has('q')) {
    //         $cari = $request->q;
    //         $data = provinsi::where('name', 'like',"%".$cari."%")->get();
    //         return response()->json($data);
    //     }
	// }

    // public function loadData_kota(Request $request)
    // {
    //     if ($request->has('q')) {
    //         $cari = $request->q;
    //         $data = Kota::where('name', 'like',"%".$cari."%")->get();
    //         return response()->json($data);
    //     }
	// }

    // public function loadData_kecamatan(Request $request)
    // {
    //     if ($request->has('q')) {
    //         $cari = $request->q;
    //         $data = Kecamatan::where('name', 'like',"%".$cari."%")->get();
    //         return response()->json($data);
    //     }
	// }

    // public function loadData_kelurahan(Request $request)
    // {
    //     if ($request->has('q')) {
    //         $cari = $request->q;
    //         $data = Kelurahan::where('name', 'like',"%".$cari."%")->get();
    //         return response()->json($data);
    //     }
	// }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nama'   => 'required',
        ]);

        // $image = $request->image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $request->image);
        $image = str_replace(' ', ' + ', $image);
        $imageName = str_random(10) . '.png';

        Storage::disk('local')->put($imageName, base64_decode($image));
    
        $customers = Customer::create([
            'nama'     => $request->nama,
            'alamat'   => $request->alamat,
            'foto'     => $request->image,
            'path'     => $imageName,
            'id_kelurahan' =>   $request->id_kelurahan
        ]);

        
        if($customers){
            //redirect dengan pesan sukses
            return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('customer.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
