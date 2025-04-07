<div
    x-data="window.chartComponent_{{ $chartId }}()"
    x-init="init"
>
    <canvas
        @if(isset($chartOptions['height']))
            style="height: {{ $chartOptions['height'] }}px"
        @endif
        id="{{ $chartId }}"
    ></canvas>

    @script
    <script>
        window.chartComponent_{{ $chartId }} = function () {
            return {
                init() {
                    const ctx = document.getElementById('{{ $chartId }}');
                    if (!ctx) {
                        console.warn('Canvas {{ $chartId }} не найден');
                        return;
                    }

                    let chartData = {!! json_encode($chartData) !!} || { labels: [], datasets: [] };

                    if (!Array.isArray(chartData.datasets)) {
                        console.error("datasets не массив", chartData.datasets);
                        chartData.datasets = [];
                    }

                    if (ctx._chartInstance) {
                        ctx._chartInstance.destroy();
                    }

                    const chart = new Chart(ctx, {
                        type: '{{ $chartType }}',
                        data: chartData,
                        options: {!! json_encode((object) $chartOptions) !!}
                    });

                    ctx._chartInstance = chart;
                }
            };
        }
    </script>
    @endscript
</div>
