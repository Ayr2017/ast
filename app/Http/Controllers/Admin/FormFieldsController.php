<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\FormFields\UpdateFormField;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormFields\StoreFormFieldRequest;
use App\Http\Requests\Admin\FormFields\UpdateFormFieldRequest;
use App\Models\FieldCategory;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $formFields = FormField::withTrashed()->get();
        return view('admin.form-fields.index', ['form_fields' => $formFields]);
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
     * @param StoreFormFieldRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFormFieldRequest $request)
    {
        $validatedRequest = $request->validated();
        $formField = FormField::firstOrCreate(['name' => $validatedRequest['name']], $validatedRequest);
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $formField = FormField::withTrashed()->find($id);
        return view('admin.form-fields.show',['form_field' => $formField]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $fieldCategories = FieldCategory::all();
        $fieldUnits = FormField::UNITS;
        $formField = FormField::withTrashed()->find($id);

        return view('admin.form-fields.edit',[
            'form_field' => $formField,
            'field_categories' => $fieldCategories,
            'field_units' => $fieldUnits,
            ]);
    }

    /**
     * @param UpdateFormFieldRequest $request
     * @param $id
     * @param UpdateFormField $updateFormField
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFormFieldRequest $request, $id, UpdateFormField $updateFormField)
    {
        $validatedRequest = $request->validated();
        $formField = $updateFormField->execute($validatedRequest, $id);
        return redirect()->route('admin.form-fields.show',['form_field' => $formField]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $formField = FormField::find($id);
        if($formField){
            $formField->delete();
        } else {
            FormField::withTrashed()->find($id)->restore();
        }

        return redirect()->back();
    }
}
