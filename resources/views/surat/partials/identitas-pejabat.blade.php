@php
    $nama = $penandatangan->nama_lengkap ?? '-';

    if ($nama !== '-' && str_contains($nama, ',')) {
        [$namaOrang, $gelar] = explode(',', $nama, 2);
        $namaPejabat = mb_strtoupper(trim($namaOrang), 'UTF-8') . ', ' . trim($gelar);
    } else {
        $namaPejabat = mb_strtoupper($nama, 'UTF-8');
    }

    $nip = $penandatangan->nip ?? '-';
    $jabatan = $penandatangan->jabatan->nama ?? '-';
@endphp
<p>
    Yang bertanda tangan di bawah ini :
</p>

<table class="table-identitas" style="margin-left:35px; margin-bottom:6px;">

    <tr>
    <td width="180">Nama</td>
    <td width="20">:</td>
    <td><strong>{{ $namaPejabat }}</strong></td>
    </tr>

    <tr>
        <td>NIP</td>
        <td>:</td>
        <td>{{ $nip }}</td>
    </tr>

    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $jabatan }}</td>
    </tr>

</table>