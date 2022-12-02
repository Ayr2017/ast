<?php

namespace App\Http\Livewire\Specialist\Farm\Reports\Index;

use App\Models\Farm;
use App\Models\FieldCategory;
use App\Models\FieldTemplate;
use App\Models\Form;
use App\Models\FormCategory;
use App\Models\FormField;
use App\Models\Report;
use App\Services\Specialist\ReportService;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class FarmReportsTable extends Component
{
    public Farm $farm;
    public array $colors;
    public Collection $reports;
    public Collection $formFields;
    public Form $form;
    public int $formId;
    public Collection $forms;
    public $checkedReports = [];
    public Collection $selectedReports;
    private ReportService $reportService;
    public  $dateFrom;
    public  $dateTo;
    private ColumnChartModel $columnChartModel;
    private LineChartModel $lineChartModel;
    public $checkedFields = [];
    public $checkedComputedFields = [];
    public Collection $computedFormFields ;
    public string $templateName;
    public string $resultMessage;
    public Collection $templates;

    public function __construct()
    {
        $this->forms = Form::all();
        $this->formId = Form::first()->id;
        $this->form = $this->forms->first();
        $this->reportService = new ReportService();
        $this->dateFrom = Carbon::now()->subMonth()->format('Y-m-d');
        $this->dateTo = Carbon::now()->format('Y-m-d');
        $this->columnChartModel =
            (new ColumnChartModel())
                ->setTitle('График таблицы');

        $this->lineChartModel =
            (new LineChartModel())->setTitle($this->form->name)
                ->addColor('#aa33ff');

        $this->checkedFields = $this->form->fields->pluck('id')->toArray();
        $this->computedFormFields = $this->form->computedFields;
        $this->templates = FieldTemplate::where('form_id', $this->formId)->get();
    }

    public function mount(Farm $farm)
    {
        $this->farm = $farm;
        $this->reports = Report::where('farm_id', $farm->id)->where('form_id', Form::first()->id)->get();
        $this->formFields = FormField::where('form_id', $this->formId)
//            ->orderBy('field_category_id','asc')
            ->orderBy('number','asc')
            ->get()
            ->sortBy('field_category_id')
            ->sortBy(function($item){
            return $item->number ?? PHP_INT_MAX;
        });

        $this->computedFormFields = $this->form->computedFields;
        $this->templateName = '';
        $this->resultMessage = '';

    }

    public function showReports()
    {
        $this->reports = Report::where('farm_id', $this->farm->id)
            ->where('form_id', $this->formId)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();

        $this->formFields = FormField::where('form_id', $this->formId)->get()->sortBy('field_category_id');
    }

    public function updatedFormId($value)
    {
//        $this->reports = Report::where('farm_id', $this->farm->id)->where('form_id', $this->formId)->get();
//        $this->formFields = FormField::where('form_id', $this->formId)->get();
    }

    public function compareReports()
    {
        $this->selectedReports = Report::whereIn('id', $this->checkedReports)->get();
//        $result = $this->reportService->compareSelectedReports($this->selectedReports, $this->formFields);
        $this->reports = $this->selectedReports;
        $this->formFields = $this->formFields->whereIn('id', $this->checkedFields);

        $this->columnChartModel = $this->getColumnChartModel();
        $this->lineChartModel = $this->getLineChartModel();

    }

    public function resetSelectedReports()
    {
        $this->selectedReports = new Collection([]);
        $this->checkedReports = [];
        $this->checkedFields = $this->form->fields->pluck('id')->toArray();
        $this->formFields = $this->form->fields->whereIn('id', $this->checkedFields);
        $this->reports = Report::where('farm_id', $this->farm->id)
            ->where('form_id', $this->formId)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();

    }
    public function resetSelectedReportsWithoutFields()
    {
        $this->selectedReports = new Collection([]);
        $this->checkedReports = [];
        $this->reports = Report::where('farm_id', $this->farm->id)
            ->where('form_id', $this->formId)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();

    }
    public function recoverSelectedReports()
    {
        $this->reports = Report::where('farm_id', $this->farm->id)
            ->where('form_id', $this->formId)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();

    }

    public function render()
    {
        return view('livewire.specialist.farm.reports.index.farm-reports-table',[
            'reports' => $this->reports,
            'formFields' => $this->formFields->sortBy('field_category_id'),
            'form' => $this->form,
            'forms' => $this->forms,
            'formId' => $this->formId,
            'columnChartModel' => $this->columnChartModel,
            'lineChartModel' => $this->lineChartModel,
            ]);
    }

    private function getColumnChartModel()
    {
        $colors = FieldCategory::CATEGORY_COLORS;
        $col = new ColumnChartModel();
        $col->setTitle($this->form->name)->setColumnWidth(10);
        $this->formFields->each(function($item, $key) use ($col, $colors){
            if($item->type == 'number') {
                foreach($this->reports as $key=>$report) {
                    $title = $item->name." ".$report->date;
                    if(isset(($report->data)['field_'.$item->id])) {
                        $col->addColumn($title, ($report->data)['field_'.$item->id], $colors[$key]);
                    } else {
                        $col->addColumn($title, 0, $colors[$key]);
                    }
                }
            }
        });

        return $col;
    }

    private function getLineChartModel()
    {
        $colors = FieldCategory::CATEGORY_COLORS;
        $line = new LineChartModel();
        $line->setTitle($this->form->name)->multiLine();

        $this->formFields->each(function($item, $key) use ($line, $colors){
            if($item->type == 'number') {
                foreach($this->reports as $key=>$report) {
                    $title = $item->name." ".$report->date;
                    if(isset(($report->data)['field_'.$item->id])) {
                        $line->addSeriesPoint($title, $item->name, ($report->data)['field_' . $item->id])->addColor($colors[$key]);
                    } else {
                        $line->addSeriesPoint($title, $item->name, 0)->addColor($colors[$key]);
                    }
                }
            }
        });

        return $line;
    }

    public function getCheckedFieldsCollectionProperty()
    {

        return FormField::whereIn('id', $this->checkedFields)->get();
    }

    public function saveTemplate()
    {
        $res = FieldTemplate::where('name',$this->templateName)->first();
        if($res){
            $this->resultMessage = 'Шаблон с таким названием уже существует!';
        } elseif($this->templateName && is_array($this->checkedFields) && count($this->checkedFields)){
            $fieldTemplate = FieldTemplate::create([
                'name' => $this->templateName,
                'form_id' => $this->formId,
                'fields' => $this->checkedFields,
            ]);
            $this->resultMessage = 'Успешно сохранено!';
            return redirect()->route('specialist.farms.reports.index',['farm' => $this->farm])->with(['msg' => $this->resultMessage]);

        } else {
            $this->resultMessage = 'Произошла ошибка';
        }

    }

    public function acceptFieldsCollection($id)
    {
        $fieldsTemplate = FieldTemplate::find($id);
        $this->formFields = FormField::where('form_id', $this->formId)
            ->whereIn('id',$fieldsTemplate->fields)
//            ->orderBy('field_category_id','asc')
            ->orderBy('number','asc')
            ->get();
    }
}
