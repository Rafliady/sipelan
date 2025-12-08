<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kinerja Pegawai</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Hasil Penilaian Pegawai</h2>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jabatan</th>
                <th>Responden</th>
                <th>Total Poin</th>
                <th>Skor Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->position }}</td>
                <td>{{ $emp->assessments_count }}</td>
                <td>{{ $emp->assessments_sum_rating ?? 0 }}</td>
                <td>{{ number_format($emp->assessments_avg_rating, 1) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>