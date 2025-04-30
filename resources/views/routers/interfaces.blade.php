@extends('layouts.app')

@section('content')
    <h1>Interface - {{ $router->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Running</th>
                <th>MTU</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($interfaces as $iface)
                <tr>
                    <td>{{ $iface['name'] }}</td>
                    <td>{{ $iface['type'] }}</td>
                    <td>{{ $iface['running'] ?? 'No' }}</td>
                    <td>{{ $iface['mtu'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
