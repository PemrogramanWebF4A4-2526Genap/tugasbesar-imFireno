<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #1f2937;
            line-height: 1.6;
        }
        .invoice-container {
            padding: 40px;
        }

        /* Header */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 3px solid #059669;
            padding-bottom: 20px;
        }
        .header-left {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
        }
        .header-right {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
            text-align: right;
        }
        .brand-name {
            font-size: 28px;
            font-weight: bold;
            color: #059669;
            margin-bottom: 4px;
        }
        .brand-tagline {
            font-size: 11px;
            color: #6b7280;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }
        .invoice-number {
            font-size: 13px;
            color: #6b7280;
            margin-top: 4px;
        }

        /* Info Sections */
        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .info-block {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }
        .info-block h4 {
            font-size: 11px;
            text-transform: uppercase;
            color: #9ca3af;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .info-block p {
            margin-bottom: 3px;
            font-size: 12px;
        }
        .info-block .name {
            font-weight: bold;
            font-size: 14px;
            color: #1f2937;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-failed {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table thead th {
            background-color: #059669;
            color: #ffffff;
            padding: 10px 14px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .items-table thead th:first-child {
            border-radius: 6px 0 0 0;
        }
        .items-table thead th:last-child {
            border-radius: 0 6px 0 0;
            text-align: right;
        }
        .items-table tbody td {
            padding: 12px 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 12px;
        }
        .items-table tbody tr:last-child td {
            border-bottom: none;
        }
        .items-table .text-right {
            text-align: right;
        }
        .item-name {
            font-weight: bold;
            color: #1f2937;
        }
        .item-seller {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }

        /* Totals */
        .totals-section {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .totals-spacer {
            display: table-cell;
            width: 55%;
        }
        .totals-box {
            display: table-cell;
            width: 45%;
        }
        .total-row {
            display: table;
            width: 100%;
            padding: 8px 0;
        }
        .total-label {
            display: table-cell;
            text-align: left;
            color: #6b7280;
            font-size: 12px;
        }
        .total-value {
            display: table-cell;
            text-align: right;
            font-size: 12px;
            font-weight: bold;
        }
        .grand-total {
            border-top: 2px solid #059669;
            margin-top: 8px;
            padding-top: 10px;
        }
        .grand-total .total-label {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
        }
        .grand-total .total-value {
            font-size: 16px;
            color: #059669;
        }

        /* Payment Info */
        .payment-info {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 30px;
        }
        .payment-info h4 {
            font-size: 12px;
            font-weight: bold;
            color: #065f46;
            margin-bottom: 8px;
        }
        .payment-info p {
            font-size: 11px;
            color: #047857;
            margin-bottom: 3px;
        }

        /* Footer */
        .footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
            text-align: center;
        }
        .footer p {
            font-size: 10px;
            color: #9ca3af;
            margin-bottom: 3px;
        }
        .footer .thanks {
            font-size: 13px;
            font-weight: bold;
            color: #059669;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <div class="brand-name">JasaMarket</div>
                <div class="brand-tagline">Platform Marketplace Jasa Terpercaya</div>
            </div>
            <div class="header-right">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <div class="info-block">
                <h4>Ditagihkan Kepada</h4>
                <p class="name">{{ $order->user->name }}</p>
                <p>{{ $order->user->email }}</p>
            </div>
            <div class="info-block" style="text-align: right;">
                <h4>Detail Invoice</h4>
                <p><strong>No. Invoice:</strong> INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
                <p><strong>Waktu:</strong> {{ $order->created_at->format('H:i') }} WIB</p>
                <p style="margin-top: 8px;">
                    <span class="status-badge {{ in_array($order->status, ['success', 'confirmed', 'completed']) ? 'status-success' : ($order->status == 'pending' ? 'status-pending' : 'status-failed') }}">
                        {{ in_array($order->status, ['success', 'confirmed', 'completed']) ? 'LUNAS' : ($order->status == 'pending' ? 'MENUNGGU' : 'GAGAL') }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 55%;">Nama Jasa</th>
                    <th style="width: 20%;">Penjual</th>
                    <th style="width: 20%;">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="item-name">{{ $item->service->name }}</div>
                    </td>
                    <td>{{ $item->service->seller->name }}</td>
                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-section">
            <div class="totals-spacer"></div>
            <div class="totals-box">
                <div class="total-row">
                    <span class="total-label">Subtotal</span>
                    <span class="total-value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="total-row">
                    <span class="total-label">Biaya Layanan</span>
                    <span class="total-value">Rp 0</span>
                </div>
                <div class="total-row grand-total">
                    <span class="total-label">Total Pembayaran</span>
                    <span class="total-value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Info -->
        @if($order->status == 'success')
        <div class="payment-info">
            <h4>&#10003; Pembayaran Berhasil</h4>
            <p>Pembayaran telah diterima dan dikonfirmasi pada {{ $order->updated_at->format('d M Y, H:i') }} WIB.</p>
            <p>Terima kasih telah menggunakan JasaMarket.</p>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p class="thanks">Terima kasih atas kepercayaan Anda!</p>
            <p>Dokumen ini merupakan bukti transaksi yang sah dan dicetak secara otomatis oleh sistem.</p>
            <p>&copy; {{ date('Y') }} JasaMarket - Platform Marketplace Jasa Terpercaya</p>
        </div>
    </div>
</body>
</html>
