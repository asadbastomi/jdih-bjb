<?php
setlocale(LC_TIME, 'id_ID');
?>
<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Tahun </th>
                <th> Tempat </th>
                <th> Judul </th>
                <th> T.E.U Badan </th>
                <th> Sumber </th>
                <th> Bahasa </th>
                <th data-hide="all"> Subjek </th>
                <th data-hide="all"> Lokasi </th>
                <th data-hide="all"> Bidang Hukum </th>
                <th data-hide="all"> Abstrak </th>
                <th data-hide="all"> File </th>
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
                        <td>{{ $row->tahun }}</td>
                        <td>{{ $row->tempat }}</td>
                        <td>{{ $row->judul }}</td>
                        <td>{{ $row->teu_badan }}</td>
                        <td>{{ $row->sumber }}</td>
                        <td>{{ $row->bahasa }}</td>
                        <td>{{ $row->subjek }}</td>
                        <td>{{ $row->lokasi }}</td>
                        <td>{{ $row->bidang_hukum }}</td>
                        <td>
                            @if ($row->abstrak)
                                @php
                                    $fileurl = explode(';', $row->abstrak);
                                @endphp
                                @foreach ($fileurl as $key => $value)
                                    <a type="button" class="btn btn-success btn-sm waves-effect waves-light mb-1"
                                        href="{{ '/upload/artikel/' . $value }}" target="_blank">
                                        <span class="btn-label"><i class="mdi mdi-cloud-download-outline"></i></span>
                                        {{ str_replace('_', ' ', $value) }}
                                    </a>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if ($row->file)
                                @php
                                    $fileurl = explode(';', $row->file);
                                @endphp
                                @foreach ($fileurl as $key => $value)
                                    <a type="button" class="btn btn-info btn-sm waves-effect waves-light mb-1"
                                        href="{{ '/upload/artikel/' . $value }}" target="_blank">
                                        <span class="btn-label"><i class="mdi mdi-cloud-download-outline"></i></span>
                                        {{ str_replace('_', ' ', $value) }}
                                    </a>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $row->keterangan }}</td>
                        <td class="fix">
                            <div class="data-store button-list" data-id="{{ $row->id }}">
                                <button type="button"
                                    class="btn btn-xs btn-success waves-effect waves-light btneditdata"
                                    title="Edit Data" data-plugin="tippy" data-tippy-animation="scale"
                                    data-tippy-duration="200"><i class="mdi mdi-pencil-outline"></i></button>
                                <button type="button"
                                    class="btn btn-xs btn-danger waves-effect waves-light btndeletedata"
                                    title="Hapus Data" data-plugin="tippy" data-tippy-animation="scale"
                                    data-tippy-duration="200"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="14">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="15">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
