<?php

namespace App\Http\Livewire\Specialist\Farm\Reports\Index;

use App\Models\Farm;
use App\Models\Form;
use App\Models\FormField;
use App\Models\Report;
use App\Services\Specialist\ReportService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class FarmReportsTable extends Component
{
    public Farm $farm;
    public Collection $reports;
    public Collection $formFields;
    public Form $form;
    public int $formId =  1;
    public Collection $forms;
    public $checkedReports = [];
    public Collection $selectedReports;
    private ReportService $reportService;
    public  $dateFrom;
    public  $dateTo;

    public function __construct()
    {
        $this->forms = Form::all();
        $this->form = $this->forms->first();
        $this->reportService = new ReportService();
        $this->dateFrom = Carbon::now()->subMonth()->format('Y-m-d');
        $this->dateTo = Carbon::now()->format('Y-m-d');
    }

    public function mount(Farm $farm)
    {
        $this->farm = $farm;
        $this->reports = Report::where('farm_id', $farm->id)->where('form_id', $this->formId)->get();
        $this->formFields = FormField::where('form_id', $this->formId)->get();
    }

    public function showReports()
    {
        $this->reports = Report::where('farm_id', $this->farm->id)
            ->where('form_id', $this->formId)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();
        $this->formFields = FormField::where('form_id', $this->formId)->get();
    }

    public function updatedFormId($value)
    {
//        $this->reports = Report::where('farm_id', $this->farm->id)->where('form_id', $this->formId)->get();
//        $this->formFields = FormField::where('form_id', $this->formId)->get();
    }

    public function compareReports()
    {
        $this->selectedReports = Report::whereIn('id', $this->checkedReports)->get();
        $this->reportService->compareSelectedReports($this->selectedReports, $this->formFields);
    }

    public function resetSelectedReports()
    {
        $this->selectedReports = new Collection([]);
        $this->checkedReports = [];

    }

    public function render()
    {
        return view('livewire.specialist.farm.reports.index.farm-reports-table',[
            'reports' => $this->reports,
            'formFields' => $this->formFields,
            'form' => $this->form,
            'forms' => $this->forms,
            'formId' => $this->formId,
            ]);
    }
}
