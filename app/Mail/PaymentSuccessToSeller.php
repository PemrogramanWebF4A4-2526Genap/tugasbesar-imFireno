<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentSuccessToSeller extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public array $sellerItems;
    public string $sellerName;

    /**
     * Create a new message instance.
     *
     * @param Order $order The full order record
     * @param array $sellerItems Array of OrderItem models belonging to this seller
     * @param string $sellerName The seller's name
     */
    public function __construct(Order $order, array $sellerItems, string $sellerName)
    {
        $this->order = $order;
        $this->sellerItems = $sellerItems;
        $this->sellerName = $sellerName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('app.name')),
            subject: 'Pesanan Baru Dibayar - #ORD-' . str_pad($this->order->id, 5, '0', STR_PAD_LEFT),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.seller_payment_notification',
            with: [
                'order' => $this->order,
                'sellerItems' => $this->sellerItems,
                'sellerName' => $this->sellerName,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // Generate the invoice PDF and attach it
        $pdf = Pdf::loadView('pdf.invoice', ['order' => $this->order]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(
                fn () => $pdf->output(),
                'Invoice-ORD-' . str_pad($this->order->id, 5, '0', STR_PAD_LEFT) . '.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
