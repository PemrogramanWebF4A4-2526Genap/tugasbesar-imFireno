# JasaMarket

A modern service marketplace platform built with Laravel 12 and Livewire 3, connecting service providers (sellers) with customers (buyers) in Indonesia.

## 🚀 Features

### User Roles
- **Admin**: Full system management including users, categories, and comprehensive analytics
- **Penjual (Seller)**: Service management dashboard with CRUD operations for their services
- **Pembeli (Buyer)**: Browse, purchase services, and manage orders with verification system

### Key Features
- **Authentication System**: Email-based registration with OTP verification
- **Role-Based Access Control**: Middleware-based authorization for different user roles
- **Service Management**: Complete CRUD operations for sellers to manage their services
- **Category System**: Organized service categories for better navigation
- **Search & Filtering**: Advanced search with category and status filters
- **Shopping Cart**: Add services to cart and checkout
- **Payment Integration**: Midtrans payment gateway integration
- **Order Management**: Track order status and history with professional UI
- **Invoice Generation**: PDF invoice generation with view and download capabilities
- **Invoice Status**: Dynamic invoice status (LUNAS for paid orders)
- **Order Detail Modals**: Comprehensive order details for buyers and sellers
- **Rating System**: Rate and review purchased services
- **Admin Analytics**: Comprehensive dashboard with sales charts (daily, monthly, weekly)
- **Admin Transaction Management**: View all transactions with status filtering and pagination
- **User Status Management**: Admin can activate/deactivate seller accounts
- **Profile Management**: Edit profile feature for buyers to update their information
- **Professional UI**: Modern, responsive design with stats cards and improved layouts
- **Reports**: Detailed sales reports with visual analytics
- **Responsive Design**: Mobile-friendly UI built with Tailwind CSS
- **Real-time Updates**: Livewire-powered reactive components
- **Soft Deletes**: Data recovery capability for services
- **File Upload**: Image upload for service thumbnails and proof of work
- **Notifications**: SweetAlert for user feedback and system notifications

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Laravel 12

## 🛠️ Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Livewire 3, Blade, Tailwind CSS
- **Database**: MySQL with Eloquent ORM
- **Authentication**: Laravel Auth with OTP verification
- **Payment**: Midtrans Payment Gateway
- **Charts**: Chart.js for analytics visualization
- **UI Components**: SweetAlert for notifications, Font Awesome icons
- **PDF Generation**: Laravel DomPDF
- **Excel Export**: Maatwebsite Excel

## 📦 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/PemrogramanWebF4A4-2526Genap/tugasbesar-imFireno.git
   cd jasamarket
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit `.env` file:
   ```env
   DB_DATABASE=jasamarket
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Configure Midtrans**
   Add your Midtrans credentials to `.env`:
   ```env
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_IS_PRODUCTION=false
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start development server**
   ```bash
   php artisan serve
   npm run dev
   ```

## 🗂️ Project Structure

