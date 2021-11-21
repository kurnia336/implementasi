<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Toko;
use PDF;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tokos = Toko::all();
        return view('toko.toko', compact('tokos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function scan_toko()
    {
        return view('toko.scan_toko');
    }

    public function getLocationToko(Request $request){
        $data['location'] = Toko::where("barcode_toko",$request->idtoko)->get(["latitude", "longitude","akurasi"]);
        //dd($data);
        return response()->json($data);
    }

    public function cetak_toko($id)
    {
    	// $pegawai = Pegawai::all();
        $pdf = PDF::loadView('toko/cetak_toko', compact('id'));
    
       return $pdf->download('barcode-Toko-'.$id.'.pdf');
    }

    public function getDistanceFromLatLonInKm(Request $request) {
        //dd($request->barcode);
        $toko = DB::table('toko')->where('barcode_toko',$request->barcode)->get();
        //$toko = lokasi_toko::where('barcode',$request->barcode);
        //dd($toko);
        foreach($toko as $value){
            $lat = $value->latitude;
            $long = $value->longitude;
            $acc = $value->akurasi;
        }
        //dd($lat,$long,$acc);
        $earthRadius = 6371000; // Radius of the earth in meter
        //dd($dlat,$dlon);
        $lat_a = $request->latitude;
         $lon_a = $request->longitude;
         $lat_b = $lat;
         $lon_b = $long;
//dd($lat_a,$lon_a,$lat_b,$lat_b);
         $latFrom = deg2rad($lat_a);
         $lonFrom = deg2rad($lon_a);
         $latTo = deg2rad($lat_b);
         $lonTo = deg2rad($lon_b);
        //dd($latFrom,$lonFrom,$latTo,$lonTo);
         $latDelta = $latTo - $latFrom;
         $lonDelta = $lonTo - $lonFrom;
            //dd($latDelta,$lonDelta);
         $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
           cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
           //dd($angle);
         $betwenPoin = $angle * $earthRadius;
         dd($betwenPoin);
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $tokos = Toko::create([
            'barcode_toko'       => $request->barcode_toko,
            'nama_toko'           => $request->nama_toko,
            'latitude'            => $request->latitude,
            'longitude'           => $request->longitude,
            'akurasi'            => $request->accuracy
        ]);

        if($tokos){
            //redirect dengan pesan sukses
            return redirect()->route('toko.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('toko.index')->with(['error' => 'Data Gagal Disimpan!']);
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
