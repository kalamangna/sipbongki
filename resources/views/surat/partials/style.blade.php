<style>

@page{
    size:F4 portrait;
    margin:2cm 2cm 2cm 2.5cm;
}

*{
    box-sizing:border-box;
}

body{

    margin:0;
    padding:0;

    color:#000;

    font-family:"Times New Roman", Times, serif;

    font-size:12pt;

    line-height:1.5;

}

.page{

    width:100%;

}

/* ===========================
   KOP SURAT
=========================== */

.kop{

    width:100%;

    margin-bottom:8px;

    padding-bottom:6px;

    border-bottom:3px double #000;

}

.kop table{

    width:100%;

    border-collapse:collapse;

}

.kop td{

    vertical-align:middle;

}

.logo{

    width:70px;

    text-align:center;

}

.logo img{

    width:70px;

    height:auto;

}

.header{

    text-align:center;

}

.header h5{

    margin:0;

    font-size:10pt;

    font-weight:bold;

}

.header h4{

    margin:1px 0;

    font-size:14pt;

    font-weight:bold;

}

.header h3{

    margin:2px 0;

    font-size:16pt;

    font-weight:bold;

    letter-spacing:.5px;

}

.header p{

    margin:0;

    font-size:10pt;

    text-align:center;

}

/* ===========================
   JUDUL
=========================== */

.judul-surat{

    margin-top:9px;

    text-align:center;

}

.judul-surat h3{

    margin:0;

    font-size:13pt;

    text-transform:uppercase;

    text-decoration:underline;

}

.nomor{

    margin-top:0px;

    font-size:12pt;

}

/* ===========================
   ISI
=========================== */

.paragraf{

    margin-top:20px;

    text-align:justify;

    text-indent:40px;

}

.table-identitas{

    width:100%;

    margin-top:6px;

    margin-bottom:6px;

    border-collapse:collapse;

}

.table-identitas td{

    padding:2px 4px;

    vertical-align:top;

}

.table-identitas td:nth-child(1){

    width:185px;

}

.table-identitas td:nth-child(2){

    width:18px;

}

.penutup{

    margin-top:10px;

    text-align:justify;

    text-indent:40px;

}

/* ===========================
   TANDA TANGAN
=========================== */

.ttd{

    width:310px;

    margin-left:auto;

    margin-top:20px;

    text-align:center;

}

.ttd .tanggal{

    margin-bottom:2px;

}

.ttd .jabatan{

    font-weight:bold;

    margin-bottom:75px;

}

.ttd .nama{

    font-weight:bold;

    text-decoration:underline;

    text-transform:uppercase;

}

.ttd .nip{

    margin-top:0px;

}

/* ===========================
   FOOTER
=========================== */

.footer{

    margin-top:40px;

    text-align:center;

    font-size:10pt;

}
/* ===========================
   PREVIEW CONTROL
=========================== */

.preview-action{

    position:fixed;

    top:20px;

    right:30px;

    z-index:999;

}


.preview-action a,
.preview-action button{

    padding:8px 14px;

    margin-left:5px;

    border-radius:5px;

    border:none;

    font-family:Arial, sans-serif;

    font-size:14px;

    cursor:pointer;

    text-decoration:none;

}


.btn-kembali{

    background:#6c757d;

    color:white;

}


.btn-cetak{

    background:#0d6efd;

    color:white;

}



/* Tampilan layar */

@media screen {


    body{

        background:#ddd;

    }


    .page{

        width:215.9mm;

        min-height:330.2mm;

        margin:30px auto;

        background:white;

        padding:2cm 2cm 2cm 2.5cm;

        box-shadow:0 0 8px rgba(0,0,0,.25);

    }

}



/* Saat print */

@media print {


    .preview-action{

        display:none;

    }


    body{

        background:white;

    }


    .page{

        margin:0;

        box-shadow:none;

    }


}
</style>