```
jasamarket/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php          # Authentication logic
│   │   │   ├── VerificationController.php  # OTP verification
│   │   │   ├── InvoiceController.php       # PDF invoice generation
│   │   │   ├── Pembeli/
│   │   │   │   └── InvoiceController.php    # Buyer invoice controller
│   │   │   ├── RatingController.php        # Rating management
│   │   │   └── HomeController.php          # Buyer home
│   │   ├── Middleware/
│   │   │   ├── CheckRole.php               # Role-based access
│   │   │   └── CheckStatus.php             # Account status check
│   │   └── Requests/
│   │       └── ServiceFormRequest.php      # Service validation
│   ├── Livewire/
│   │   ├── Admin/                          # Admin components
│   │   │   ├── Dashboard.php               # Admin dashboard with analytics
│   │   │   ├── User/
│   │   │   │   └── Index.php                # User management with status toggle
│   │   │   ├── Kategori.php                # Category CRUD
│   │   │   ├── Transaksi/
│   │   │   │   └── Index.php                # Transaction management
│   │   │   └── Laporan.php                 # Sales reports
│   │   ├── Seller/                         # Seller components
│   │   │   ├── Dashboard.php               # Seller dashboard
│   │   │   ├── Pesanan.php                 # Order management with detail modal
│   │   │   └── Service/                    # Service management
│   │   ├── Pembeli/                        # Buyer components
│   │   │   ├── FloatingBar.php             # Floating navigation
│   │   │   ├── Kategori.php                # Category browsing
│   │   │   ├── Keranjang.php               # Shopping cart
│   │   │   ├── Pesanan/
│   │   │   │   └── Index.php                # Order management with detail modal
│   │   │   └── Home.php                    # Home page
│   │   ├── AllServices.php                 # Public service listing
│   │   ├── EditProfile.php                 # Profile editing component
│   │   └── Notifications.php                # Notification system
│   ├── Models/
│   │   ├── User.php                        # User model with relationships
│   │   ├── Service.php                     # Service model with soft deletes
│   │   ├── Category.php                    # Category model
│   │   ├── Order.php                       # Order model
│   │   ├── OrderItem.php                   # Order item model
│   │   ├── Rating.php                      # Rating model
│   │   └── Verification.php                # OTP verification model
│   ├── Services/
│   │   ├── AnalyticsService.php            # Analytics data service
│   │   └── NotificationService.php         # Notification service
│   ├── Policies/
│   │   └── ServicePolicy.php               # Service authorization
│   └── Mail/
│       └── OtpEmail.php                    # OTP email template
├── database/
│   └── migrations/
│       ├── 0001_01_01_000000_create_users_table.php
│       ├── 2026_07_03_102654_create_verifications_table.php
│       ├── 2026_07_09_122825_create_categories_table.php
│       ├── 2026_07_09_122906_create_services_table.php
│       ├── create_orders_table.php
│       ├── create_order_items_table.php
│       └── create_ratings_table.php
├── resources/
│   ├── views/
│   │   ├── layout/                         # Layout templates
│   │   │   ├── admin.blade.php
│   │   │   ├── seller.blade.php
│   │   │   ├── master.blade.php
│   │   │   ├── _navbar.blade.php
│   │   │   └── _floatingbar.blade.php
│   │   ├── admin/                          # Admin pages
│   │   ├── seller/                         # Seller pages
│   │   ├── pembeli/                        # Buyer pages
│   │   ├── auth/                           # Authentication pages
│   │   ├── verification/                   # OTP verification pages
│   │   └── livewire/                       # Livewire component views
└── routes/
    └── web.php                             # Route definitions
```

## 🗄️ Database Schema

### Users Table
- `id`, `name`, `email`, `password`
- `role` (admin, penjual, pembeli)
- `status` (active, verify, inactive)
- Relationships: hasMany Services, hasMany Verifications, hasMany Orders

### Verifications Table
- `id`, `user_id`, `unique_id`, `otp`
- `type` (register, reset_password)
- `send_via` (email, sms, wa)
- `status` (active, valid, invalid)
- `resend` counter

### Categories Table
- `id`, `name`, `description`
- Relationships: hasMany Services

### Services Table
- `id`, `seller_id`, `category_id`, `name`, `slug`
- `description`, `price`, `duration`
- `service_type` (online, offline), `location`
- `revision`, `thumbnail`, `status` (active, draft, inactive)
- Soft deletes enabled
- Relationships: belongsTo User, belongsTo Category, hasMany Ratings

### Orders Table
- `id`, `user_id`, `total_amount`, `status`
- `snap_token`, `proof_of_work`, `job_description`
- Status: pending, success, confirmed, completed, rejected, failed
- Relationships: belongsTo User, hasMany OrderItems

### Order Items Table
- `id`, `order_id`, `service_id`, `quantity`, `price`
- Relationships: belongsTo Order, belongsTo Service

### Ratings Table
- `id`, `user_id`, `service_id`, `rating`, `review`
- Relationships: belongsTo User, belongsTo Service

## 🔐 Authentication & Authorization

### Authentication Flow
1. User registers with email and password
2. System generates 6-digit OTP
3. OTP sent to user's email
4. User verifies OTP to activate account
5. User can login with credentials

### Authorization
- **Admin**: Full access to all admin routes
- **Seller**: Can only manage their own services
- **Buyer**: Can browse and purchase services (after verification)

### Middleware
- `check_role`: Validates user role access
- `check_status`: Ensures account is active/verified

## 💳 Payment Integration

### Midtrans Integration
- Payment gateway for secure transactions
- Support for various payment methods
- Webhook callback for payment status updates
- Order status tracking (pending, success, failed, cancelled)

## 📊 Analytics & Reports

### Admin Dashboard
- Total revenue, orders, users, sellers, services statistics
- Daily sales chart (30 days)
- Monthly sales chart (12 months)
- Dual Y-axis for revenue and order count

### Reports Page
- Detailed daily sales analytics
- Average revenue and orders per day
- Visual charts with Chart.js

## 🎯 API Routes

### Public Routes
- `GET /` - Landing page
- `GET /login` - Login page
- `POST /login` - Login submission
- `GET /register` - Registration page
- `POST /register` - Registration submission
- `POST /logout` - Logout

