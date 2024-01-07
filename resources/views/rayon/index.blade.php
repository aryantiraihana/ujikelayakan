@extends('layouts.template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    
    <h3>Data Rayon</h3>
    <p><a href="/" style="text-decoration: none"> Home / </a>Data Rayon</p>

    <div class="d-flex flex-row-reverse">
        <div class="p-2"><a href="{{ route('rayon.create') }}" class="btn btn-primary mt-2 btn-sm" style="width: 150px;">Tambah</a></div>
    </div>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Rayon</th>
                <th scope="col">Nama Pembimbing</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($rayon as $rayons)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $rayons['rayon'] }}</td>
                    <td>{{ isset($rayons['user']) ? $rayons['user']['name'] : '-'}}</td>
                    
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('rayon.edit', $rayons['id']) }}" class="btn btn-primary me-3">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$rayons['id']}}">
                                Hapus 
                            </button>
                    </td>
                </tr>
                <div class="modal fade" id="exampleModal-{{$rayons['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
                            <form action="{{ route('rayon.delete', $rayons['id']) }}" method="POST">
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