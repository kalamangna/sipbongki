<style>

@page{
    size:F4 portrait;
    margin:2cm 2cm 2cm 2.5cm;
}

*{
    box-sizing:border-box;
}

body,
.page,
.page *{
    font-family:"Times New Roman", Times, serif !important;
}

body{
    margin:0;
    padding:0;
    color:#000;
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
    font-family:"Times New Roman", Times, serif !important;
}

.kop table{
    width:100%;
    border-collapse:collapse;
}

.kop td{
    vertical-align:middle;
}

.kop-logo,
.logo{
    width:95px;
    text-align:center;
}

.kop-logo img,
.logo img{
    width:85px;
    height:auto;
    display:block;
    margin:0 auto;
}

.kop-header,
.header{
    text-align:center;
    font-family:"Times New Roman", Times, serif !important;
}

.kop-header h3,
.header h3{
    margin:0;
    font-family:"Times New Roman", Times, serif !important;
    font-size:13pt;
    font-weight:bold;
    line-height:1.25;
    letter-spacing:0.5px;
    text-transform:uppercase;
}

.kop-header h2,
.header h2{
    margin:2px 0;
    font-family:"Times New Roman", Times, serif !important;
    font-size:15pt;
    font-weight:bold;
    line-height:1.25;
    letter-spacing:1px;
    text-transform:uppercase;
}

.kop-header p,
.header p{
    margin:3px 0 0 0;
    font-family:"Times New Roman", Times, serif !important;
    font-size:9.5pt;
    font-style:italic;
    line-height:1.3;
}

.kop-spacer{
    width:95px;
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

table td{
    vertical-align:top;
}

.kop td{
    vertical-align:middle;
}

.no-border{
    border-collapse:collapse;
}

.no-border td{
    vertical-align:top;
    padding:2px 0;
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
    line-height:1.25;
    margin-bottom:70px;
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
    display:flex;
    gap:8px;
    align-items:center;
}

.preview-action a,
.preview-action button{
    padding:10px 18px;
    border-radius:12px;
    font-family:'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:6px;
    transition:all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.preview-action a:active,
.preview-action button:active{
    transform:scale(0.96);
}

.btn-kembali{
    background:#ffffff;
    color:#334155;
    border:1px solid #cbd5e1;
    box-shadow:0 1px 3px rgba(0,0,0,0.08);
}

.btn-kembali:hover{
    background:#f8fafc;
    color:#0f172a;
    border-color:#94a3b8;
    box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);
    transform:translateY(-1px);
}

.btn-cetak{
    background:#059669;
    color:#ffffff;
    border:1px solid transparent;
    box-shadow:0 4px 10px rgba(5,150,105,0.25);
}

.btn-cetak:hover{
    background:#047857;
    box-shadow:0 6px 14px rgba(5,150,105,0.35);
    transform:translateY(-1px);
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
