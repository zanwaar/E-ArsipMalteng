@extends('layout.main')

@section('content')
<x-breadcrumb :values="[__('menu.transaction.menu'), $letter->nomor_dokument, __('menu.transaction.disposition_letter'), __('menu.general.edit')]">
</x-breadcrumb>

<div class="alert alert-primary alert-dismissible" role="alert">
    {{ __('model.disposition.notice_me', ['nomor_dokument' => $letter->nomor_dokument]) }} <a href="{{ route('transaction.incoming.show', $letter) }}" class="fw-bold">{{ __('menu.general.view') }}</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<div class="card mb-4">
    <form action="{{ route('transaction.disposition.update', [$letter, $data]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body row">
            <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                <div class="mb-3">
                    <label for="penerima" class="form-label">{{ __('model.disposition.to') }}</label>
                    <select class="form-select" id="penerima" name="penerima">
                        @foreach($penerima as $status)
                        <option value="{{ $status->id }}" @selected(old('penerima', $data->penerima) == $status->id)>
                            {{ $status->name }} - {{ $status->jabatan }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-6">
                <x-input-form name="batas_waktu" :value="date('Y-m-d', strtotime($data->batas_waktu))" :label="__('model.disposition.batas_waktu')" type="date" />
            </div>
            <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                <x-input-textarea-form name="content" :value="$data->content" :label="__('model.disposition.content')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="status_dokument" class="form-label">{{ __('model.disposition.status') }}</label>
                    <select class="form-select" id="status_dokument" name="status_dokument">
                        @foreach($statuses as $status)
                        <option value="{{ $status->id }}" @selected(old('status_dokument', $data->status_dokument) == $status->id)>
                            {{ $status->status }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-8">
                <x-input-form name="note" :value="$data->note ?? ''" :label="__('model.disposition.note')" />
            </div>
        </div>
        <div class="card-footer pt-0">
            <button class="btn btn-primary" type="submit">{{ __('menu.general.update') }}</button>
        </div>
    </form>
</div>
@endsection