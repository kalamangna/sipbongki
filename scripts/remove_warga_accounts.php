<?php

// Skrip ini dipanggil manual: php scripts/remove_warga_accounts.php
// - Membuat backup CSV dari users dengan role 'warga'
// - Menampilkan jumlah akun yang akan dihapus
// - Meminta konfirmasi melalui stdin
// - Jika dikonfirmasi, menghapus akun tersebut

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

$users = User::where('role', 'warga')->get();
$count = $users->count();

if ($count === 0) {
    echo "Tidak ditemukan akun dengan role 'warga'.\n";
    exit(0);
}

// Pastikan folder backup ada
$backupDir = __DIR__ . '/../storage/backups';
if (!file_exists($backupDir)) {
    mkdir($backupDir, 0755, true);
}

$filename = $backupDir . '/users-warga-' . date('YmdHis') . '.csv';
$fp = fopen($filename, 'w');

fputcsv($fp, ['id','name','email','role','penduduk_id','created_at','updated_at']);

foreach ($users as $u) {
    fputcsv($fp, [
        $u->id,
        $u->name,
        $u->email,
        $u->role,
        $u->penduduk_id,
        $u->created_at,
        $u->updated_at,
    ]);
}

fclose($fp);

echo "Backup $count akun warga dibuat: $filename\n";

echo "Apakah Anda yakin ingin menghapus semua akun warga dari tabel users? (ketik YA untuk konfirmasi): ";
$handle = fopen('php://stdin', 'r');
$line = fgets($handle);
$confirm = trim($line);
if (strtoupper($confirm) !== 'YA') {
    echo "Dibatalkan oleh pengguna. Tidak ada akun yang dihapus.\n";
    exit(0);
}

// Hapus akun warga
User::where('role', 'warga')->delete();

echo "Selesai. $count akun warga telah dihapus dari tabel users.\n";
echo "Jika perlu, Anda dapat memulihkan data dari: $filename\n";

exit(0);
