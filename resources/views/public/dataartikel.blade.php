<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 table-card">
        <thead>
            <tr>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Tipe Dokumen </th>
                <th> Nomor </th>
                <th> Judul </th>
                <th> Tahun </th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td>{{ $row->tipe_dokumen ?? '-' }}</td>
                        <td>{{ $row->nomor ?? '-' }}</td>
                        <td>
                            <a href="{{ route('artikel.detail', ['id' => $row->id, 'slug' => Str::slug($row->judul)]) }}" class="text-primary">
                                {{ $row->judul }}
                            </a>
                        </td>
                        <td>{{ $row->tahun }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td colspan="5">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="5">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
