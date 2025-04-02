<!DOCTYPE html>
<html>
<head>
    <title>Surat Rekomendasi - {{ $team->nama }}</title>
</head>
<body>
    <h2>Surat Rekomendasi</h2>
    <p>Berikut adalah surat rekomendasi untuk tim {{ $team->nama }}.</p>

    <h3>File Surat:</h3>
    <img src="{{ public_path('storage/'.$team->documents->surat_rekomendasi) }}" width="300">
</body>
</html>
