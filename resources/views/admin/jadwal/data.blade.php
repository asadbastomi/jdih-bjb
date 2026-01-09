<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Judul </th>
                <th> Waktu </th>
                <th data-hide="phone"> Tempat </th>
                <th data-hide="phone"> Penyelenggara </th>
                <th class="fix" data-sort-ignore="true"></th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td>{{ $row->judul }}</td>
                        <td>{{ strftime('%d %B %Y', strtotime($row->waktu)) . ' Jam ' . strftime('%H:%M', strtotime($row->waktu)) }}
                        </td>
                        <td>{{ $row->tempat }}</td>
                        <td>{{ $row->penyelenggara }}</td>
                        <td class="fix">
                            <div class="data-store button-list" data-id="{{ $row->id }}">
                                <button type="button"
                                    class="btn btn-xs btn-success waves-effect waves-light btneditdata"><i
                                        class="mdi mdi-pencil-outline"></i></button>
                                <button type="button"
                                    class="btn btn-xs btn-danger waves-effect waves-light btndeletedata"><i
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
