<div class="row g-4">


<div class="col-md-6">


<label class="form-label fw-semibold">

Pemohon

</label>



<select name="penduduk_id"
class="form-select"
required>


<option value="">

Pilih Penduduk

</option>



@foreach($penduduk as $item)


<option value="{{ $item->id }}"
{{ old('penduduk_id') == $item->id ? 'selected':'' }}>


{{ $item->nama_lengkap }}

-

{{ $item->nik }}


</option>


@endforeach



</select>


</div>





<div class="col-md-6">


<label class="form-label fw-semibold">

Jenis Surat

</label>



<select name="jenis_surat_id"
class="form-select"
required>


<option value="">

Pilih Jenis Surat

</option>



@foreach($jenisSurat as $item)


<option value="{{ $item->id }}"
{{ old('jenis_surat_id') == $item->id ? 'selected':'' }}>


{{ $item->nama }}


</option>


@endforeach



</select>


</div>





<div class="col-md-12">


<label class="form-label fw-semibold">

Keperluan

</label>



<textarea
name="keperluan"
rows="4"
class="form-control"
placeholder="Tuliskan keperluan surat">{{ old('keperluan') }}</textarea>


</div>


</div>