@extends('layout.main')

@section('content')
<x-breadcrumb :values="[__('menu.transaction.menu'), __('menu.transaction.outgoing_letter'), __('menu.general.edit')]">
</x-breadcrumb>

<div class="card mb-4">
    <form action="{{ route('transaction.outgoing.update', $data) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body row">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <input type="hidden" name="type" value="{{ $data->type }}">
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <x-input-form :value="$data->nomor_dokument" name="nomor_dokument" :label="__('model.letter.nomor_dokument')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <x-input-form :value="$data->penerima" name="penerima" :label="__('model.letter.to')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <x-input-form :value="$data->nomor_agenda" name="nomor_agenda" :label="__('model.letter.nomor_agenda')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-12">
                <x-input-form :value="date('Y-m-d', strtotime($data->tgl_dokument))" name="tgl_dokument" :label="__('model.letter.tgl_dokument')" type="date" />
            </div>
            <div class="col-sm-12 col-12 col-md-12 col-lg-12">
                <x-input-textarea-form :value="$data->description" name="description" :label="__('model.letter.description')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="klasifikasi_kode" class="form-label">{{ __('model.letter.klasifikasi_kode') }}</label>
                    <select class="form-select" id="klasifikasi_kode" name="klasifikasi_kode">
                        @foreach($classifications as $classification)
                        <option @selected(old('klasifikasi_kode', $data->klasifikasi_kode) == $classification->code)
                            value="{{ $classification->code }}"
                            >{{ $classification->type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <x-input-form :value="$data->note ?? ''" name="note" :label="__('model.letter.note')" />
            </div>
            <div class="col-sm-12 col-12 col-md-6 col-lg-4">
                <div class="mb-3">
                    <label for="attachments" class="form-label">{{ __('model.letter.attachment') }}</label>
                    <input type="file" class="form-control @error('attachments') is-invalid @enderror" id="attachments" name="attachments[]" multiple />
                    <span class="error invalid-feedback">{{ $errors->first('attachments') }}</span>
                </div>
                <ul class="list-group">
                    @foreach($data->attachments as $attachment)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ $attachment->path_url }}" target="_blank">{{ $attachment->filename }}</a>
                        <span class="badge bg-danger rounded-pill cursor-pointer btn-remove-attachment" data-id="{{ $attachment->id }}">
                            <i class="bx bx-trash"></i>
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card-footer pt-0">
            <button class="btn btn-primary" type="submit">{{ __('menu.general.update') }}</button>
        </div>
    </form>
</div>
<form action="{{ route('attachment.destroy') }}" method="post" id="form-to-remove-attachment">
    @csrf
    @method('DELETE')
    <input type="hidden" name="id" id="attachment-id-to-remove">
</form>
@endsection

@push('script')
<script>
    $(document).on('click', '.btn-remove-attachment', function(req) {
        $('input#attachment-id-to-remove').val($(this).data('id'));
        Swal.fire({
            title: '{{ __('
            menu.general.delete_confirm ') }}',
            text: "{{ __('menu.general.delete_warning') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#696cff',
            confirmButtonText: '{{ __('
            menu.general.delete ') }}',
            cancelButtonText: '{{ __('
            menu.general.cancel ') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                $('form#form-to-remove-attachment').submit();
            }
        })
    });
</script>
@endpush