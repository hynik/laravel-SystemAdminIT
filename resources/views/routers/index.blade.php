@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Router</h2>
    @role('staff-it')
        <a href="{{ route('routers.create') }}" class="btn btn-primary mb-3">Tambah Router</a>
        @endrole
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>IP Address</th>
                <th>Username</th>
                <th>Port</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routers as $router)
                <tr>
                    <td>{{ $router->name }}</td>
                    <td>{{ $router->ip_address }}</td>
                    <td>{{ $router->username }}</td>
                    <td>{{ $router->port }}</td>
                    <td>{{ $router->note }}</td>
                    <td>
                    @role('staff-it')
                        <a href="{{ route('routers.edit', $router->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('routers.destroy', $router->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    @endrole
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
