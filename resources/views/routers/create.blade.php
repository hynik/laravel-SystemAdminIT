@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Router</h2>

    <form action="{{ route('routers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Router</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="ip_address" class="form-label">IP Address</label>
            <input type="text" name="ip_address" class="form-control" value="{{ old('ip_address') }}" required>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="port" class="form-label">Port API</label>
            <input type="number" name="port" class="form-control" value="8728" required>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Catatan (Opsional)</label>
            <textarea name="note" class="form-control">{{ old('note') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('routers.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
