@extends('layouts.template')

@section('content')
    @if (Session::get('alreadyAccess'))
        <div class="alert alert-danger">{{ Session::get('alreadyAccess') }}</div>
    @endif

    <div class="jumbotron py-4 px-5">
        <h3 class="display-7">
            Detail Data Keterlambatan
        </h3>
        <p><a href="/" style="text-decoration: none"> Home / </a><a href="{{ route('ps.lates.rekap') }}" style="text-decoration: none">Data Rekapitulasi</a> / Detail Data Keterlambatan</p>
        
        <p class="mt-4 mb-0"><b class="h4">{{ $students['name'] }}</b> | {{ $students['nis'] }} | {{ $students['rombel']['rombel'] }} | {{ $students['rayon']['rayon'] }}</p>
        <div class="row">
            @php $no = 1; @endphp
            @foreach ($lates as $item)
            <div class="card m-3 shadow p-1 mb-5 border-0" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" style="color:  rgb(21, 21, 109);">Keterlambatan ke-{{ $no++ }}</h5>
                    <div class="detail m-3">
                        <b><p class="card-subtitle text-body-secondary mt-3">{{ $item['date_time_late'] }}</p></b>
                        <p class="card-text" style="color: blue;">{{ $item['information'] }}</p>
                        <img src="{{ asset('img/' . $item['bukti']) }}" alt="Bukti" style="width: 150px; height:100px;"> 
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

