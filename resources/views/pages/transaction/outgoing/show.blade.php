@extends('layout.main')

@section('content')
<x-breadcrumb :values="[__('menu.transaction.menu'), __('menu.transaction.outgoing_letter'), __('menu.general.view')]">
</x-breadcrumb>

<x-letter-card :letter="$data">
    <div class="mt-2">
        <div class="divider">
            <div class="divider-text">{{ __('menu.general.view') }}</div>
        </div>
        <dl class="row mt-3">

            <dt class="col-sm-3">{{ __('model.letter.tgl_dokument') }}</dt>
            <dd class="col-sm-9">{{ $data->formatted_tgl_dokument }}</dd>

            <dt class="col-sm-3">{{ __('model.letter.nomor_dokument') }}</dt>
            <dd class="col-sm-9">{{ $data->nomor_dokument }}</dd>

            <dt class="col-sm-3">{{ __('model.letter.nomor_agenda') }}</dt>
            <dd class="col-sm-9">{{ $data->nomor_agenda }}</dd>

            <dt class="col-sm-3">{{ __('model.classification.code') }}</dt>
            <dd class="col-sm-9">{{ $data->klasifikasi_kode }}</dd>

            <dt class="col-sm-3">{{ __('model.classification.type') }}</dt>
            <dd class="col-sm-9">{{ $data->classification?->type }}</dd>

            <dt class="col-sm-3">{{ __('model.letter.to') }}</dt>
            <dd class="col-sm-9">{{ $data->penerima }}</dd>

            <dt class="col-sm-3">{{ __('model.general.created_by') }}</dt>
            <dd class="col-sm-9">{{ $data->user?->name }}</dd>

            <dt class="col-sm-3">{{ __('model.general.created_at') }}</dt>
            <dd class="col-sm-9">{{ $data->formatted_created_at }}</dd>

            <dt class="col-sm-3">{{ __('model.general.updated_at') }}</dt>
            <dd class="col-sm-9">{{ $data->formatted_updated_at }}</dd>
        </dl>
    </div>
</x-letter-card>

@endsection