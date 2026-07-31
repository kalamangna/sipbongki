@php
    $nama = $penandatangan->nama_lengkap;

    if (str_contains($nama, ',')) {
        [$namaOrang, $gelar] = explode(',', $nama, 2);
        $namaPejabat = mb_strtoupper(trim($namaOrang), 'UTF-8') . ', ' . trim($gelar);
    } else {
        $namaPejabat = mb_strtoupper($nama, 'UTF-8');
    }
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
        <td>{{ $penandatangan->nip ?? '-' }}</td>
    </tr>

    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $penandatangan->jabatan->nama ?? '-' }}</td>
    </tr>

</table>