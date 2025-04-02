<!DOCTYPE html>
<html>
<head>
    <title>Data Tim {{ $team->nama }}</title>
    <script></script>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Data Tim: {{ $team->nama }}</h2>
    <p>Kategori: {{ $team->kategori }}</p>

    <h3>Kontak</h3>
    <table>
        <tr><th>Role</th><th>Nama</th><th>No WA</th></tr>
        @foreach ($team->contacts as $contact)
        <tr>
            <td>{{ ucfirst($contact->role) }}</td>
            <td>{{ $contact->nama }}</td>
            <td>{{ $contact->no_wa }}</td>
        </tr>
        @endforeach
    </table>

    <h3>Data Pemain</h3>
    <table>
        <tr><th>Nama</th><th>Pas Foto</th><th>Foto Kartu Pelajar</th></tr>
        @foreach ($team->players as $player)
        <tr>
            <td>{{ $player->nama }}</td>
            <td><img src="{{ public_path('storage/'.$player->pas_foto) }}" width="200"></td>
            <td><img src="{{ public_path('storage/'.$player->foto_kartu) }}" width="200"></td>
        </tr>
        @endforeach
    </table>

    <h3>Data Official</h3>
    <table>
        <tr><th>Nama</th><th>Pas Foto</th><th>Foto KTP</th></tr>
        @foreach ($team->officials as $official)
        <tr>
            <td>{{ $official->nama }}</td>
            <td><img src="{{ public_path('storage/'.$official->pas_foto) }}" width="200"></td>
            <td><img src="{{ public_path('storage/'.$official->foto_ktp) }}" width="200"></td>
        </tr>
        @endforeach
    </table>

    <h3 class="text-lg font-semibold mb-4">Dokumen Tambahan</h3>
    <ul class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <li class="text-center">
            <p class="font-medium">Foto Tim</p>
            <img class="block mx-auto rounded-lg shadow-md mt-2" src="{{ public_path('storage/'.$team->document->foto_tim_berjersey) }}" width="200">
        </li>
        <li class="text-center">
            <p class="font-medium">Jersey Pemain</p>
            <img class="block mx-auto rounded-lg shadow-md mt-2" src="{{ public_path('storage/'.$team->document->foto_jersey_pemain) }}" width="200">
        </li>
        <li class="text-center">
            <p class="font-medium">Jersey Kiper</p>
            <img class="block mx-auto rounded-lg shadow-md mt-2" src="{{ public_path('storage/'.$team->document->foto_jersey_kiper) }}" width="200">
        </li>
        <li class="text-center">
            <p class="font-medium">Bukti Pembayaran</p>
            <img class="block mx-auto rounded-lg shadow-md mt-2" src="{{ public_path('storage/'.$team->payment->bukti_pembayaran) }}" width="200">
        </li>
    </ul>
</body>
</html>