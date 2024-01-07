@extends('layouts.template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif

    <h3>Data User</h3>
    <p><a href="/" style="text-decoration: none"> Home / </a>Data User</p>

    <div class="d-flex flex-row-reverse">
        <div class="p-2"><a href="{{ route('user.create') }}" class="btn btn-primary mt-2 btn-sm" style="width: 150px;">Tambah User</a></div>
    </div>
    <br>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($users as $user)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ ucwords($user['role']) }}</td>
                    
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('user.edit', $user['id']) }}" class="btn btn-primary me-3">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$user['id']}}">
                                Hapus 
                            </button>
                    </td>
                </tr>
                <div class="modal fade" id="exampleModal-{{$user['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
                            <form action="{{ route('user.delete', $user['id']) }}" method="POST">
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