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
        <a href="{{-- route('lates.create') --}}" class="btn btn-info mt-2 btn-sm" style="width: 250px; color:white;">Export Data Keterlambatan</a>
    </div>
    
    <br>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link"  href="{{ route('lates.home') }}">Keseluruhan Data</a>
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
                    <td><a href="{{ route('lates.lihat', ['student_id' => $item->id]) }}" style="text-decoration: none;">Lihat</a></td>
                    {{-- <td>{{ $student['bukti'] }}</td> --}}
                    
                    <td class="d-flex justify-content-center">
                        @if ($item['lates_count'] >= 3)
                        {{-- <a href="{{ route('lates.print') }}" class="btn btn-primary">Cetak Surat Pernyataan</a> --}}
                        <a href="{{ route('lates.print', $item['id']) }}" class="btn btn-primary"> Cetak Surat Pernyataan</a>
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item['id']}}">
                                Cetak Surat Pernyataan 
                            </button> --}}
                        @endif
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