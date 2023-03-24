<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Validation\Rule;

class UnitsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $units = Unit::paginate(15);
        return view('admin.units.index',[
            'units' =>$units,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.units.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);
        Unit::create($validated);
        return redirect()->route('admin.units.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('admin.units.edit',[
            'unit' => $unit,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $unit->update($validated);

        return redirect()->back()->with('msg', 'Успешно обновлено');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Unit::find($id)->delete();
        return redirect()->back();
    }
}
