@extends('layouts.app')
@section('script_chart')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
    <h2>Monitoring Trafik: {{ $router->name }} - Interface {{ $interface }}</h2>
    <canvas id="trafficChart" width="400" height="200"></canvas>
    <p><strong>Download:</strong> <span id="rx">Loading...</span> bps</p>
    <p><strong>Upload:</strong> <span id="tx">Loading...</span> bps</p>

    <script>
        let trafficChart = null;

        function fetchTraffic() {
            fetch(`{{ route('routers.traffic') }}?router_id={{ $router->id }}&interface={{ $interface }}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('rx').innerText = data['rx-bits-per-second'];
                    document.getElementById('tx').innerText = data['tx-bits-per-second'];
                    renderChart(data);
                })
                .catch(err => {
                    console.error('Gagal fetch data:', err);
                });
        }

        function renderChart(traffic) {
            const chartData = [
                parseInt(traffic['rx-bits-per-second']),
                parseInt(traffic['tx-bits-per-second']),
                parseInt(traffic['fp-rx-bits-per-second']),
                parseInt(traffic['fp-tx-bits-per-second'])
            ];

            if (trafficChart) {
                trafficChart.data.datasets[0].data = chartData;
                trafficChart.update();
            } else {
                const ctx = document.getElementById('trafficChart').getContext('2d');
                trafficChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            'RX Bits/sec',
                            'TX Bits/sec',
                            'FP RX Bits/sec',
                            'FP TX Bits/sec'
                        ],
                        datasets: [{
                            label: 'Bitrate (bps)',
                            data: chartData,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(153, 102, 255, 0.6)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(255,206,86,1)',
                                'rgba(153,102,255,1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Bits per Second'
                                }
                            }
                        }
                    }
                });
            }
        }

        // Fetch pertama kali dan set interval
        fetchTraffic(); 
        setInterval(fetchTraffic, 5000);
    </script>
@endsection
