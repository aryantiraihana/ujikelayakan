@extends('layouts.template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif
    
    @if(Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    
    <h3>Data Rombel</h3>
    <p><a href="/" style="text-decoration: none"> Home / </a>Data Rombel</p>
    
    
    <div class="p-2"><a href="{{ route('rombel.create') }}" class="btn btn-primary mt-2 btn-sm" style="width: 150px;">Tambah</a></div>
    <div class="d-flex w-50">
        <form action="{{ route('rombel.search') }}" method="get" class="d-flex w-50">
            <input type="text" name="rombel" id="rombel" class="form-control" style="margin-right: 10px;">
            <button type="submit" class="btn btn-info text-white" style="margin-right: 10px;">Cari</button>
        </form>
        <a href="{{ route('rombel.home') }}" class="btn btn-secondary ms-1">Clear</a>
    </div>
  
    <br>
    <table class="table">
        
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Rombel</th>                
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($rombel as $rombels)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $rombels['rombel'] }}</td>               
                 
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('rombel.edit', $rombels['id']) }}" class="btn btn-primary me-3">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$rombels['id']}}">
                                Hapus 
                            </button>
                    </td>
                </tr>
                <div class="modal fade" id="exampleModal-{{$rombels['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
                            <form action="{{ route('rombel.delete', $rombels['id']) }}" method="POST">
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