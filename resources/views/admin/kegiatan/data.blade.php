<?php
setlocale(LC_TIME, 'id_ID');
?>
<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th style="width:200px"> Tanggal </th>
                <th> Judul </th>
                <th class="fix" data-sort-ignore="true"></th>
            </tr>
        </thead>
        <tbody>
            @if ($kegiatan->count())
                @foreach ($kegiatan as $key => $k)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $kegiatan->firstItem() + $key }}</td>
                        <td>{{ strftime("%d %B %Y", strtotime($k->tanggal)) }}</td>
                        <td>{{ $k->judul }}</td>
                        <td class="fix">
                            <div class="data-store button-list" data-id="{{ $k->id }}">
                                <button type="button" class="btn btn-xs btn-success waves-effect waves-light btneditdata"><i class="mdi mdi-pencil-outline"></i></button>
                                <button type="button" class="btn btn-xs btn-danger waves-effect waves-light btndeletedata"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="5">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="5">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $kegiatan])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
