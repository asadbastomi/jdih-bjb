<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny" data-sorting="false">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Nama </th>
                <th data-hide="phone"> Email </th>
                <th data-hide="phone"> Username </th>
                <th data-hide="all"> Role </th>
                <th class="fix" data-sort-ignore="true"></th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count())
                @foreach ($users as $key => $user)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $users->firstItem() + $key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @php
                                $role = explode(',', $user->role);
                            @endphp
                            @foreach ($role as $key => $value)
                                <span class="badge badge-outline-primary">{{$value}}</span>
                            @endforeach
                        </td>
                        <td class="fix">
                            <div class="data-store button-list" data-id="{{ $user->id }}">
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
                <td colspan="6">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $users])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
