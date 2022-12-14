<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AbstractController extends Controller
{
    //view directory and route name
    protected $dir;
    //service class
    protected $service;

    //use livewire for table
    //use 'admin' for route name prefix
    //follow the resource route names
    public function index()
    {
        return view('admin.' . $this->dir . '.index'); //index
    }

    /**
     * show method uses service's show method
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $item = $this->service->show($id);
        return view('admin.' . $this->dir . '.show', compact('item'));
    }

    /**
     * item - for easelly use extended forms views
     * @return Application|Factory|View
     */
    public function create()
    {
        $item = $this->service->create();
        return view('admin.' . $this->dir . '.create', compact('item'));
    }

    /**
     * @return RedirectResponse
     */
    public function store()
    {
        $this->service->store(request()->all());
        return redirect()->route('admin.' . $this->dir . '.index')->with('success', 'Created!');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $item = $this->service->edit($id);
        return view('admin.' . $this->dir . '.edit', compact('item'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function update($id)
    {
        $this->service->update(request()->all(), $id);
        return redirect()->route('admin.' . $this->dir . '.index')->with('success', 'Updated!');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->route('admin.' . $this->dir . '.index')->with('success', 'Deleted!');
    }
}
