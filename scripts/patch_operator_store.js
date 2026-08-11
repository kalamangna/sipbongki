import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const filePath = path.resolve(__dirname, '..', 'app', 'Http', 'Controllers', 'Operator', 'PermohonanSuratController.php');
let content = fs.readFileSync(filePath, 'utf8');
const start = content.indexOf('public function store(Request $request)');
const end = content.indexOf('public function show(', start);
if (start === -1 || end === -1) {
  console.error('Could not find store function boundaries');
  process.exit(1);
}
const replacement = `public function store(Request $request)
    {
        $validated = $request->validate([
            'penduduk_id'        => 'nullable|exists:penduduks,id',
            'jenis_surat_id'     => 'required|exists:jenis_surats,id',
            'penandatangan_id'   => 'required|exists:perangkats,id',
            'tanggal_permohonan' => 'required|date',
            'keperluan'          => 'required|string|max:1000',
            'catatan'            => 'nullable|string',
        ]);

        $jenisSurat = JenisSurat::findOrFail(
            $request->jenis_surat_id
        );

        $dataSurat = [];

        switch (strtoupper($jenisSurat->kode)) {
            case 'USAHA':
                $request->validate([
                    'nama_usaha'   => 'required|string|max:150',
                    'jenis_usaha'  => 'required|string|max:150',
                    'alamat_usaha' => 'nullable|string|max:255',
                    'lama_usaha'   => 'nullable|string|max:100',
                ]);

                $dataSurat = [
                    'nama_usaha'   => $request->nama_usaha,
                    'jenis_usaha'  => $request->jenis_usaha,
                    'alamat_usaha' => $request->alamat_usaha,
                    'lama_usaha'   => $request->lama_usaha,
                ];
                break;

            case 'KEMATIAN':
                $request->validate([
                    'almarhum_id'        => 'required|exists:penduduks,id',
                    'pelapor_id'         => 'required|exists:penduduks,id',
                    'hari_meninggal'     => 'required|string|max:30',
                    'tanggal_meninggal'  => 'required|date',
                    'jam_meninggal'      => 'nullable',
                    'tempat_meninggal'   => 'required|string|max:150',
                    'penyebab_kematian'  => 'required|string|max:255',
                    'hubungan_pelapor'   => 'required|string|max:100',
                ]);

                $validated['penduduk_id'] = $request->almarhum_id;
                $validated['pelapor_id'] = $request->pelapor_id;

                $dataSurat = [
                    'hari_meninggal'     => $request->hari_meninggal,
                    'tanggal_meninggal'  => $request->tanggal_meninggal,
                    'jam_meninggal'      => $request->jam_meninggal,
                    'tempat_meninggal'   => $request->tempat_meninggal,
                    'penyebab_kematian'  => $request->penyebab_kematian,
                    'hubungan_pelapor'   => $request->hubungan_pelapor,
                ];
                break;

            case 'ORANG-SAMA':
                $request->validate([
                    'nama_lain'            => 'required|string|max:150',
                    'jenis_dokumen'        => 'required|string|max:150',
                    'nomor_dokumen'        => 'required|string|max:100',
                    'keterangan_perbedaan' => 'nullable|string|max:500',
                ]);

                $dataSurat = [
                    'nama_lain'            => $request->nama_lain,
                    'jenis_dokumen'        => $request->jenis_dokumen,
                    'nomor_dokumen'        => $request->nomor_dokumen,
                    'keterangan_perbedaan' => $request->keterangan_perbedaan,
                ];
                break;
        }

        $validated['nomor_permohonan'] = 'PMH-' . now()->format('YmdHis');
        $validated['status'] = 'Menunggu';
        $validated['data_surat'] = $dataSurat;

        if (!$validated['penduduk_id']) {
            return back()
                ->withInput()
                ->withErrors([
                    'penduduk_id' => 'Penduduk belum dipilih.'
                ]);
        }

        PermohonanSurat::create(
            $validated
        );

        return redirect()
            ->route(
                'operator.permohonan-surat.index'
            )
            ->with(
                'success',
                'Permohonan surat berhasil dibuat.'
            );
    }
`;
const before = content.slice(0, start);
const after = content.slice(end);
fs.writeFileSync(filePath, before + replacement + after, 'utf8');
console.log('patched');
