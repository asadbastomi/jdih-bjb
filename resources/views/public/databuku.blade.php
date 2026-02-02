<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny table-card">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Tipe Dokumen </th>
                <th> Judul </th>
                <th data-hide="phone"> Penulis Badan </th>
                <th data-hide="all"> Penerbit </th>
                <th data-hide="phone" width="132"> Tahun Terbit </th>
                <th data-hide="phone" width="91"> Jumlah </th>
                <th data-hide="all"> Keterangan </th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td><span class="badge badge-info">{{ $row->tipe_dokumen ?? 'Monografi' }}</span></td>
                        <td><a href="{{ $row->url_detail }}" class="text-primary">{{ $row->judul }}</a></td>
                        <td>{{ $row->teu_orang_badan }}</td>
                        <td>{{ $row->penerbit }}</td>
                        <td>{{ $row->tahun_terbit }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td>{{ $row->keterangan }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="9">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="10">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
