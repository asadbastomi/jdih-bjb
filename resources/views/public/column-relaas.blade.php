<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru" name="description" />
    <meta content="Kota Banjarbaru" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/landing.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    @include('public.header')

    <section class="section pt-3 pb-3" style="background-color: #def0fb;">
        <div class="container-fluid">
            <h3>Pengumuman/Relaas</h3>
        </div>
    </section>

    <section class="section bg-gradient">
        <div class="container-fluid">
            <div class="row" id="relaas-container">
                {{-- <div class="col-12 text-center">
                    <p>Loading data...</p>
                </div> --}}

                {{-- Relaas V2 --}}
                @if ($relaas->count())
                    @foreach ($relaas as $key => $row)
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body">
                                    <span class="text-muted small">{{ $row->tanggal }}</span>
                                    <h5 class="card-title mt-1">{{ $row->nomor }}</h5>
                                    <p class="small mb-1"><strong>Jenis:</strong> {{ $row->jenis }}</p>
                                    <p class="small mb-1"><strong>Pihak Terkait:</strong> {{ $row->pihak_terkait }}</p>
                                    <p class="small mb-3">
                                        <strong>Status:</strong>
                                        <span class="badge badge-{{ $row->status == 'berlaku' ? 'success' : 'danger' }}">{{ $row->status }}</span>
                                    </p>
                                    {{-- <p class="text-muted">{{ $row->konten }}</p> --}}
                                    <div class="d-flex justify-content-between">
                                        <a href="/storage{{ $row->dokumen[0] }}" target="_blank" class="btn btn-primary btn-sm">Unduh Dokumen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center"><p>Belum ada data.</p></div>
                @endif



            </div>
        </div>
    </section>

    @include('public.footer')

    <a href="#" class="back-to-top" id="back-to-top"><i class="mdi mdi-chevron-up"></i></a>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    {{-- <script>
        $(document).ready(function() {
            let apiUrl = "{{ env('JDIH_SVC_RELAAS_URL') }}";

            $.ajax({
                url: apiUrl,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    let container = $("#relaas-container");
                    container.empty();

                    if (response.data.length === 0) {
                        container.html(
                            '<div class="col-12 text-center"><p>Belum ada Pengumuman/Relaas</p></div>'
                        );
                        return;
                    }

                    response.data.forEach(row => {
                        let formattedDate = new Date(row.tanggal).toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: 'long',
                            year: 'numeric'
                        });

                        let statusBadge = row.status === "berlaku" ?
                            '<span class="badge badge-success">Berlaku</span>' :
                            '<span class="badge badge-danger">Tidak Berlaku</span>';

                        let docButton = row.dokumen ?
                            `<a href="${row.dokumen}" target="_blank" class="btn btn-primary btn-sm">Unduh Dokumen</a>` :
                            '';

                        let blogHtml = `
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body">
                                    <span class="text-muted small">${formattedDate}</span>
                                    <h5 class="card-title mt-1">${row.nomor}</h5>
                                    <p class="small mb-1"><strong>Jenis:</strong> ${row.jenis}</p>
                                    <p class="small mb-1"><strong>Pihak Terkait:</strong> ${row.pihak_terkait}</p>
                                    <p class="small mb-1"><strong>Status:</strong> ${statusBadge}</p>
                                    <p class="mt-2 text-muted">${row.konten.substring(0, 100)}...</p>
                                    <div class="d-flex justify-content-between">
                                        ${docButton}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                        container.append(blogHtml);
                    });
                },
                error: function() {
                    $("#relaas-container").html(
                        '<div class="col-12 text-center"><p>Gagal mengambil data. Silakan coba lagi.</p></div>'
                    );
                }
            });
        });
    </script> --}}
</body>

</html>
