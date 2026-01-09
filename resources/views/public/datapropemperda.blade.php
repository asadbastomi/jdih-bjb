<?php
setlocale(LC_TIME, 'id_ID');
?>
<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny table-card">
        <thead>
            <tr>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Nomor </th>
                <th> Raperda </th>
                <th data-hide="phone" width="174"> Tgl diundangkan </th>
                <th data-hide="phone" width="85"> Tahun </th>
                <th data-hide="phone" width="91"> Usulan </th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td>{{ $row->nomor }}</td>
                        <td>{{ $row->raperda }}</td>
                        <td>{{ ($row->tanggal_diundangkan)? strftime("%d %B %Y", strtotime($row->tanggal_diundangkan)) : '' }} </td>
                        <td>{{ $row->tahun }}</td>
                        <td>{{ $row->usulan }}</td>
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
                <td colspan="6">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
