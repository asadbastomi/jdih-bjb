<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Icon </th>
                <th> Nama Tema </th>
                <th> Deskripsi </th>
                <th> Warna </th>
                <th> Status </th>
                <th> Jumlah Peraturan </th>
                <th class="fix" data-sort-ignore="true"> Aksi </th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td>
                            @if ($row->icon)
                                <i class="mdi {{ $row->icon }} fs-2" style="color: {{ $row->warna ?? '#0acf97' }}"></i>
                            @else
                                <i class="mdi mdi-tag-outline fs-2" style="color: #ccc"></i>
                            @endif
                        </td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ Str::limit($row->deskripsi, 100) ?? '-' }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $row->warna ?? '#0acf97' }}; color: white;">
                                {{ $row->warna ?? '#0acf97' }}
                            </span>
                        </td>
                        <td>
                            @if ($row->status == 'aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $row->regulasi_count ?? 0 }}</span>
                        </td>
                        <td class="fix">
                            <div data-id="{{ $row->id }}">
                                <button type="button" class="btn btn-sm btn-icon waves-effect waves-light btneditdata"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                    <i class="mdi mdi-pencil-outline"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-icon waves-effect waves-light btndeletedata"
                                    data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                    <i class="mdi mdi-delete-outline"></i>
                                </button>
                            </div>
                        </td>
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
                <td colspan="9">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>