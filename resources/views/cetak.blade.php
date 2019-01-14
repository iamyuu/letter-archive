<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eagle Jump</title>
    <link rel="stylesheet" href="{{ asset('vendor/materialize/css/materialize.min.css') }}">
    <style>
        p {font-size: 25px;}
    </style>
</head>
<body onload="window.print()">
    <h2>Eagle Jump</h2>
    <p>
        Laporan Kerasipan pada Bulan {{ Request::input('month') }} dan Tahun {{ Request::input('year') }}
    </p>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Date</th>
                <th width="25%">Surat Masuk</th>
                <th width="25%">Surat Keluar</th>
                <th width="25%">Subject</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($letter as $l)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $l->incoming_at->format('d, M Y') }}</td>
                    <td>{{ $l->from() }}</td>
                    <td>{{ $l->to() }}</td>
                    <td>{{ $l->mail_subject }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>