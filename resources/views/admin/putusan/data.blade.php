<?php
setlocale(LC_TIME, 'id_ID');
?>
<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Judul </th>
                <th> Kategori </th>
                <th> Tgl diundangkan </th>
                <th data-hide="all"> T.E.U Badan </th>
                <th data-hide="all"> Subjek </th>
                <th data-hide="all"> Bahasa </th>
                <th data-hide="all"> Bidang Hukum </th>
                <th data-hide="all"> Lokasi </th>
                <th data-hide="all"> Keterangan </th>
                <th class="fix" data-sort-ignore="true"></th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td>{{ $row->nomor . ' Tahun ' . $row->tahun }} <br/> {{ $row->judul }}</td>
                        <td>{{ $row->kategori->nama }}</td>
                        <td>{{ $row->tanggal_diundangkan ? strftime('%d %B %Y', strtotime($row->tanggal_diundangkan)) : '' }} </td>
                        <td>{{ $row->teu_badan }}</td>
                        <td>{{ $row->subjek }}</td>
                        <td>{{ $row->bahasa }}</td>
                        <td>{{ $row->bidang_hukum }}</td>
                        <td>{{ $row->lokasi }}</td>
                        <td>{{ $row->keterangan }}</td>
                        <td class="fix">
                            <div class="data-store button-list" data-id="{{ $row->id }}">
                                <button type="button" class="btn btn-xs btn-success waves-effect waves-light btneditdata" title="Edit Data" data-plugin="tippy" data-tippy-animation="scale" data-tippy-duration="200"><i class="mdi mdi-pencil-outline"></i></button>
                                <button type="button" class="btn btn-xs btn-danger waves-effect waves-light btndeletedata" title="Hapus Data" data-plugin="tippy" data-tippy-animation="scale" data-tippy-duration="200"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="11">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="12">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
