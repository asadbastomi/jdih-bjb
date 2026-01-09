<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Judul </th>
                <th class="fix" data-sort-ignore="true"></th>
            </tr>
        </thead>
        <tbody>
            @if ($halaman->count())
                @foreach ($halaman as $key => $h)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $halaman->firstItem() + $key }}</td>
                        <td>{{ $h->judul }}</td>
                        <td class="fix">
                            <div class="data-store button-list" data-id="{{ $h->id }}">
                                <button type="button" class="btn btn-xs btn-success waves-effect waves-light btneditdata"><i class="mdi mdi-pencil-outline"></i></button>
                                {{-- <button type="button" class="btn btn-xs btn-danger waves-effect waves-light btndeletedata"><i class="mdi mdi-trash-can-outline"></i></button> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="4">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="4">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $halaman])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
