<div>
    <div class="row alert alert-secondary">
        <div class="col-3">
            <div class="">
                <label for="exampleInputEmail1" class="form-label">Форма</label>
                <select class="form-select" aria-label="Default select example" wire:model="formId">
                    @foreach($this->forms as $form)
                        <option value="{{$form->id}}">{{$form->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="">
                <label for="dateFrom" class="form-label">Дата от</label>
                <input type="date" class="form-control" id="dateFrom" wire:model="dateFrom"
                       aria-describedby="dateFromHelp">
                <div id="dateHelp" class="form-text">Дата от</div>
            </div>
        </div>
        <div class="col-3">
            <div class="">
                <label for="dateTo" class="form-label">Дата до</label>
                <input type="date" class="form-control" id="dateTo" wire:model="dateTo" aria-describedby="dateToHelp">
                <div id="dateHelp" class="form-text">Дата до</div>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex flex-column align-content-stretch">
                <label for="dateTo" class="form-label">_</label>
                <button class="btn btn-outline-dark " wire:click="showReports">Показать</button>
            </div>
        </div>
    </div>
    <div class="dflex">
        @if(!$uncheckedAll)
        <button class="btn btn-info btn-sm my-1" wire:click="uncheckAll">Убрать выделение</button>
        @else
            <button class="btn btn-info btn-sm my-1" wire:click="checkAll">Вернуть выделение</button>
        @endif
    @foreach($templates as $template)
            <button class="btn btn-outline-dark btn-sm my-1" wire:click="acceptFieldsCollection({{$template->id}})">{{$template->name}}</button>
        @endforeach
    </div>

    @if(!$reports?->isEmpty())
        <div class="table-responsive mt-2">
            @include('livewire.specialist.farm.reports.index.partials.table')
        </div>
        <div wire:loading.delay.long>
            Идёт загрузка контента. Пожалуйста, подождите ...
        </div>
        <div class="my-2">
            @if($checkedReports)
                <button class="btn btn-outline-primary m-1" wire:click="compareReports">Сравнить</button>
            @endif

            @if($selectedReports?->count())
                <button class="btn btn-outline-primary m-1" wire:click="resetSelectedReports">Сбросить</button>
                <button class="btn btn-outline-primary m-1" wire:click="resetSelectedReportsWithoutFields">Сбросить только отчёты</button>
            @endif

            @if($selectedReports?->count())
                <button class="btn btn-outline-primary m-1" wire:click="recoverSelectedReports">К полному списку</button>
                <button class="btn btn-outline-primary m-1" wire:click="downloadExcel">Скачать отчёт в Excell</button>
{{--                <button class="btn btn-outline-primary m-1" wire:click="downloadPDF">Скачать отчёт в PDF</button>--}}
                @endif

                @include('livewire.specialist.farm.reports.index.partials.create-modal')

        </div>
    @else
        <h5 class="h5">Нет данных для этой формы</h5>
    @endif
    <div class="row">
        <div class="col" style="height: 32rem;">
{{--            <livewire:livewire-column-chart--}}
{{--                key="{{ $columnChartModel->reactiveKey() }}"--}}
{{--                :column-chart-model="$columnChartModel"--}}
{{--            />--}}
            <livewire:livewire-line-chart
                key="{{ $lineChartModel->reactiveKey() }}"
                id="1234567"
                :line-chart-model="$lineChartModel"
            />
        </div>
    </div>

    <button class="btn btn-outline-primary" onclick='start({{json_encode($farm)}})'>Скачать диаграмму </button>
    <script>
        function start(farm){

            function downloadSVGAsText() {
                const svg = document.querySelector('svg');
                const base64doc = btoa(unescape(encodeURIComponent(svg.outerHTML)));
                const a = document.createElement('a');
                const e = new MouseEvent('click');
                // a.download = 'download.svg';
                // a.href = 'data:image/svg+xml;base64,' + base64doc;
                // a.dispatchEvent(e);

                Livewire.emit('postAdded', 'data:image/svg+xml;base64,' + base64doc)
            }

            function downloadSVGAsPNG(e){
                const canvas = document.createElement("canvas");
                const svg = document.querySelector('svg');
                titles = svg.querySelectorAll('title')

                for(let title of titles){
                    title.remove()
                }

                const base64doc = btoa(unescape(encodeURIComponent(svg.outerHTML)));
                const w = parseInt(svg.getAttribute('width'));
                const h = parseInt(svg.getAttribute('height'));
                const img_to_download = document.createElement('img');
                img_to_download.src = 'data:image/svg+xml;base64,' + base64doc;
                // console.log(w, h);
                img_to_download.onload = function () {
                    console.log('img loaded');
                    canvas.setAttribute('width', w);
                    canvas.setAttribute('height', h);
                    const context = canvas.getContext("2d");
                    //context.clearRect(0, 0, w, h);
                    context.drawImage(img_to_download,0,0,w,h);
                    const dataURL = canvas.toDataURL('image/png');
                    if (window.navigator.msSaveBlob) {
                        window.navigator.msSaveBlob(canvas.msToBlob(), "download.png");
                        e.preventDefault();
                    } else {
                        const a = document.createElement('a');
                        const my_evt = new MouseEvent('click');
                        // a.download = 'download.png';
                        // a.href = dataURL;
                        // a.dispatchEvent(my_evt);
                        Livewire.emit('postAdded', 'data:image/svg+xml;base64,' + base64doc, farm)

                    }
                    //canvas.parentNode.removeChild(canvas);
                }
            }

            const downloadSVG = document.querySelector('#downloadSVG');
            // downloadSVG.addEventListener('click', downloadSVGAsText);
            const downloadPNG = document.querySelector('#downloadPNG');
            // downloadPNG.addEventListener('click', downloadSVGAsPNG);
            // downloadSVGAsText()
            downloadSVGAsPNG()


        }
    </script>

</div>
