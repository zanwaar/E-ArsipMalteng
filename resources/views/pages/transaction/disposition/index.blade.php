@extends('layout.main')

@section('content')
<x-breadcrumb :values="[__('menu.transaction.menu'), $letter->nomor_dokument, __('menu.transaction.disposition_letter')]">
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'operator')
    <a href="{{ route('transaction.disposition.create', $letter) }}" class="btn btn-primary">{{ __('menu.general.create') }}</a>

    @endif
</x-breadcrumb>

<div class="alert alert-primary alert-dismissible" role="alert">
    {{ __('model.disposition.notice_me', ['nomor_dokument' => $letter->nomor_dokument]) }} <a href="{{ route('transaction.incoming.show', $letter) }}" class="fw-bold">{{ __('menu.general.view') }}</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@foreach($data as $disposition)
<x-disposition-card :letter="$letter" :disposition="$disposition" />
@endforeach

{!! $data->appends(['search' => $search])->links() !!}
@endsection