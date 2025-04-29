<?php

namespace App\Http\Controllers;

use App\Models\Router;
use Illuminate\Http\Request;
use Auth;

class RouterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routers = Router::all();
        return view('routers.index', compact('routers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('routers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip',
            'username' => 'required',
            'password' => 'required',
            'port' => 'required|numeric',
        ]);

        Router::create($request->all());

        return redirect()->route('routers.index')->with('success', 'Router berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('routers.edit', compact('router'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Router $router)
    {
        $request->validate([
            'name' => 'required',
            'ip_address' => 'required|ip',
            'username' => 'required',
            'password' => 'required',
            'port' => 'required|numeric',
        ]);

        $router->update($request->all());

        return redirect()->route('routers.index')->with('success', 'Router berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Router $router)
    {
        if (Auth::user()->hasRole('user')) {
            abort(403, 'Unauthorized.');
        }

        $router->delete();
        return redirect()->route('routers.index')->with('success', 'Router berhasil dihapus.');
    }
}
