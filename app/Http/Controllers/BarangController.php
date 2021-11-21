<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Picqer\Barcode;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorJPG;
use App\Barang;
use PDF;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $barangs = Barang::all();
        return view('barang.barang', compact('barangs'));
    }

    public function cetak_pdf()
    {
    	// $pegawai = Pegawai::all();
        $barangs = Barang::all();
    	$pdf = PDF::loadview('barang.barang_cetak',['barangs'=>$barangs]);
    	return $pdf->download('cetak_barcode.pdf');
    }

    public function cetakTNJ(Request $request)
    {
    	// $pegawai = Pegawai::all();
        $barangs = Barang::all();
        $baris = $request->baris_barang;
        $kolom = $request->kolom_barang;
        $long = count($barangs);
        $long =intval($long/5);
        $long++;
    	// $pdf = PDF::loadview('barang.barang_cetak',['barangs'=>$barangs,'long'=>$long,'baris'=>$baris,'kolom'=>$kolom]);
    	// return $pdf->download('cetak_barcode.pdf');
        return view('barang.barang_cetak', compact('barangs','long','baris','kolom'));
    }

    public function cetakPdf(Request $request)
    {
        $dataa = $request->id_barang;
        $datab = explode(",", $dataa);
        $barang = DB::table('barang')->whereIn('barcode_kode', $datab)->get();
        $no = 1;
        $x = 1;
        $col = $request->col;
        $row = $request->row;
        $panjang=(($row-1)*5)+($col-1);
        $data = array(
            'menu' => 'Barcode',
            'barang' => $barang,
            'no' => $no,
            'x' => $x,
            'col' => $col,
            'row' => $row,
            'panjang' => $panjang,
            'submenu' => '',
        );
          
        $customPaper = array(0,0,611.7,469.47);
        // return PDF::loadView('barang.cetakBarcode', $data)->setPaper($customPaper)->stream('barcode_barang.pdf');
        return PDF::loadView('barang.cetakBarcode', $data)->stream('barcode_barang.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('barang.barang_create');
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
        // $date = date('YY/MM/DD');
        // $kode = explode('/', $date);
        $date = Carbon::now()->format('Ymd');
        $number = rand(0, 99);
        $number_exist=true;
        while($number_exist){
            // $kode_barcode=$date.uniqid($number);
            $kode_barcode=$date.$number;
            if (!Barang::where('barcode_kode', '=',"'".$kode_barcode."'")->exists()) {
            //    $liscence->num_liscence=$num_liscence;
            // $generatorPNG = new BarcodeGeneratorPNG();
            // // $barcode = $generator->getBarcode($kode_barcode, $generator::TYPE_CODE_128);
            // $barcode = '< img src="data:image/png;base64,'.base64_encode($generatorPNG->getBarcode('$kode_barcode', $generatorPNG::TYPE_CODE_128)).'" >';
            // // $barcode = $generatorPNG->getBarcode($kode_barcode, $generatorPNG::TYPE_CODE_128);
            $barangs = Barang::create([
                'nama_barang'       => $request->nama,
                'barcode_kode'      => $kode_barcode
            ]);
            $number_exist=false;
            }
         }
        $this->validate($request, [
            'nama'   => 'required',
        ]);

        // $image = $request->image;  // your base64 encoded
        // $image = str_replace('data:image/png;base64,', '', $barcode);
        // $image = str_replace(' ', ' + ', $image);
        // $imageName = $request->nama.time() . '.png';

        // Storage::disk('local')->put($imageName, base64_decode($image));

        

        
        if($barangs){
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Disimpan!']);
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
