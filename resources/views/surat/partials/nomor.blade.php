<div class="text-center mb-4">

    <div
        style="
            font-size:15pt;
            font-weight:bold;
            text-transform:uppercase;
            text-decoration:underline;
            margin-bottom:2px;
            line-height:1.2;
        ">

        {{ strtoupper($judul ?? 'SURAT KETERANGAN') }}

    </div>

    <div
    style="
        margin-top:0;
        font-size:13pt;
        line-height:1.2;
    ">

       Nomor :
{{ strtok($permohonan->nomor_surat, '/') }}
/<span style="display:inline-block;width:38px;"></span>/Bk-Sut

</div>

</div>