<?php
setlocale(LC_TIME, 'id_ID');
?>
<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Judul </th>
                <th data-hide="phone"> Tgl diundangkan </th>
                <th data-hide="all"> File </th>
                <th data-hide="all"> Abstrak </th>
                <th data-hide="all"> Keterangan </th>
                <th class="fix" data-sort-ignore="true"></th>
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
            @foreach ($data as $key => $row)
            <tr>
                <td class="fix"></td>
                <td class="fix">{{ $data->firstItem() + $key }}</td>
                <td>
                    {{ $row->nomor_peraturan . ' Tahun ' . $row->tahun }} <br /> {{ $row->judul }}
                    @php ($temp = '') @endphp
                    @if (array_key_exists($row->id, $regubahcabut))
                    @foreach ($regubahcabut[$row->id] as $key => $ucrow)
                    @if ($temp != $ucrow['jenis'])
                    <br>
                    <span style="font-weight:bold;width: 75px;display: inline-block;">
                        {{ substr($ucrow['jenis'], 0, 2) == 'me' ? $ucrow['jenis'] : 'di' . $ucrow['jenis'] }}
                    </span>
                    @else
                    {{ ',' }}
                    @endif

                    @php
                    $class = '';
                    if ($ucrow['jenis'] == 'mengubah') {
                    $class = 'ubah';
                    } elseif ($ucrow['jenis'] == 'mencabut') {
                    $class = 'cabut';
                    } else {
                    $class = $ucrow['jenis'];
                    }
                    @endphp

                    <span>
                        <a class='link_{{ $class }}' data-id="{{ $ucrow['id_text'] }}" href='javascript:void(0);'>
                            {{ $ucrow['nomor'] }}
                        </a>
                    </span>

                    @php $temp = $ucrow['jenis'] @endphp
                    @endforeach
                    @endif
                </td>
                <td style="white-space: nowrap">
                    {{ $row->tanggal_diundangkan ? strftime('%d %B %Y', strtotime($row->tanggal_diundangkan)) : '' }}
                </td>
                <td>
                    @if ($row->file)
                    @php
                    $fileurl = explode(';', $row->file);
                    @endphp
                    @foreach ($fileurl as $key => $value)
                    <a type="button" class="btn btn-info btn-sm waves-effect waves-light mb-1"
                        href="{{ '/upload/perwal/' . $row->tahun . '/' . $value }}" target="_blank">
                        <span class="btn-label"><i class="mdi mdi-cloud-download-outline"></i></span>
                        {{ str_replace('_', ' ', $value) }}
                    </a>
                    @endforeach
                    @endif
                </td>
                <td>
                    @if ($row->abstrak)
                    @php
                    $fileurl = explode(';', $row->abstrak);
                    @endphp
                    @foreach ($fileurl as $key => $value)
                    <a type="button" class="btn btn-success btn-sm waves-effect waves-light mb-1"
                        href="{{ '/upload/abstrak/perwal/' . $row->tahun . '/' . $value }}" target="_blank">
                        <span class="btn-label"><i class="mdi mdi-cloud-download-outline"></i></span>
                        {{ str_replace('_', ' ', $value) }}
                    </a>
                    @endforeach
                    @endif
                </td>
                <td>{{ $row->keterangan }}</td>
                <td class="fix">
                    <div class="data-store button-list" data-id="{{ $row->id }}">
                        <button type="button" class="btn btn-xs btn-warning waves-effect waves-light btneditubahcabut"
                            title="Ubah Cabut Regulasi" data-plugin="tippy" data-tippy-animation="scale"
                            data-tippy-duration="200"><i class="mdi mdi-tooltip-edit"></i></button>
                        <button type="button" class="btn btn-xs btn-success waves-effect waves-light btneditdata"
                            title="Edit Data" data-plugin="tippy" data-tippy-animation="scale"
                            data-tippy-duration="200"><i class="mdi mdi-pencil-outline"></i></button>
                        <button type="button" class="btn btn-xs btn-danger waves-effect waves-light btndeletedata"
                            title="Hapus Data" data-plugin="tippy" data-tippy-animation="scale"
                            data-tippy-duration="200"><i class="mdi mdi-trash-can-outline"></i></button>
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
                <td colspan="8">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
