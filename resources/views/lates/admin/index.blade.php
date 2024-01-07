@extends('layouts.template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    
    <h3>Data Keterlambatan</h3>
    <p><a href="/" style="text-decoration: none"> Home / </a>Data Keterlambatan</p>

    <div class="p-2"><a href="{{ route('lates.create') }}" class="btn btn-primary mt-2 btn-sm" style="width: 150px;">Tambah</a>
        <a href="{{ route('lates.export-excel') }}" class="btn btn-info mt-2 btn-sm" style="width: 250px; color:white;">Export Data Keterlambatan</a>
    </div>
    
    <br>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('lates.rekap') }}">Rekapitulasi Data</a>
        </li>
    </ul>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Informasi</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($lates as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['students']['nis'] }}
                    {{ $item['students']['name']}}</td>
                    <td>{{ $item['date_time_late'] }}</td>
                    <td>{{ $item['information'] }}</td>
                    {{-- <td>{{ $student['bukti'] }}</td> --}}
                    
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('lates.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item['id']}}">
                                Hapus 
                            </button>
                    </td>
                </tr>
                <div class="modal fade" id="exampleModal-{{$item['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                        </div>

                        <div class="modal-body">
                            Yakin ingin menghapus data ini? 
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form action="{{ route('lates.delete', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')    
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>  
                        </div>

                    </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection