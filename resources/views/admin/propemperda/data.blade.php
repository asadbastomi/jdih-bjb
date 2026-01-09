<?php
setlocale(LC_TIME, 'id_ID');
?>
<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Nomor </th>
                <th> Raperda </th>
                <th data-hide="phone"> Tgl diundangkan </th>
                <th data-hide="phone"> Tahun </th>
                <th data-hide="phone"> Usulan </th>
                <th class="fix" data-sort-ignore="true"></th>
            </tr>
        </thead>
        <tbody>
            @if ($propemperda->count())
                @foreach ($propemperda as $key => $p)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $propemperda->firstItem() + $key }}</td>
                        <td>{{ $p->nomor }}</td>
                        <td>
                            {{ $p->raperda }}
                            @php ($temp='') @endphp
                            @if (array_key_exists($p->id, $propubahcabut))
                                @foreach ($propubahcabut[$p->id] as $key => $ucrow)
                                    @if ($temp!=$ucrow['jenis'])
                                        <br>
                                        <span style="font-weight:bold;width: 75px;display: inline-block;">
                                            {{ (substr($ucrow['jenis'],0,2)=="me")? $ucrow['jenis']:"di".$ucrow['jenis'] }}
                                        </span>
                                    @else
                                        {{ ',' }}
                                    @endif

                                    @php
                                        $class='';
                                        if ($ucrow['jenis']=='mengubah') {
                                            $class = "ubah";
                                        } elseif ($ucrow['jenis']=='mencabut') {
                                            $class = "cabut";
                                        } else {
                                            $class = $ucrow['jenis'];
                                        }
                                    @endphp

                                    <span><a class='link_{{ $class }}' href='javascript:void(0);'> {{ $ucrow['nomor'] }}</a></span>

                                    @php ($temp=$ucrow['jenis']) @endphp
                                @endforeach
                            @endif
                        </td>
                        <td>{{ ($p->tanggal_diundangkan)? strftime("%d %B %Y", strtotime($p->tanggal_diundangkan)) : '' }} </td>
                        <td>{{ $p->tahun }}</td>
                        <td>{{ $p->usulan }}</td>
                        <td class="fix">
                            <div class="data-store button-list" data-id="{{ $p->id }}">
                                <button type="button" class="btn btn-xs btn-success waves-effect waves-light btneditdata"><i class="mdi mdi-pencil-outline"></i></button>
                                <button type="button" class="btn btn-xs btn-danger waves-effect waves-light btndeletedata"><i class="mdi mdi-trash-can-outline"></i></button>
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
                        @include('layouts.shared.paginate', ['paginator' => $propemperda])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
