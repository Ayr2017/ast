<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Forms\CreateForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Forms\StoreFormRequest;
use App\Models\FieldCategory;
use App\Models\Form;
use App\Models\FormCategory;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $forms = Form::withTrashed()->with(['fields','creator','category'])->paginate(15);
        return view('admin.forms.index', ['forms' => $forms]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $formCategories = FormCategory::all();
        return view('admin.forms.create', ['formCategories' => $formCategories]);
    }

    /**
     * @param StoreFormRequest $request
     * @param CreateForm $createForm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFormRequest $request, CreateForm $createForm)
    {
        $validatedRequest = $request->validated();
        $createForm->execute($validatedRequest);
        return redirect()->route('admin.forms.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $fieldCategories = FieldCategory::all();
        $form = Form::withTrashed()->with('fields')->find($id);
        $fieldUnits = FormField::UNITS;

        return view('admin.forms.show', ['form' => $form, 'field_categories' => $fieldCategories, 'field_units' => $fieldUnits]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $form = Form::find($id);
        return view('admin.forms.edit', ['form' => $form]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function update(Request $request, $id)
    {
        dd($request);
        $form = Form::find($id);
        return view('admin.forms.show', ['form' => $form]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $form = Form::withTrashed()->find($id);
        if(!$form->deleted_at) {
            $form->delete();
            return redirect()->back()->with(['form' => $form]);
        }
        $form->restore();
        return redirect()->back()->with(['form' => $form]);
    }
}
