# User Manual - JasaMarket

**Platform**: JasaMarket  
**Version**: 1.0  
**Date**: July 2026  

---

## Table of Contents

1. [Introduction](#introduction)
2. [Getting Started](#getting-started)
3. [Buyer Guide](#buyer-guide)
4. [Seller Guide](#seller-guide)
5. [Admin Guide](#admin-guide)
6. [FAQ](#faq)
7. [Support](#support)

---

## Introduction

JasaMarket is a modern service marketplace platform that connects service providers (sellers) with customers (buyers) in Indonesia. The platform allows buyers to browse and purchase various services, while sellers can manage their service offerings and orders.

### User Roles

- **Buyer (Pembeli)**: Browse services, purchase services, and manage orders
- **Seller (Penjual)**: Manage services, handle orders, and provide proof of work
- **Admin**: Manage users, categories, transactions, and view analytics

---

## Getting Started

### Registration

1. Visit the JasaMarket website
2. Click "Daftar" (Register) button
3. Fill in your name, email, and password
4. Click "Kirim OTP" to receive verification code
5. Check your email for the 6-digit OTP code
6. Enter the OTP code to verify your account
7. Your account is now activated and ready to use

### Login

1. Visit the JasaMarket website
2. Click "Masuk" (Login) button
3. Enter your email and password
4. Click "Masuk" to login
5. You will be redirected to your dashboard based on your role

### Password Reset

If you forget your password:
1. Click "Lupa Password" on the login page
2. Enter your registered email
3. Check your email for password reset instructions
4. Follow the link to reset your password

---

## Buyer Guide

### Browsing Services

1. **Home Page**
   - View featured services on the homepage
   - Use search bar to find specific services
   - Browse by category using category filters

2. **Category Browsing**
   - Click on "Kategori" in the navigation
   - Select a category to view related services
   - Use filters to narrow down results

3. **Service Details**
   - Click on any service to view details
   - Read the service description
   - Check the price and duration
   - View seller information and ratings
   - Click "Tambah ke Keranjang" to add to cart

### Shopping Cart

1. **View Cart**
   - Click the cart icon in the floating navigation
   - View all services in your cart
   - See total price

2. **Manage Cart**
   - Remove items by clicking the trash icon
   - Adjust quantity if needed
   - Click "Checkout" when ready to purchase

### Checkout Process

1. **Review Order**
   - Review all services in your order
   - Enter job description (optional but recommended)
   - Click "Lanjut ke Pembayaran"

2. **Payment**
   - Select payment method (via Midtrans)
   - Complete payment process
   - Wait for payment confirmation

### Order Management

1. **View Orders**
   - Click "Pesanan Saya" in navigation
   - View all your orders with status
   - Use status filters to find specific orders

2. **Order Status**
   - **Menunggu**: Order waiting for seller confirmation
   - **Diproses**: Order being worked on by seller
   - **Selesai**: Order completed with proof of work
   - **Ditolak**: Order rejected by seller
   - **Gagal**: Payment failed

3. **Order Details**
   - Click on any order card to view details
   - View job description you provided
   - Check proof of work from seller
   - Download invoice (if available)

### Invoice

1. **View Invoice**
   - Available for paid orders (status: Selesai, Diproses)
   - Click "Lihat Invoice" in order detail modal
   - Invoice opens in new tab

2. **Download Invoice**
   - Click "Download PDF" in order detail modal
   - PDF file downloads automatically
   - Invoice shows "LUNAS" status for paid orders

### Rating Services

1. **Submit Rating**
   - Go to "Pesanan Saya"
   - Click on completed order
   - Click "Beri Rating"
   - Select star rating (1-5)
   - Write review (optional)
   - Submit rating

2. **Update Rating**
   - Find your rating in order details
   - Click "Edit Rating"
   - Update your rating and review
   - Save changes

3. **Delete Rating**
   - Find your rating in order details
   - Click "Hapus Rating"
   - Confirm deletion

### Profile Management

1. **Edit Profile**
   - Click on your profile icon
   - Select "Edit Profile"
   - Update your name
   - Click "Simpan" to save changes

---

## Seller Guide

### Dashboard Overview

1. **Dashboard**
   - View your seller dashboard
   - See statistics (total services, orders, revenue)
   - Quick access to recent orders

### Service Management

1. **View Services**
   - Click "Jasa Saya" in sidebar
   - View all your services
   - See service status (active, draft, inactive)

2. **Create Service**
   - Click "Tambah Jasa Baru"
   - Fill in service details:
     - Service name
     - Category
     - Description
     - Price
     - Duration
     - Service type (online/offline)
     - Location (if offline)
     - Revision count
   - Upload thumbnail image
   - Set status (active/draft)
   - Click "Simpan"

3. **Edit Service**
   - Click on any service in the list
   - Update service information
   - Change thumbnail if needed
   - Update status
   - Click "Simpan Perubahan"

4. **Delete Service**
   - Click on service you want to delete
   - Click "Hapus Jasa"
   - Confirm deletion
   - Service is soft-deleted (can be restored)

5. **Restore Service**
   - Go to "Jasa Saya"
   - Click "Lihat Terhapus"
   - Click "Pulihkan" on deleted service
   - Service is restored

### Order Management

1. **View Incoming Orders**
   - Click "Pesanan Masuk" in sidebar
   - View all orders for your services
   - Use status filters (Semua, Menunggu, Diproses, Selesai, Ditolak)
   - View statistics at the top

2. **Order Details**
   - Click on any order card to view details
   - See buyer information (name, email)
   - View job description from buyer
   - Check service items ordered
   - View proof of work (if uploaded)

3. **Confirm Order**
   - Find order with "Menunggu" status
   - Click "Konfirmasi" in order detail modal
   - Order status changes to "Diproses"
   - Buyer receives notification

4. **Reject Order**
   - Find order with "Menunggu" status
   - Click "Tolak" in order detail modal
   - Order status changes to "Ditolak"
   - Buyer receives notification

5. **Upload Proof of Work**
   - Find order with "Diproses" status
   - Click "Upload Bukti" in order detail modal
   - Select file (image, video, or document)
   - Click "Upload"
   - Proof is visible to buyer

6. **Delete Proof of Work**
   - Find order with uploaded proof
   - Click "Hapus Bukti" in order detail modal
   - Confirm deletion
   - Proof is removed

7. **Complete Order**
   - Find order with uploaded proof
   - Click "Selesai" in order detail modal
   - Order status changes to "Selesai"
   - Buyer receives notification
   - Buyer can now view/download invoice

### Service Status

- **Active**: Service is visible to buyers and can be purchased
- **Draft**: Service is hidden from buyers (work in progress)
- **Inactive**: Service is hidden from buyers (temporarily unavailable)

---

## Admin Guide

### Dashboard Overview

1. **Dashboard**
   - View comprehensive statistics
   - Total revenue, orders, users, sellers, services
   - Daily sales chart (30 days)
   - Monthly sales chart (12 months)
   - Quick access to management sections

### User Management

1. **View Users**
   - Click "User" in sidebar
   - View all registered users
   - See user roles and status

2. **User Status**
   - **Active**: User can access the platform
   - **Verify**: User needs to verify email
   - **Inactive**: User account is disabled

3. **Toggle User Status**
   - Find user in the list
   - Click the status toggle button
   - Status changes immediately
   - User access is affected based on status

### Category Management

1. **View Categories**
   - Click "Kategori" in sidebar
   - View all service categories

2. **Create Category**
   - Click "Tambah Kategori"
   - Enter category name
   - Enter description
   - Click "Simpan"

3. **Edit Category**
   - Click on category you want to edit
   - Update name and description
   - Click "Simpan Perubahan"

4. **Delete Category**
   - Click on category you want to delete
   - Click "Hapus Kategori"
   - Confirm deletion

### Transaction Management

1. **View Transactions**
   - Click "Transaksi" in sidebar
   - View all platform transactions
   - See order ID, buyer, date, amount, status

2. **Search Transactions**
   - Use search bar to find by order ID or buyer name
   - Results update in real-time

3. **Filter by Status**
   - Use status filter buttons
   - Options: Semua, Menunggu, Diproses, Selesai, Ditolak, Gagal
   - Results update immediately

4. **Pagination**
   - Navigate through pages using pagination buttons
   - View specific number of transactions per page

### Reports

1. **View Reports**
   - Click "Laporan" in sidebar
   - View detailed sales analytics
   - Daily sales chart
   - Average revenue and orders per day
   - Visual charts with Chart.js

### Analytics

1. **Dashboard Analytics**
   - View real-time statistics
   - Revenue trends
   - Order trends
   - User growth
   - Service performance

---

## FAQ

### General Questions

**Q: How do I reset my password?**  
A: Click "Lupa Password" on the login page, enter your email, and follow the instructions sent to your email.

**Q: What is OTP verification?**  
A: OTP (One-Time Password) is a 6-digit code sent to your email to verify your account and ensure security.

**Q: Can I change my role after registration?**  
A: No, roles are assigned during registration and cannot be changed. Contact admin if you need role changes.

### Buyer Questions

**Q: How do I pay for services?**  
A: Add services to cart, proceed to checkout, and complete payment via Midtrans payment gateway.

**Q: When can I download my invoice?**  
A: Invoices are available for paid orders with status "Diproses" or "Selesai".

**Q: What happens if the seller rejects my order?**  
A: If your order is rejected, payment will be refunded according to Midtrans refund policy.

**Q: Can I cancel my order?**  
A: Orders can only be cancelled before seller confirmation. Contact support for cancellation requests.

### Seller Questions

**Q: How do I receive payments?**  
A: Payments are processed through Midtrans and transferred to your registered bank account.

**Q: What file types can I upload as proof of work?**  
A: You can upload images (PNG, JPG, GIF), videos (MP4), and documents (PDF, DOC, DOCX, XLS, XLSX, CSV, PPT, PPTX).

**Q: Can I edit my service after publishing?**  
A: Yes, you can edit your service details at any time from the "Jasa Saya" page.

**Q: What is the difference between active and draft status?**  
A: Active services are visible to buyers, while draft services are hidden and not purchasable.

### Admin Questions

**Q: How do I deactivate a seller account?**  
A: Go to User Management, find the seller, and toggle their status to "Inactive".

**Q: Can I view all transactions on the platform?**  
A: Yes, use the Transaksi page to view, search, and filter all platform transactions.

**Q: How do I access sales reports?**  
A: Click "Laporan" in the sidebar to view detailed sales analytics and charts.

---

## Support

### Contact Support

If you encounter any issues or have questions:

- **Email**: support@jasamarket.com
- **Phone**: +62 XXX XXX XXXX
- **Business Hours**: Monday - Friday, 9:00 AM - 5:00 PM

### Common Issues

**Account Verification Issues**
- Ensure you entered the correct OTP code
- Check your spam folder for OTP email
- Request new OTP if code expired

**Payment Issues**
- Check your payment method details
- Ensure sufficient balance
- Contact Midtrans support for payment gateway issues

**Service Upload Issues**
- Ensure image is under 10MB
- Use supported file formats (PNG, JPG, GIF)
- Check your internet connection

**Order Issues**
- Contact seller directly for order-related questions
- Use order detail modal to track status
- Contact support for unresolved issues

### Tips for Buyers

- Read service descriptions carefully before purchasing
- Provide detailed job descriptions for better results
- Check seller ratings and reviews before ordering
- Keep your contact information updated

### Tips for Sellers

- Use high-quality images for service thumbnails
- Write clear and detailed service descriptions
- Respond to orders promptly
- Provide clear proof of work
- Maintain good ratings by delivering quality work

### Tips for Admins

- Monitor user activity regularly
- Review transactions for suspicious activity
- Keep categories organized
- Respond to support requests promptly
- Use analytics to make informed decisions

---

## Best Practices

### For Buyers

1. **Before Purchasing**
   - Read service descriptions thoroughly
   - Check seller ratings and reviews
   - Compare prices across similar services
   - Contact seller with questions if needed

2. **During Order**
   - Provide clear and detailed job descriptions
   - Communicate any specific requirements
   - Be responsive to seller questions
   - Keep track of order status

3. **After Completion**
   - Review proof of work carefully
   - Provide honest ratings and reviews
   - Download invoice for records
   - Report any issues promptly

### For Sellers

1. **Service Listing**
   - Use professional service thumbnails
   - Write comprehensive descriptions
   - Set competitive prices
   - Highlight your expertise

2. **Order Management**
   - Respond to orders quickly
   - Confirm or reject orders promptly
   - Communicate clearly with buyers
   - Upload quality proof of work

3. **Customer Service**
   - Maintain professional communication
   - Address buyer concerns promptly
   - Deliver work on time
   - Aim for positive ratings

### For Admins

1. **Platform Management**
   - Monitor user registrations
   - Review and approve content
   - Handle disputes fairly
   - Keep platform secure

2. **Analytics**
   - Review sales reports regularly
   - Identify trends and opportunities
   - Make data-driven decisions
   - Optimize platform performance

---

## Security Tips

### Password Security

- Use strong passwords (minimum 8 characters)
- Include numbers and special characters
- Don't share your password with anyone
- Change password periodically
- Don't reuse passwords across platforms

### Account Security

- Keep your email secure
- Enable two-factor authentication if available
- Log out after using shared devices
- Report suspicious activity immediately
- Keep your profile information updated

### Payment Security

- Only use official payment methods
- Don't share payment details with sellers
- Verify payment confirmations
- Keep transaction records
- Report fraudulent transactions

---

## Conclusion

JasaMarket is designed to provide a seamless experience for buyers, sellers, and administrators. This user manual covers all essential features and functions of the platform. For additional help or questions, please contact our support team.

Thank you for using JasaMarket!

---

**Version**: 1.0  
**Last Updated**: July 2026  
**Document Owner**: JasaMarket Development Team
