<?php

namespace App\Http\Livewire\Specialist\Analytics;

use App\Actions\Specialist\Analytic\DownloadExcel;
use App\Models\Farm;
use App\Models\FieldCategory;
use App\Models\FieldTemplate;
use App\Models\Form;
use App\Models\FormField;
use App\Models\Organization;
use App\Models\Report;
use App\Services\Specialist\FormFieldService;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Services\Specialist\LineChartModelService;

class Index extends Component
{
    public $forms;
    public $formId = 0;
    public $organisations;
    public $farms = [];
    public $selectedOrganisation = '';
    public $selectedFarm = '';
    public $organisationId = 0;
    public $farmId = 0;
    public $buttonDisabled = true;
    public $reports = [];
    public Collection $formFields;
    public $selectedReports = [];
    public $selectedFormFields = [];

    public string $dateFrom = '2023-01-01';
    public string $dateTo = '';
    public $formFieldTemplates = [];
    private LineChartModel $lineChartModel;
    public $form;
    public $templateName = '';
    public $farm;

    protected $listeners = ['postAdded' => 'createAndDownloadPDF'];

    public function createAndDownloadPDF($url, $farm, $legend)
    {
        $this->url = $url;
        $legend = str_replace('Helvetica','"DejaVu Sans"',$legend);
        $this->legend = str_replace('absolute','relative',$legend);
        $this->farmPDF = new Farm($farm);
        $pdfContent = PDF::setOptions([
            'isHtml5ParserEnabled' => false,
            'isRemoteEnabled' => true,
            'pdf' => true
        ])
            ->loadView('livewire.specialist.farm.reports.index.partials.download-pdf-document',
                [
                    'legend' => $this->legend,
                    'url' => $this->url,
                    'farm' => $this->farmPDF,
                    'reports' => $this->reports,
                    'formFields' => $this->formFields->where('type', '=', 'number'),
                ])->output();
        return response()->streamDownload(
            fn() => print($pdfContent),
            "filename.pdf"
        );

    }


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->organisations = Organization::all();
        $this->forms = Form::all();
        $this->dateTo = now()->format('Y-m-d');
        $this->lineChartModel = new LineChartModel();
        $this->formFields = new Collection();
    }

    public function mount()
    {
        $this->formFields = new Collection();
    }

    public function render()
    {
        return view('livewire.specialist.analytics.index');
    }

    public function updatingSelectedOrganisation($value, $key)
    {
        $organisation = $this->organisations->firstWhere('name', $value);
        if ($organisation) {
            $this->organisationId = $organisation->id;
        } else {
            $this->organisationId = 0;
        }
    }

    public function updatedSelectedOrganisation($value, $key)
    {
        $organisation = $this->organisations->firstWhere('name', $value);
        if ($organisation) {
            $this->organisationId = $organisation->id;
            $this->farms = Farm::where('organization_id', $this->organisationId)->get();
        } else {
            $this->dropOrganisation();
        }
    }

    public function updatingSelectedFarm($value, $key)
    {
        $farm = $this->farms->firstWhere('name', $value);
        if ($farm) {
            $this->farmId = $farm->id;
            $this->farms = Farm::where('organization_id', $this->organisationId)->get();
            $this->farm = $farm;
        } else {
            $this->farmId = 0;
        }
    }

    private function dropOrganisation()
    {
        $this->organisationId = 0;
        $this->farmId = 0;
        $this->selectedFarm = '';
    }

    public function updated()
    {
        if ($this->organisationId && $this->farmId && $this->formId) {
            $this->form = Form::find($this->formId);
            $this->buttonDisabled = false;
            $this->formFieldTemplates = FieldTemplate::where('form_id', $this->formId)->get();
            $this->reports = collect([]);
            $this->findReports();
            $this->lineChartModel = LineChartModelService::getLineChartModel($this->reports, $this->form, $this->formFields);
        } else {
            $this->buttonDisabled = true;
        }

    }

    public function findReports()
    {
        $this->reports = Report::when($this->formId, function ($query) {
            return $query->where('form_id', $this->formId);
        })->when($this->farmId, function ($query) {
            $farmUUID = Farm::find($this->farmId)->uuid;
            return $query->where('farm_uuid', $farmUUID);
        })->when($this->dateFrom, function ($query) {
            return $query->where('date', '>=', $this->dateFrom);
        })->when($this->dateTo, function ($query) {
            return $query->where('date', '<=', $this->dateTo);
        })
            ->get();

//        $this->formFields = FormField::where('form_id', $this->formId)->orderBy('id')->get();
    }

    public function updatingSelectedReports($value)
    {
//        Log::info($value);
    }

    public function updatingSelectedFormFields($value)
    {
//        Log::info($value);
    }

    public function selectAllFields()
    {
        if ($this->formId) {
            $this->selectedFormFields = FormField::where('form_id', $this->formId)->pluck('id');
        }
    }

    public function useFormFieldTemplate($id)
    {
        $template = FieldTemplate::find($id);
        if ($template) {
            $this->formFields = new Collection();
            $this->formFields = FormField::whereIn('id', $template->fields)->get();
        }
    }

    public function saveFieldsTemplate()
    {
        $fieldsIds = $this->selectedFormFields;
        if (count($fieldsIds) > 0 && $this->formId && $this->templateName) {
            $template = FieldTemplate::create([
                'name' => $this->templateName,
                'fields' => $fieldsIds,
                'form_id' => $this->formId,
            ]);

            $this->templateName = '';
            $this->formFieldTemplates = FieldTemplate::where('form_id', $this->formId)->get();
            $this->dispatchBrowserEvent('close');
        }
    }

    public function unselectAllFields()
    {
        $this->selectedFormFields = [];
    }

    public function useAllFields()
    {
        $this->formFields = new Collection();
        $this->formFields = FormField::where('form_id', $this->formId)->get();
    }

    public function compareReports()
    {
        $this->reports = $this->reports->whereIn('id', $this->selectedReports);
        $this->formFields = $this->formFields->whereIn('id', $this->selectedFormFields);
        $this->lineChartModel = LineChartModelService::getLineChartModel($this->reports, $this->form, $this->formFields);

    }

    public function clearSelectedReports()
    {
        $this->findReports();
    }

    public function downloadExcel(DownloadExcel $downloadExcel)
    {
        $form = Form::find($this->formId);
        return $downloadExcel->execute($this->reports, $this->formFields, $form);
    }

    public function downloadPdf()
    {
        $this->lineChartModel = LineChartModelService::getLineChartModel($this->reports, $this->form, $this->formFields);
    }

    public function getLCM()
    {
        return $this->lineChartModel ?? null;
    }
}
