@extends('layout.main')

@section('content')

<div id="data-container">

</div>

@endsection
@push('script')
<script>
    $(document).ready(function() {
        // Kode Anda yang akan dijalankan setelah dokumen siap

        // Misalnya, melakukan request AJAX untuk mendapatkan data
        $.ajax({
            url: '{{ route("notif") }}', // Ganti dengan URL yang benar ke endpoint index
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Proses data respons di sini
                console.log(response); // Akan mencetak data JSON ke console
                // Misalnya, jika Anda ingin menampilkan data dalam elemen dengan ID 'data-container':
                const dataContainer = document.getElementById('data-container');
                dataContainer.innerHTML = ''; // Bersihkan elemen terlebih dahulu

                response.forEach(function(disposition) {
               
                    // Buat elemen untuk menampilkan setiap item
                    const itemElement = document.createElement('div');
                    // itemElement.innerHTML = `ID: ${item.id}, Penerima: ${item.penerima}, dll.`;
                    itemElement.innerHTML = `<div class="card mb-4">
                        <div class="card-header pb-0">
                        <div class="d-flex justify-content-between flex-column flex-sm-row">
                                <div class="card-title">
                                    <h4 class="text-nowrap mb-0 fw-bold text-danger">Disposition</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="d-flex justify-content-between flex-column flex-sm-row">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-0 fw-bold">Status : ${disposition.status}</h5>
                                    <small class="text-black">Penerima : 
                                    ${disposition.penerima}
                                    </small>
                                </div>
                                <div class="card-title d-flex flex-row">
                                    <div class="d-inline-block mx-2 text-end text-black">
                                        <small class="d-block text-secondary">{{ __('model.disposition.batas_waktu') }}</small>
                                        ${disposition.formatted_batas_waktu}
                                    </div>
                                </div>
                            </div>
                            <p>Isi Disposisi : ${disposition.content}</p>
                            <small class="text-secondary">Keterangan : ${disposition.note}</small>
                        
                            <hr>
                        </div>
                        <div class="card-header pb-0 pt-0 mt-0">
                        <div class="d-flex justify-content-between flex-column flex-sm-row">
                                <div class="card-title">
                                    <h4 class="text-nowrap mb-0 fw-bold text-primary">Dokument Surat</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="d-flex justify-content-between flex-column flex-sm-row">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-0 fw-bold">Nomor Surat : ${disposition.nomor_dokument}</h5>
                                    <small class="text-black">Nomor Agenda : ${disposition.nomor_agenda}</small></br></br>
                                          <a class="btn btn-primary" href="http://localhost:8000/transaction/${disposition.type}/${disposition.letter}">{{ __('menu.general.view') }} Surat</a>
                                </div>
                                <div class="card-title d-flex flex-row">
                                    <div class="d-inline-block mx-2 text-end text-black">
                                        <div class="penerima-list">
                                        ${disposition.file.map(penerima => {
                                            let iconClass = '';
                                            if (penerima.extension === 'pdf') {
                                                iconClass = 'bx bxs-file-pdf text-danger display-1 cursor-pointer';
                                            } else if (['jpg', 'jpeg'].includes(penerima.extension)) {
                                                iconClass = 'bx bxs-file-jpg text-primary display-1 cursor-pointer';
                                            } else if (penerima.extension === 'png') {
                                                iconClass = 'bx bxs-file-png text-primary display-1 cursor-pointer';
                                            }
                                            return `<a href="${penerima.path_url}" target="_blank">
                                                <i class="${iconClass}"></i>
                                            </a>`;
                                        }).join('')}
                                    </div>
                                             
                                    </div>
                                    
                                </div>
                            </div>
                    </div>`;
                    // Tambahkan elemen ke container
                    dataContainer.appendChild(itemElement);
                });
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan jika terjadi
                console.error('Error:', error);
            }
        });

    });
</script>
@endpush