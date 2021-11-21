<head>
    <title>Barcode</title>

    <style>
        .text-center{
            text-align: center;
        }
        td{
            padding: 7px;
        }
        @page { margin: 0px; }
        body { margin: 0px; }
    </style>
</head>
<body>
@php
    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
@endphp
<table>
    <tr>
    @foreach(range(0,$panjang) as $key)
    @if($x++ <= $panjang)
        <td style="text-align: center; border: 0px solid black" width="100" height="40">
        </td>
    @if ($no++ % 5 == 0)
    </tr>
    <tr>
    @endif
    @else
    @foreach($barang as $data)
        <td style="text-align: center; border: 0px solid black" width="100" height="40" display:block>
            <img width="120" src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($data->barcode_kode, $generatorPNG::TYPE_CODE_128)) }}"><br>
            <!-- {!! $generator->getBarcode($data->barcode_kode, $generator::TYPE_CODE_128) !!} -->
            {{ $data->barcode_kode }}<br>
            {{ $data->nama_barang }}
        </td>

        

    @if ($no++ % 5 == 0)
    </tr>
    @endif
    @endforeach
    @endif
    @endforeach
    </tr>
</table>
</body>
</html>