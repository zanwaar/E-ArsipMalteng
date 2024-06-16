@extends('layout.main')

@section('content')
<x-breadcrumb :values="[__('menu.transaction.menu'), __('menu.transaction.bidang_letter'), __('menu.general.create')]">
</x-breadcrumb>

<div class="card mb-4">
    <form action="{{ route('transaction.bidang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body row">
            <input type="hidden" name="type" value="bidang">
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <x-input-form name="nomor_dokument" :label="__('model.letter.nomor_surat')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <x-input-form name="bidang" :label="__('model.letter.bidang')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <x-input-form name="nomor_agenda" :label="__('model.letter.nomor_agenda')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-12">
                <x-input-form name="tgl_dokument" :label="__('model.letter.tgl')" type="date" />
            </div>
            <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                <x-input-textarea-form name="description" :label="__('model.letter.description')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="klasifikasi_kode" class="form-label">{{ __('model.letter.klasifikasi_kode') }}</label>
                    <select class="form-select" id="klasifikasi_kode" name="klasifikasi_kode">
                        @foreach($classifications as $classification)
                        <option value="{{ $classification->code }}" @selected(old('klasifikasi_kode')==$classification->code)>
                            {{ $classification->type }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <x-input-form name="note" :label="__('model.letter.note')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="attachments" class="form-label">{{ __('model.letter.attachment') }}</label>
                    <input type="file" class="form-control @error('attachments') is-invalid @enderror" id="attachments" name="attachments[]" multiple />
                    <span class="error invalid-feedback">{{ $errors->first('attachments') }}</span>
                </div>
            </div>
        </div>
        <div class="card-footer pt-0">
            <button class="btn btn-primary" type="submit">{{ __('menu.general.save') }}</button>
        </div>
    </form>
</div>
@endsection