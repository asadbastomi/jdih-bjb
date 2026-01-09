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
            </tr>
        </thead>
        <tbody>
            @if ($data->count())
                @foreach ($data as $key => $row)
                    <tr>
                        <td class="fix"></td>
                        <td class="fix">{{ $data->firstItem() + $key }}</td>
                        <td class="fix">
                            @if (array_key_exists($row->id, $regubahcabut))
                                @php
                                    $hasCabut = false;
                                @endphp

                                @foreach ($regubahcabut[$row->id] as $key => $ucrow)
                                    @if ($ucrow['jenis'] == 'cabut')
                                        @php
                                            $hasCabut = true;
                                            break;
                                        @endphp
                                    @endif
                                @endforeach

                                @if ($hasCabut)
                                    <span class="badge label-table bg-danger text-white">Tidak Berlaku</span>
                                @else
                                    <span class="badge label-table bg-success text-white">Berlaku</span>
                                @endif
                            @else
                                <span class="badge label-table bg-success text-white">Berlaku</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ $row->url }}">
                                <strong>Nomor {{ $row->nomor }} Tahun {{ $row->tahun }}</strong><br />
                                {{ $row->judul }}
                            </a>
                            @php $temp = '' @endphp
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

                                    <span><a class='link_{{ $class }}' href='{{ $ucrow['url'] }}'>
                                            {{ $ucrow['nomor'] }}</a></span>

                                    @php $temp = $ucrow['jenis'] @endphp
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $row->tanggal_diundangkan ? strftime('%d %B %Y', strtotime($row->tanggal_diundangkan)) : '' }}
                        </td>
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
