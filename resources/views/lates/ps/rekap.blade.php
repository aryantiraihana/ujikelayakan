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
          <a class="nav-link"  href="{{ route('ps.lates.home') }}">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Rekapitulasi Data</a>
        </li>
    </ul>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama</th>
                <th scope="col">Jumlah Keterlambatan</th>
                <th></th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($students as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['lates_count'] }}</td>
                    <td><a href="{{ route('ps.lates.lihat', ['student_id' => $item->id]) }}" style="text-decoration: none;">Lihat</a></td>
                    {{-- <td>{{ $student['bukti'] }}</td> --}}
                    
                    <td class="d-flex justify-content-center">
                        @if ($item['lates_count'] >= 3)
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item['id']}}">
                                Cetak Surat Pernyataan 
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection