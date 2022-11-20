<?php

namespace App\Http\Livewire\Specialist\Farm\Reports\Index;

use App\Models\Farm;
use App\Models\FieldCategory;
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

    }

    public function mount(Farm $farm)
    {
        $this->farm = $farm;
        $this->reports = Report::where('farm_id', $farm->id)->where('form_id', Form::first()->id)->get();
        $this->formFields = FormField::where('form_id', $this->formId)->get()->sortBy('field_category_id');

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

        $this->columnChartModel = $this->getColumnChartModel();
        $this->lineChartModel = $this->getLineChartModel();

    }

    public function resetSelectedReports()
    {
        $this->selectedReports = new Collection([]);
        $this->checkedReports = [];

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
}
