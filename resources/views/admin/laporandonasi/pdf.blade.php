<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pertanggungjawaban Donasi - {{ $laporan->donasi->judul }}</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Times New Roman', serif;
            color: #333;
            line-height: 1.5;
            font-size: 12pt;
        }
        
        /* Header Styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px double #2c3e50;
        }
        
        .logo {
            width: 100px;
            height: auto;
        }
        
        .header-text {
            text-align: center;
            flex-grow: 1;
        }
        
        .organization-name {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .organization-address {
            font-size: 10pt;
            margin-bottom: 10px;
        }
        
        .document-title {
            font-size: 16pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 5px;
        }
        
        .document-subtitle {
            font-size: 12pt;
            font-style: italic;
        }
        
        /* Content Styles */
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-weight: bold;
            border-bottom: 1px solid #2c3e50;
            padding-bottom: 3px;
            margin-bottom: 15px;
            font-size: 13pt;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .info-item {
            margin-bottom: 8px;
        }
        
        .info-label {
            font-weight: bold;
            margin-bottom: 3px;
        }
        
        .info-value {
            padding: 5px 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
            min-height: 20px;
        }
        
        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .table th {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            padding: 8px 10px;
            text-align: left;
            font-weight: bold;
        }
        
        .table td {
            border: 1px solid #ddd;
            padding: 8px 10px;
        }
        
        .text-right {
            text-align: right;
        }
        
        /* Summary Styles */
        .summary {
            margin-top: 25px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .summary-total {
            font-weight: bold;
            border-top: 1px solid #2c3e50;
            padding-top: 8px;
            margin-top: 8px;
            font-size: 13pt;
        }
        
        /* Signature Styles */
        .signature-container {
            margin-top: 50px;
            display: flex;
            justify-content: flex-end;
        }
        
        .signature-box {
            width: 300px;
            text-align: center;
        }
        
        .signature-placeholder {
            height: 80px;
            margin-bottom: 10px;
            position: relative;
        }
        
        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin: 0 auto;
            position: absolute;
            bottom: 0;
            left: 10%;
        }
        
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 5px;
        }
        
        .signature-title {
            font-size: 10pt;
        }
        
        .signature-stamp {
            position: absolute;
            right: 0;
            top: 0;
            opacity: 0.7;
            width: 80px;
        }
        
        /* Footer Styles */
        .footer {
            margin-top: 40px;
            font-size: 10pt;
            text-align: center;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        
        /* Utility Classes */
        .text-uppercase {
            text-transform: uppercase;
        }
        
        .text-bold {
            font-weight: bold;
        }
        
        .mb-20 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="header-text">
            <div class="organization-name">TanggapiKita</div>
            <div class="organization-address">
                Jl. Majapahit No.62, Gomong, Kec. Selaparang, Kota Mataram, Nusa Tenggara Bar. 83115<br>
                Telp: (085) 237949283 | Email: info@tanggapikita.org
            </div>
            <div class="document-title">LAPORAN ALOKASI DONASI</div>
            <div class="document-subtitle">Nomor: LPD/{{ date('Y/m', strtotime($laporan->tanggal)) }}/{{ $laporan->id_laporandonasi }}</div>
        </div>
    </div>
    
    <!-- Campaign Info Section -->
    <div class="section">
        <div class="section-title">I. IDENTITAS PROGRAM</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nama Program Donasi</div>
                <div class="info-value text-uppercase">{{ $laporan->donasi->judul }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Periode Pelaksanaan</div>
                <div class="info-value">{{ $periode }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Penanggung Jawab Program</div>
                <div class="info-value">{{ $laporan->donasi->user->akun->nama }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Tanggal Pembuatan Laporan</div>
                <div class="info-value">{{ $tanggal }}</div>
            </div>
        </div>
    </div>
    
    <!-- Description Section -->
    <div class="section">
        <div class="section-title">II. RINGKASAN PELAKSANAAN</div>
        <div class="info-value mb-20" style="padding: 10px;">
            {!! nl2br(e($laporan->deskripsi)) !!}
        </div>
    </div>
    
    <!-- Fund Allocation Section -->
    <div class="section">
        <div class="section-title">III. RINCIAN PENGGUNAAN DANA</div>
        <table class="table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="30%">Uraian</th>
                    <th width="35%">Keterangan</th>
                    <th width="15%">Jumlah (Rp)</th>
                    <th width="15%">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan->alokasiDana as $index => $alokasi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $alokasi->keterangan }}</td>
                    <td>{{ $alokasi->tujuan }}</td>
                    <td class="text-right">{{ number_format($alokasi->jumlah, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format(($alokasi->jumlah / $laporan->total) * 100, 2) }}%</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Financial Summary Section -->
    <div class="section">
        <div class="section-title">IV. REKAPITULASI KEUANGAN</div>
        <div class="summary">
            <div class="summary-item">
                <span>Total Dana yang Diterima:</span>
                <span class="text-bold">{{ number_format($laporan->total, 0, ',', '.') }}</span>
            </div>
            <div class="summary-item">
                <span>Total Dana yang Digunakan:</span>
                <span class="text-bold">{{ number_format($laporan->total - $laporan->sisa, 0, ',', '.') }}</span>
            </div>
            <div class="summary-item">
                <span>Persentase Penggunaan Dana:</span>
                <span class="text-bold">{{ number_format((($laporan->total - $laporan->sisa) / $laporan->total * 100), 2) }}%</span>
            </div>
            <div class="summary-item summary-total">
                <span>SALDO AKHIR:</span>
                <span>{{ number_format($laporan->sisa, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
    
    <!-- Signature Section -->
    <div class="signature-container">
        <div class="signature-box">
            <div>Mataram, {{ \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('d F Y') }}</div>
            <div class="mt-3 mb-2">
                    <img src="{{ public_path('images/stempel.png') }}" alt="Stempel" width="120">
            </div>
            <div class="signature-title">TanggapiKita</div>
        </div>
    </div>
    
    <!-- Footer Section -->
    <div class="footer">
        <p>Dokumen ini merupakan laporan resmi dan sah sebagai bentuk pertanggungjawaban pengelolaan dana donasi</p>
        <p>© {{ date('Y') }} TanggapiKita - All Rights Reserved</p>
    </div>
</body>
</html>