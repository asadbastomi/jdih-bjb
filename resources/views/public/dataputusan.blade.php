<?php
setlocale(LC_TIME, 'id_ID');
?>
<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny table-card">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th data-hide="phone" width="150"> Tipe Dokumen </th>
                <th> Judul / Nomor Putusan </th>
                <th data-hide="phone" width="166"> Tanggal Dibacakan </th>
                <th data-hide="phone" width="110"> Status </th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td>{{ $row->tipe_dokumen ?? '-' }}</td>
                        <td>
                            <a href="{{ $row->url }}">
                                <strong>{{ $row->nomor_putusan ?? 'Nomor Putusan' }}</strong><br />
                                {{ $row->judul }}
                            </a>
                        </td>
                        <td>
                            {{ $row->tanggal_putusan ? strftime('%d %B %Y', strtotime($row->tanggal_putusan)) : '' }}
                        </td>
                        <td><span class="badge label-table bg-success text-white">{{ $row->status_hukum ?? 'Berlaku' }}</span></td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="12">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="14">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
