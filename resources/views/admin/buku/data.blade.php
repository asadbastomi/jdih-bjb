<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th data-sort-ignore="true"> Cover </th>
                <th data-hide="phone"> Tipe Dokumen </th>
                <th> Judul </th>
                <th data-hide="phone"> T.E.U. Orang/Badan </th>
                <th data-hide="phone"> Penerbit </th>
                <th data-hide="phone"> Tahun </th>
                <th data-hide="phone"> Bidang Hukum </th>
                <th data-hide="phone"> Stok </th>
                <th data-hide="all"> Nomor Panggil </th>
                <th data-hide="all"> Edisi </th>
                <th data-hide="all"> Tempat </th>
                <th data-hide="all"> Subjek </th>
                <th data-hide="all"> ISBN </th>
                <th data-hide="all"> Lokasi </th>
                <th data-hide="all"> Deskripsi Fisik </th>
                <th data-hide="all"> Keterangan </th>
                <th class="fix" data-sort-ignore="true"></th>
            </tr>
        </thead>
        <tbody>
            @if ($buku->count())
                @foreach ($buku as $key => $b)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $buku->firstItem() + $key }}</td>
                        <td class="text-center">
                            @if($b->cover_url)
                                <img src="{{ $b->cover_url }}" alt="cover" class="img-thumbnail" style="max-width:60px; max-height:80px; object-fit:cover;">
                            @else
                                <span class="badge badge-light-secondary">No Cover</span>
                            @endif
                        </td>
                        <td>{{ $b->tipe_dokumen ?? '-' }}</td>
                        <td>{{ $b->judul }}</td>
                        <td>{{ $b->teu_orang_badan }}</td>
                        <td>{{ $b->penerbit }}</td>
                        <td>{{ $b->tahun_terbit }}</td>
                        <td>{{ $b->bidang_hukum }}</td>
                        <td>{{ $b->jumlah ?? 0 }}</td>
                        <td>{{ $b->nomor_panggil }}</td>
                        <td>{{ $b->cetakan_edisi }}</td>
                        <td>{{ $b->tempat_terbit }}</td>
                        <td>{{ $b->subjek }}</td>
                        <td>{{ $b->isbn_issn }}</td>
                        <td>{{ $b->lokasi }}</td>
                        <td>{{ $b->deskripsi_fisik }}</td>
                        <td>{{ $b->keterangan }}</td>
                        <td class="fix">
                            <div class="data-store button-list" data-id="{{ $b->id }}">
                                <button type="button" class="btn btn-xs btn-success waves-effect waves-light btneditdata"><i class="mdi mdi-pencil-outline"></i></button>
                                <button type="button" class="btn btn-xs btn-danger waves-effect waves-light btndeletedata"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="19">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="19">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $buku])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
