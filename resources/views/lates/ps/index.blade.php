@extends('layouts.template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    
    <h3>Data Keterlambatan</h3>
    <p><a href="{{ route('home.page') }}" style="text-decoration: none"> Home / </a>Data Keterlambatan</p>

    <div class="p-2">
        <a href="{{-- route('lates.create') --}}" class="btn btn-info mt-2 btn-sm" style="width: 250px; color:white;">Export Data Keterlambatan</a>
    </div>
    
    <br>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('ps.lates.rekap') }}">Rekapitulasi Data</a>
        </li>
    </ul>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Informasi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($lates as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['students']['nis'] }} {{ $item['students']['name'] }}</td>
                    <td>{{ $item['date_time_late'] }}</td>
                    <td>{{ $item['information'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection