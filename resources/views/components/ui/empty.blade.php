@props([
    'colspan' => 1,
    'message' => 'Belum ada data.'
])

<tr>

    <td
        colspan="{{ $colspan }}"
        class="text-center py-5 text-muted">

        <i class="bi bi-inbox fs-1 d-block mb-3"></i>

        {{ $message }}

    </td>

</tr>