@extends('layout.pimpinanLayout')
@section('content')
<style>
    /* CSS untuk efek hover muncul dan efek 3D */
    .rounded:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }
</style>
<div class="container-fluid pt-3 px-2">
    <div class="col-11 tableContent g-2">
        <!-- Dashboard Insiden -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4 text-center">
                <div class="col-sm-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-skull fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">Malware</p>
                        <h6 class="mb-0">11</h6>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-bolt fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">DDoS</p>
                        <h6 class="mb-0">11</h6>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-code fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">SQL Injection</p>
                        <h6 class="mb-0">11</h6>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-envelope fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">Phishing</p>
                        <h6 class="mb-0">11</h6>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-globe fa-3x text-primary mb-2" style="font-size: 2rem;padding: 1px"></i>
                        <p class="mb-2">Web Defacement</p>
                        <h6 class="mb-0">11</h6>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2">
                    <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                        <i class="fa fa-times-circle fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                        <p class="mb-2">Close</p>
                        <h6 class="mb-0">11</h6>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-12">
                    <div class="bg-light rounded w-100 p-4">
                        <h6 class="mb-4">Single Line Chart</h6>
                        <canvas id="linechart" ></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dashboard Insiden -->
    </div>
   
</div>
<div class="container-fluid pt-5 px-4 pb-5">
    <div class="col-11 tableContent g-2 mt-20">
        {{-- Dashboard Status --}}
        <div class="row g-4 text-center">
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                    <i class="fa fa-skull fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                    <p class="mb-2">Pending</p>
                    <h6 class="mb-0">11</h6>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                    <i class="fa fa-bolt fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                    <p class="mb-2">Ditangani</p>
                    <h6 class="mb-0">11</h6>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex flex-column align-items-center p-4" style="height: 100%;">
                    <i class="fa fa-code fa-3x text-primary mb-2" style="font-size: 2rem;padding: 2px"></i>
                    <p class="mb-2">Close</p>
                    <h6 class="mb-0">11</h6>
                </div>
            </div>
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded w-100 p-4">
                    <h6 class="mb-4">Single Line Chart</h6>
                    <canvas id="linechart"></canvas>
                </div>
            </div>
        </div>
        {{-- Dashboard Status --}}
    </div>
</div>
@endsection
@section('title','Pimpinan | Dashboard')
@push('scripts')
<script>
    // Single Line Chart
    var ctx3 = $("#linechart").get(0).getContext("2d");
    var myChart3 = new Chart(ctx3, {
        type: "line",
        data: {
            labels: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150],
            datasets: [{
                label: "Salse",
                fill: false,
                backgroundColor: "rgba(0, 156, 255, .3)",
                data: [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15]
            }]
        },
        options: {
            responsive: true
        }
    });

</script>
    
@endpush
