<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }} - JasaMarket</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #f0fdf4;
            color: #111827;
            min-height: 100vh;
        }
        .page-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Action Bar (non-printable) */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 1rem;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: white;
            color: #374151;
            border: 1.5px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-back:hover { background: #f9fafb; border-color: #d1d5db; }
        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: #059669;
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-print:hover { background: #047857; }

        /* Invoice Card */
        .invoice-card {
            background: white;
            border-radius: 1.25rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        /* Header */
        .invoice-header {
            background: linear-gradient(135deg, #059669 0%, #065f46 100%);
            padding: 2.5rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .brand-name {
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .brand-tagline { font-size: 0.85rem; opacity: 0.8; margin-top: 0.25rem; }
        .invoice-meta { text-align: right; }
        .invoice-title { font-size: 1.1rem; font-weight: 600; opacity: 0.9; }
        .invoice-number { font-size: 1.5rem; font-weight: 800; margin: 0.25rem 0; }
        .invoice-date { font-size: 0.85rem; opacity: 0.75; }

        /* Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 1rem;
            background: rgba(255,255,255,0.2);
            border: 1.5px solid rgba(255,255,255,0.4);
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }
        .status-dot { width: 8px; height: 8px; background: #86efac; border-radius: 50%; }

        /* Body */
        .invoice-body { padding: 2.5rem; }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2.5rem;
            padding-bottom: 2.5rem;
            border-bottom: 1.5px dashed #e5e7eb;
        }
        .info-block label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
            display: block;
            margin-bottom: 0.4rem;
        }
        .info-block p {
            font-size: 0.95rem;
            font-weight: 600;
            color: #111827;
        }
        .info-block .sub { font-size: 0.85rem; font-weight: 400; color: #6b7280; }

        /* Items Table */
        .section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #6b7280;
            margin-bottom: 1rem;
        }
        .items-table { width: 100%; border-collapse: collapse; }
        .items-table thead th {
            padding: 0.75rem 1rem;
            background: #f9fafb;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6b7280;
            text-align: left;
        }
        .items-table thead th:last-child { text-align: right; }
        .items-table tbody td {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        .item-thumb {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            overflow: hidden;
            background: #f3f4f6;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .item-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .item-info { display: flex; align-items: center; gap: 1rem; }
        .item-name { font-weight: 600; font-size: 0.95rem; color: #111827; }
        .item-sub { font-size: 0.8rem; color: #9ca3af; margin-top: 0.15rem; }
        .item-qty { font-size: 0.9rem; color: #374151; font-weight: 500; }
        .item-price { font-size: 0.95rem; font-weight: 600; color: #374151; text-align: right; white-space: nowrap; }

        /* Totals */
        .totals-section {
            margin-top: 1.5rem;
            display: flex;
            justify-content: flex-end;
        }
        .totals-box { width: 280px; }
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0;
            font-size: 0.9rem;
            color: #6b7280;
            border-bottom: 1px solid #f3f4f6;
        }
        .total-row.grand {
            font-size: 1.1rem;
            font-weight: 800;
            color: #059669;
            border-bottom: none;
            padding-top: 1rem;
        }

        /* Footer */
        .invoice-footer {
            margin-top: 2.5rem;
            padding-top: 2rem;
            border-top: 1.5px dashed #e5e7eb;
            text-align: center;
        }
        .footer-text { font-size: 0.8rem; color: #9ca3af; line-height: 1.6; }
        .footer-text strong { color: #059669; }
        .thank-you { font-size: 1rem; font-weight: 700; color: #059669; margin-bottom: 0.4rem; }

        /* Print */
        @media print {
            body { background: white; }
            .action-bar { display: none !important; }
            .page-wrapper { padding: 0; }
            .invoice-card { box-shadow: none; border-radius: 0; }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">

        <!-- Action Bar -->
        <div class="action-bar no-print">
            <a href="{{ route('pembeli.pesanan') }}" class="btn-back">
                ← Kembali ke Pesanan
            </a>
            <button onclick="window.print()" class="btn-print">
                🖨️ Cetak / Unduh PDF
            </button>
        </div>

        <!-- Invoice Card -->
        <div class="invoice-card">

            <!-- Header -->
            <div class="invoice-header">
                <div>
                    <div class="brand-name">🛒 JasaMarket</div>
                    <div class="brand-tagline">Platform Layanan Jasa Terpercaya</div>
                    <div class="status-badge">
                        <span class="status-dot"></span>
                        Pembayaran Dikonfirmasi
                    </div>
                </div>
                <div class="invoice-meta">
                    <div class="invoice-title">INVOICE</div>
                    <div class="invoice-number">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                    <div class="invoice-date">{{ $order->created_at->format('d F Y') }}</div>
                </div>
            </div>

            <!-- Body -->
            <div class="invoice-body">

                <!-- Info Grid -->
                <div class="info-grid">
                    <div class="info-block">
                        <label>Ditagihkan Kepada</label>
                        <p>{{ $order->user->name }}</p>
                        <p class="sub">{{ $order->user->email }}</p>
                    </div>
                    <div class="info-block" style="text-align:right;">
                        <label>Detail Transaksi</label>
                        <p>{{ $order->created_at->format('d M Y, H:i') }}</p>
                        <p class="sub">Status: <span style="color:#059669;font-weight:600;">Berhasil</span></p>
                    </div>
                </div>

                <!-- Items -->
                <div class="section-title">Daftar Jasa yang Dipesan</div>
                <table class="items-table">
                    <thead>
                        <tr>
                            <th style="border-radius:0.5rem 0 0 0.5rem;">Jasa</th>
                            <th>Qty</th>
                            <th style="border-radius:0 0.5rem 0.5rem 0;">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="item-info">
                                    <div class="item-thumb">
                                        @if($item->service->thumbnail)
                                            <img src="{{ asset('storage/' . $item->service->thumbnail) }}" alt="{{ $item->service->name }}">
                                        @else
                                            <span style="font-size:1.2rem;">🖼️</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="item-name">{{ $item->service->name }}</div>
                                        <div class="item-sub">Layanan Jasa</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="item-qty">1×</span></td>
                            <td><span class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Totals -->
                <div class="totals-section">
                    <div class="totals-box">
                        <div class="total-row">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="total-row">
                            <span>Biaya Layanan Platform</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="total-row grand">
                            <span>Total Pembayaran</span>
                            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="invoice-footer">
                    <p class="thank-you">Terima kasih atas kepercayaan Anda! 🎉</p>
                    <p class="footer-text">
                        Invoice ini merupakan bukti pembayaran resmi dari <strong>JasaMarket</strong>.<br>
                        Apabila ada pertanyaan, silakan hubungi tim support kami.
                    </p>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