### Admin Routes (Protected)
- `/dashboard` - Admin dashboard with analytics
- `/dashboard/user` - User management with status toggle
- `/dashboard/kategori` - Category management
- `/dashboard/transaksi` - Transaction management with filtering
- `/dashboard/laporan` - Sales reports

### Seller Routes (Protected)
- `/seller/dashboard` - Seller dashboard
- `/seller/jasa` - Service listing
- `/seller/service` - Service management
- `/seller/service/create` - Create service
- `/seller/service/{id}/edit` - Edit service
- `/seller/pesanan` - Order management with detail modal

### Buyer Routes (Protected)
- `/home` - Buyer home
- `/kategori` - Browse by category
- `/keranjang` - Shopping cart
- `/checkout` - Checkout process
- `/pembayaran` - Payment page
- `/pesanan` - Order history with detail modal
- `/verify` - OTP verification request
- `/verify/{unique_id}` - OTP verification form
- `POST /verify` - Send OTP
- `PUT /verify/{unique_id}` - Verify OTP
- `POST /rating` - Submit rating
- `PUT /rating/{id}` - Update rating
- `DELETE /rating/{id}` - Delete rating
- `GET /pembeli/invoice/{order}/view` - View invoice in browser
- `GET /pembeli/invoice/{order}/download` - Download invoice PDF

### API Routes
- `POST /api/midtrans/callback` - Midtrans payment callback

## 🆕 Recent Updates & Improvements

### Invoice System Enhancements
- **Invoice View**: Buyers can now view invoices directly in the browser
- **Invoice Download**: PDF download functionality for all paid orders
- **Dynamic Invoice Status**: Invoice shows "LUNAS" for paid orders (success, confirmed, completed)
- **Invoice Accessibility**: Available for orders with status: success, confirmed, completed

### Order Management Improvements
- **Buyer Order Detail Modal**: Comprehensive order details with:
  - Order information (date, total)
  - Job description from buyer
  - Proof of work preview (video/image/document)
  - Service items with thumbnails
  - Invoice view and download buttons
- **Seller Order Detail Modal**: Complete order management with:
  - Buyer information (name, email, avatar)
  - Job description details
  - Proof of work upload and management
  - Service items (seller's services only)
  - Action buttons (confirm, reject, complete, upload proof)
- **Professional UI**: Modern card-based design with stats cards
- **Stats Overview**: Quick statistics for order status distribution

### Admin Features
- **Transaction Management Page**: New page to view all platform transactions
  - Search by order ID or buyer name
  - Filter by order status
  - Custom pagination with modern design
  - Detailed order information display
- **User Status Toggle**: Quick activate/deactivate for seller accounts
- **Transaction Sidebar Menu**: Easy access to transaction management

### User Experience Improvements
- **Profile Editing**: Buyers can now edit their profile name
  - Modal-based editing interface
  - Real-time validation
  - Success notifications
- **Professional Order Cards**: Compact, information-rich order cards
- **Stats Cards**: Visual statistics for quick overview
- **Improved Empty States**: Better empty state design with CTAs
- **Responsive Design**: Mobile-friendly layouts throughout

### UI/UX Enhancements
- **Modern Filter Design**: Pill-style filters with active states
- **Gradient Icons**: Beautiful gradient icons for visual appeal
- **Hover Effects**: Smooth transitions and hover states
- **Better Typography**: Improved font hierarchy and spacing
- **Color-coded Status**: Consistent color coding for order statuses
- **Professional Modals**: Sticky headers and footers for better UX

## 🧪 Testing

For detailed testing results and test coverage, please refer to the [TESTING_REPORT.md](TESTING_REPORT.md) file.

### Test Suite
Run the test suite:
```bash
php artisan test
```

### Test Summary
- **Total Features Tested**: 60+
- **Passed**: 60
- **Failed**: 0
- **Success Rate**: 100%

## 📝 Development Scripts

```bash
# Setup fresh installation
composer run setup

# Development mode with hot reload
composer run dev

# Run tests
composer run test
```

## 🎨 UI Features

### Responsive Design
- Mobile-first approach
- Tailwind CSS for styling
- Font Awesome icons
- SweetAlert notifications
- Chart.js for data visualization

### Components
- Floating navigation bar for buyers
- Sidebar navigation for admin and sellers
- Modal dialogs for forms
- Data tables with pagination
- Image upload with preview
- Rating stars system

## 📞 Support

For support, email support@jasamarket.com or open an issue in the repository.

## 👥 Team

- **Project**: JasaMarket
- **Course**: Pemrograman Web F4A4
- **Academic Year**: 2025/2026 Genap

## 📄 License

This project is open-sourced software licensed under the MIT license.

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
