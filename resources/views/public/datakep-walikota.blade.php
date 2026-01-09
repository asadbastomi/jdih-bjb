<?php
setlocale(LC_TIME, 'id_ID');
?>
<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny table-card">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th data-hide="phone" width="110"> Status </th>
                <th> Judul </th>
                <th data-hide="phone" width="166"> Tgl diundangkan </th>
                <th data-hide="phone" width="166"> SKPD Pemarkarsa </th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td><span class="badge label-table bg-success text-white">Berlaku</span></td>
                        <td>
                            <a href="{{ $row->url }}">
                                <strong>Nomor {{ $row->nomor }} Tahun {{ $row->tahun }}</strong><br />
                                {{ $row->judul }}
                            </a>
                        </td>
                        <td>{{ ($row->tanggal_diundangkan)? strftime("%d %B %Y", strtotime($row->tanggal_diundangkan)) : '' }} </td>
                        <td>{{ $row->skpd }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="8">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="9">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
