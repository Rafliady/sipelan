<table>
    <thead>
        <tr>
            <th>Rank</th>
            <th>Nama Pegawai</th>
            <th>Jabatan</th>
            <th>Jumlah Responden</th>
            <th>Total Akumulasi Poin</th>
            <th>Rata-Rata Nilai</th>
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