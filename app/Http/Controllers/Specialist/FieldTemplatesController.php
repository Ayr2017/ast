<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Models\FieldTemplate;
use App\Models\FormField;
use Illuminate\Http\Request;

class FieldTemplatesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $fieldTemplates = FieldTemplate::all();
        return view('specialist.field-templates.index',[
            'field_templates' => $fieldTemplates,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $fieldsTemplate = FieldTemplate::find($id);
        $fields = FormField::where('form_id', $fieldsTemplate->form_id)->get();

        return view('specialist.field-templates.edit',[
            'fields_template' => $fieldsTemplate,
            'fields' => $fields,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'fields' => ['required', 'array'],
        ]);

        FieldTemplate::withTrashed()->find($id)->update($validated);
        return redirect()->back()->with(['msg' => '?????????????? ??????????????????']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fieldsTemplate = FieldTemplate::find($id);
        $fieldsTemplate->delete();
        return redirect()->back()->with(['msg' => '?????????????? ??????????????']);
    }
}
