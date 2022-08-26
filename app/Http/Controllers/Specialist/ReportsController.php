<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Specialist\Report\CreateReportRequest;
use App\Models\Farm;
use App\Models\Form;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ReportsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $reports = Report::withTrashed()->paginate(15);

        return view('specialist.reports.index',['reports' => $reports]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $farmId = Session::get('farm_id') ?? 0;
        $formId = Session::get('form_id') ?? 0;
        $form = Form::with('fields')->find($formId) ?? null;
        $farm = Farm::with('organization')->find($farmId) ?? null;

//        if(!$farm || !$form){
//            return redirect()->back()->withErrors(['message' => "Не выбрана ферма или форма для заполнения"]);
//        }
        return view('specialist.reports.create',['farm' => $farm, 'form' => $form]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReportRequest $request)
    {
        $validatedRequest = $request->validated();
        $validatedRequest['uuid'] = Str::uuid();
        $validatedRequest['user_id'] = auth()->id();
        $report = Report::create($validatedRequest);

        return redirect()->route('specialist.reports.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $report = Report::withTrashed()->find($id);
        return view('specialist.reports.show',['report' => $report]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function select()
    {
        $forms = Form::all();
        return view('specialist.reports.select',['forms' => $forms]);
    }
}
