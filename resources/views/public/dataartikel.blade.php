<div class="fixed-table-container">
    <table id="table-main" class="table table-colored mb-0 toggle-arrow-tiny">
        <thead>
            <tr>
                <th class="toogle" data-sort-ignore="true"></th>
                <th class="fix" data-sort-ignore="true"> No </th>
                <th> Tipe Dokumen </th>
                <th> Nomor </th>
                <th> Judul </th>
                <th> Tahun </th>
                <th data-hide="all"> Jenis Peraturan </th>
                <th data-hide="all"> Tempat Penetapan </th>
                <th data-hide="all"> Tgl Penetapan </th>
                <th data-hide="all"> Tgl Diundangkan </th>
                <th data-hide="all"> T.E.U. Badan </th>
                <th data-hide="all"> Sumber </th>
                <th data-hide="all"> Bahasa </th>
                <th data-hide="all"> Lokasi </th>
                <th data-hide="all"> Status Peraturan </th>
                <th data-hide="all"> Subjek </th>
                <th data-hide="all"> Bidang Hukum </th>
                <th data-hide="all"> Abstrak </th>
                <th data-hide="all"> File </th>
                <th data-hide="all"> Lampiran </th>
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
                        <td>{{ $row->tipe_dokumen ?? '-' }}</td>
                        <td>{{ $row->nomor ?? '-' }}</td>
                        <td>{{ $row->judul }}</td>
                        <td>{{ $row->tahun }}</td>
                        <td>{{ $row->jenis_peraturan ?? '-' }}</td>
                        <td>{{ $row->tempat_penetapan ?? $row->tempat ?? '-' }}</td>
                        <td>{{ $row->tanggal_penetapan ? \Carbon\Carbon::parse($row->tanggal_penetapan)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $row->tanggal_diundangkan ? \Carbon\Carbon::parse($row->tanggal_diundangkan)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $row->teu_badan ?? '-' }}</td>
                        <td>{{ $row->sumber }}</td>
                        <td>{{ $row->bahasa }}</td>
                        <td>{{ $row->lokasi ?? '-' }}</td>
                        <td>{{ $row->status_peraturan ?? '-' }}</td>
                        <td>{{ $row->subjek }}</td>
                        <td>{{ $row->bidang_hukum }}</td>
                        <td>
                            @if ($row->abstrak)
                                @php
                                    $fileurl = explode(';', $row->abstrak);
                                @endphp
                                @foreach ($fileurl as $key => $value)
                                    <a type="button" class="btn btn-success btn-sm waves-effect waves-light mb-1"
                                        href="{{ '/upload/artikel/' . $value }}" target="_blank">
                                        <span class="btn-label"><i class="mdi mdi-cloud-download-outline"></i></span>
                                        {{ str_replace('_', ' ', $value) }}
                                    </a>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if ($row->file)
                                @php
                                    $fileurl = explode(';', $row->file);
                                @endphp
                                @foreach ($fileurl as $key => $value)
                                    <a type="button" class="btn btn-info btn-sm waves-effect waves-light mb-1"
                                        href="{{ '/upload/artikel/' . $value }}" target="_blank">
                                        <span class="btn-label"><i class="mdi mdi-cloud-download-outline"></i></span>
                                        {{ str_replace('_', ' ', $value) }}
                                    </a>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if ($row->lampiran)
                                @php
                                    $lampiranurl = explode(';', $row->lampiran);
                                @endphp
                                @foreach ($lampiranurl as $key => $value)
                                    <a type="button" class="btn btn-warning btn-sm waves-effect waves-light mb-1"
                                        href="{{ '/upload/lampiran/artikel/' . $value }}" target="_blank">
                                        <span class="btn-label"><i class="mdi mdi-cloud-download-outline"></i></span>
                                        {{ str_replace('_', ' ', $value) }}
                                    </a>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $row->keterangan }}</td>
                    </tr>
                @endforeach
            @else
                <tr class="empty">
                    <td></td>
                    <td colspan="22">Data is empty</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="active">
                <td colspan="23">
                    <div class="text-right">
                        @include('layouts.shared.paginate', ['paginator' => $data])
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
