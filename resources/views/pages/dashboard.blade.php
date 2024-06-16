@extends('layout.main')

@push('style')
<link rel="stylesheet" href="{{asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
<style>
    .card-stats .card-body {
        padding: 15px 15px 0px;
    }

    .card-stats .card-body .numbers {
        text-align: right;
        font-size: 2em;
    }

    .card-stats .card-body .numbers p {
        margin-bottom: 0;
    }

    .card-stats .card-body .numbers .card-category {
        color: #9A9A9A;
        font-size: 16px;
        line-height: 1.4em;
    }

    .card-stats .card-footer {
        padding: 0px 15px 15px;
    }

    .card-stats .card-footer .stats {
        color: #9A9A9A;
    }

    .card-stats .card-footer hr {
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .card-stats .icon-big {
        font-size: 2.5em;
        /* min-height: 64px; */
    }

    .card-stats .icon-big i {
        /* line-height: 59px; */
    }
</style>
@endpush

@include('pages.dashboard-js')

@section('content')
<div class="row">
   

    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class=" icon-big text-center">
                            <i class="bx bx-folder-plus text-info" style="font-size: 1.5em; "></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">TOTAL SURAT MASUK</p>
                            <p class="card-title">{{$totalincoming}}
                            <p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <a href="{{ route('agenda.incoming') }}" class="badge bg-label-info">
                    Agenda Surat masuk
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class=" icon-big text-center">
                            <i class="bx bx-folder-open text-success " style="font-size: 1.5em; "></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">TOTAL SURAT KELUAR</p>
                            <p class="card-title">{{$totaloutgoing}}
                            <p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <a href="{{ route('agenda.outgoing') }}" class="badge bg-label-success">
                    Agenda Surat Keluar
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class=" icon-big text-center">
                            <i class="bx bx-folder text-warning" style="font-size: 1.5em; "></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">DOKUMENT LAINNYA</p>
                            <p class="card-title">{{$totaldukument}}
                            <p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <a href="{{ route('agenda.bidang') }}" class="badge bg-label-warning">
                    Agenda Dokument
                </a>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
        <div class="card card-stats">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5 col-md-4">
                        <div class=" icon-big text-center">
                            <i class="bx bx-envelope text-warning" style="font-size: 1.5em; "></i>
                        </div>
                    </div>
                    <div class="col-7 col-md-8">
                        <div class="numbers">
                            <p class="card-category">DOKOMENT LAINNYA</p>
                            <p class="card-title">{{$totalincoming}}
                            <p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer ">
                <hr>
                <a href="{{ route('agenda.incoming') }}" class="">
                    Agenda dokument masuk
                </a>
            </div>
        </div>
    </div> -->

</div>

<div class="row">
    <div class="col-lg-8 mb-4 order-1">
        <div class="mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column" style="position: relative;">
                        <div class="">
                            <div class="card-title">
                                <h5 class="text-nowrap mb-2">{{ __('dashboard.today_graphic') }}</h5>
                                <span class="badge bg-label-primary rounded-pill">{{ __('dashboard.today') }}</span>
                            </div>
                            <div class="mt-sm-auto">
                                <!-- @if($percentageLetterTransaction > 0)
                                <small class="text-success text-nowrap fw-semibold">
                                    <i class="bx bx-chevron-up"></i> {{ $percentageLetterTransaction }}%
                                </small>
                                @elseif($percentageLetterTransaction < 0) <small class="text-danger text-nowrap fw-semibold">
                                    <i class="bx bx-chevron-down"></i> {{ $percentageLetterTransaction }}%
                                    </small>
                                    @endif -->
                                <h3 class="mb-0 display-4">{{ $todayLetterTransaction }}</h3>
                            </div>
                        </div>
                        <div id="profileReportChart" style="min-height: 70px; width: 100%">
                            <div id="today-graphic"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 order-0">
        <!-- Transactions -->
        <div class="col-md-6 col-lg-12 order-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">{{ __('dashboard.today_report') }}</h5>
                    <div class="">
                        <span class="badge bg-label-primary rounded-pill P-2">
                            HARI INI
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="badge bg-label-info p-2">
                                    <i class="bx bx-trending-up text-info"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <!-- <small class="text-muted d-block mb-1">Paypal</small> -->
                                    <h6 class="mb-0">{{__('dashboard.incoming_letter')}}</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">{{$todayIncomingLetter}}</h6>
                                    <!-- <span class="text-muted">USD</span> -->
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="badge bg-label-danger p-2">
                                    <i class="bx bx-trending-down text-danger"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <!-- <small class="text-muted d-block mb-1">Paypal</small> -->
                                    <h6 class="mb-0">{{__('dashboard.outgoing_letter')}}</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">{{$todayOutgoingLetter}}</h6>

                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="badge bg-label-primary p-2">
                                    <i class="bx bx-folder text-primary"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <!-- <small class="text-muted d-block mb-1">Paypal</small> -->
                                    <h6 class="mb-0">{{__('dashboard.bidang_letter')}}</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">{{$todayBidangLetter}}</h6>

                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="badge bg-label-warning p-2">
                                    <i class="bx bx-envelope text-warning"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <!-- <small class="text-muted d-block mb-1">Paypal</small> -->
                                    <h6 class="mb-0">{{__('dashboard.disposition_letter')}}</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">{{$todayDispositionLetter}}</h6>
                                    <!-- <span class="text-muted">USD</span> -->
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Transactions -->
    </div>
</div>
@endsection