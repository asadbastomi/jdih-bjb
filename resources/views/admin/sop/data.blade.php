<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Nama SOP </th>
                <th> Deskripsi SOP </th>
                <th> File SOP </th>
                <th class="fix" data-sort-ignore="true"></th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->deskripsi ?? '-' }}</td>
                        <td>
                            <a type="button" class="btn btn-info btn-sm waves-effect waves-light mb-1"
                                href="/storage{{$row->file_path}}" target="_blank">
                                <span class="btn-label"><i class="mdi mdi-cloud-download-outline"></i></span>
                                Download File SOP
                            </a>
                        </td>
                        <td class="fix">
                            <div class="data-store button-list" data-id="{{ $row->id }}">
                                <button type="button" class="btn btn-xs btn-success waves-effect waves-light btneditdata"><i
                                        class="mdi mdi-pencil-outline"></i></button>
                                <button type="button" class="btn btn-xs btn-danger waves-effect waves-light btndeletedata"><i
                                        class="mdi mdi-trash-can-outline"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="7">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="7">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
