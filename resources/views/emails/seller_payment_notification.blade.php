<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Pesanan Baru - {{ config('app.name') }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #059669, #0d9488); padding: 32px 40px; text-align: center;">
                            <h1 style="color: #ffffff; font-size: 24px; margin: 0 0 4px 0;">JasaMarket</h1>
                            <p style="color: #a7f3d0; font-size: 13px; margin: 0;">Notifikasi Pesanan Baru</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <!-- Greeting -->
                            <p style="font-size: 16px; color: #1f2937; margin: 0 0 8px 0;">
                                Halo, <strong>{{ $sellerName }}</strong>! 👋
                            </p>
                            <p style="font-size: 14px; color: #6b7280; margin: 0 0 24px 0; line-height: 1.6;">
                                Kabar baik! Ada pesanan baru yang sudah dibayar oleh pembeli. Berikut detailnya:
                            </p>

                            <!-- Order Info Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding-bottom: 8px;">
                                                    <span style="font-size: 12px; color: #6b7280;">No. Pesanan</span><br>
                                                    <strong style="font-size: 16px; color: #059669;">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong>
                                                </td>
                                                <td style="padding-bottom: 8px; text-align: right;">
                                                    <span style="display: inline-block; background-color: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">
                                                        ✓ LUNAS
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span style="font-size: 12px; color: #6b7280;">Pembeli</span><br>
                                                    <strong style="font-size: 14px; color: #1f2937;">{{ $order->user->name }}</strong>
                                                </td>
                                                <td style="text-align: right;">
                                                    <span style="font-size: 12px; color: #6b7280;">Tanggal</span><br>
                                                    <strong style="font-size: 14px; color: #1f2937;">{{ $order->updated_at->format('d M Y, H:i') }}</strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Items Ordered -->
                            <p style="font-size: 14px; font-weight: bold; color: #1f2937; margin: 0 0 12px 0;">Jasa yang Dipesan dari Anda:</p>
                            <table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; margin-bottom: 24px;">
                                <tr style="background-color: #f9fafb;">
                                    <td style="padding: 10px 14px; font-size: 11px; color: #6b7280; font-weight: bold; text-transform: uppercase;">Nama Jasa</td>
                                    <td style="padding: 10px 14px; font-size: 11px; color: #6b7280; font-weight: bold; text-transform: uppercase; text-align: right;">Harga</td>
                                </tr>
                                @php $sellerTotal = 0; @endphp
                                @foreach($sellerItems as $item)
                                @php $sellerTotal += $item->price; @endphp
                                <tr>
                                    <td style="padding: 12px 14px; font-size: 13px; color: #1f2937; border-top: 1px solid #e5e7eb;">
                                        <strong>{{ $item->service->name }}</strong>
                                    </td>
                                    <td style="padding: 12px 14px; font-size: 13px; color: #1f2937; border-top: 1px solid #e5e7eb; text-align: right;">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                                <tr style="background-color: #f0fdf4;">
                                    <td style="padding: 12px 14px; font-size: 14px; font-weight: bold; color: #065f46; border-top: 2px solid #059669;">
                                        Total untuk Anda
                                    </td>
                                    <td style="padding: 12px 14px; font-size: 14px; font-weight: bold; color: #059669; border-top: 2px solid #059669; text-align: right;">
                                        Rp {{ number_format($sellerTotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA -->
                            <p style="font-size: 14px; color: #6b7280; margin: 0 0 16px 0; line-height: 1.6;">
                                Silakan segera proses pesanan ini. Invoice lengkap terlampir pada email ini dalam format PDF.
                            </p>

                            <!-- Attachment Note -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; margin-bottom: 16px;">
                                <tr>
                                    <td style="padding: 12px 16px;">
                                        <p style="font-size: 12px; color: #1e40af; margin: 0;">
                                            📎 <strong>Lampiran:</strong> Invoice PDF (#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }})
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 24px 40px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="font-size: 12px; color: #9ca3af; margin: 0 0 4px 0;">
                                Email ini dikirim secara otomatis oleh sistem JasaMarket.
                            </p>
                            <p style="font-size: 11px; color: #9ca3af; margin: 0;">
                                &copy; {{ date('Y') }} JasaMarket - Platform Marketplace Jasa Terpercaya
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
