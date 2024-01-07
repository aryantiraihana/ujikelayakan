<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            margin: 355px;
            font-family: Arial, Helvetica, sans-serif;
        }
        .card{
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 30px auto 30px auto;
            background:  #FFF;
        }
        h3{
          text-align: center;
        }
        #back-wrap{
            font-size: 20px;
        }
        .ttd-group1{
            margin: 0 180px;
        }
        .date{
            text-align: right;
        }
        .title{
            margin-bottom: 150px;
        }
        .ttd-1{
            text-align: left;
        }
        .ttd-2{
            text-align: right;
            margin-left: 380px;
        }
        .ttd-3{
            text-align: left;
        }
        .ttd-4{
            text-align: right;
            margin-left: 560px;
        }
        .group1{
            display: flex;
            margin-bottom: 60px;
        }
        p{
            font-size: 20px;
        }
  
    </style>
</head>
<body>
    <div id="back-wrap">
        <a href="{{ route('lates.rekap') }}" class="btn-btn-primary">Kembali</a>
    </div>
    <div class="card">
        <a href="{{ route('lates.download-pdf', ['id' => $lates[0]->id]) }}" class="btn-print">Cetak (.pdf)</a>
    <h3>
        SURAT PERNYATAAN
    </h3>
    <h3>
        TIDAK AKAN DATANG TERLAMBAT KE SEKOLAH
    </h3>
    <br>
    <p>Yang bertanda tangan dibawah ini:</p> <br>
    <p>NIS : {{ $students['name'] }}</p>
    <p>Nama : {{ $students['nis'] }}</p>
    <p>Rombel : {{ $students['rombel']['rombel'] }}</p>
    <p>Rayon : {{ $students['rayon']['rayon'] }}</p><br>

    <p>Dengan Ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke sekolah sebanyak <strong>3 Kali</strong> yang mana hal tersebut termasuk kedalam pelanggaran kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi saya siap diberikan sanksi sesuai dengan peraturan sekolah.</p>
    <br>
    <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>
    <br><br>

    <div class="ttd-group1">
        <div class="date">
            <p>Bogor, <?php echo strftime(" %d %B %Y"); ?></p>
        </div>
        <div class="group1">
            <div class="ttd-1">
                <p class="title">Peserta Didik, </p>
                <p class="name">( {{ $students['name'] }} )</p>
            </div>
            <div class="ttd-2">
                <p class="title">Orang Tua/Wali Peserta Didik, </p>
                <p class="name">( ............. )</p>
            </div>
        </div>
    </div>

    <div class="ttd-group1">
        <div class="group1">
            <div class="ttd-3">
                <p class="title">Pembimbing Siswa, </p>
                <p class="name">( {{ $students['rayon']['user']['name'] }} )</p>
            </div>
            <div class="ttd-4">
                <p class="title">Kesiswaan, </p>
                <p class="name">( ............. )</p>
            </div>
        </div>
    </div>
    </div>
</body>
</html>