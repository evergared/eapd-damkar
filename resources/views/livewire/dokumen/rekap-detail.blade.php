<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Document</title>
    <style>
        #isi,#a,#b,#c {
            border: 1px solid black;
            border-collapse: collapse;
            border-right: solid 1px rgb(0, 0, 0); 
            border-left: solid 1px rgb(0, 0, 0);
}
    </style>
</head>
<body>
    <p class="h1 text-center fw-bold">
        Kartu Inventaris Barang
    </p>
        <table class="table">
            <tr>
                <td>Provinsi</td>
                <td>:</td>
                <td>DKI Jakarta</td>
                <td rowspan="4">
                    <div>
                        <img src="data:image/png;base64, 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"/>
                    </div>
                </td>
            </tr>
            
        </table>
    
    <div>
        <table class="table" id="isi">
            <tr id="a">
                <th id="c" rowspan="2"class="text-center align-middle">Nama APD</th>
            </tr>
            @foreach ($rekap as $index => $item)
            <tr>
                <td id="c"class="text-center align-middle">
                    {{$item['nama']}}
                </td>
            </tr>
            <tr>
                <td id="c"class="text-center align-middle">
                    {{$item['jenis_apd']}}
                </td>
            </tr>
            <tr>
                <td id="c"class="text-center align-middle">
                    {{$item['image_apd']}}
                </td>
            </tr>
            <tr>
                <td id="c"class="text-center align-middle">
                    {{$item['kondisi']}}
                </td>
            </tr>
            @endforeach
        </table>  
    </div>

</body>
</html>

