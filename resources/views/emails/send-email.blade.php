<html>

<head>
    <title>SIPMA; Sistem Pengaduan Mahasiswa</title>
</head>

<body>
    <h2>Hello, {{ $data['full_name'] }}!</h2>
    <p>{{ $data['email'] }}</p>
    <p>{{ $data['message'] }}</p>
    @if ($data['submission_status'] !== 'rejected')
        <p>Nomor Tiket Anda: {{ $data['ticket_number'] }}</p>
    @endif
    <p>Terimakasih!</p>
</body>

</html>
