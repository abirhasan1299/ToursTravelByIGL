<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<h1 align="center">🌍 WanderWise Travel Platform</h1>
<h3 align="center">Enterprise-Grade Tour & Travel Management System</h3>

<p align="center">
  <img src="https://img.shields.io/badge/Version-2.0.0-blue" alt="Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-purple" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-11.x-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

---

## ✈️ About WanderWise

WanderWise is a comprehensive, enterprise-ready travel and tourism platform built on Laravel. Designed for travel agencies, tour operators, and hospitality businesses, it provides a seamless experience for both administrators and travelers—from browsing destinations to booking complete travel packages with integrated payment processing.

### 🎯 Why WanderWise?

Traditional travel booking systems are often rigid, expensive, and disconnected. WanderWise solves this by offering:

- **Unified Dashboard** — Manage tours, bookings, customers, and analytics from a single interface
- **Seamless Booking Experience** — Multi-step booking wizard with real-time availability
- **Smart Pricing Engine** — Dynamic pricing based on seasons, group sizes, and promotions
- **Integrated Payment Gateway** — Support for Stripe, PayPal, and bank transfers
- **Multi-language & Multi-currency** — Ready for global operations

---

## 🧭 Core Features

### For Travelers

| Feature | Description |
|---------|-------------|
| 🔍 **Advanced Search** | Filter tours by destination, date, price, duration, and category |
| 📅 **Real-time Availability** | Check live availability before booking |
| 💳 **Secure Checkout** | Multiple payment options with SSL encryption |
| 👤 **Customer Dashboard** | View booking history, invoices, and travel documents |
| ⭐ **Reviews & Ratings** | Share experiences and read authentic traveler reviews |
| 📱 **Mobile Optimized** | Fully responsive design for booking on any device |

### For Administrators

| Feature | Description |
|---------|-------------|
| 📊 **Analytics Dashboard** | Real-time revenue, bookings, and customer insights |
| 🗺️ **Tour Management** | Create and manage unlimited tours with detailed itineraries |
| 📆 **Booking Management** | Full CRUD operations with status tracking and email notifications |
| 💰 **Pricing Configuration** | Set base prices, seasonal rates, group discounts, and promo codes |
| 👥 **User Management** | Role-based access control (Admin, Agent, Customer) |
| 📧 **Automated Emails** | Booking confirmations, reminders, and follow-up sequences |

---

## 🛠️ Technology Stack

| Layer | Technologies |
|-------|-------------|
| **Backend** | Laravel 11.x, PHP 8.2+, MySQL 8.0 |
| **Frontend** | Blade Templates, Alpine.js, Tailwind CSS, Livewire |
| **Real-time** | Laravel Reverb, Pusher |
| **Payments** | Stripe SDK, PayPal REST API |
| **Queue & Jobs** | Redis, Laravel Horizon |
| **Caching** | Redis, Laravel Cache |
| **Search** | Laravel Scout, Meilisearch |
| **File Storage** | Laravel Flysystem, AWS S3 |
| **Testing** | Pest PHP, Laravel Dusk |
| **Monitoring** | Laravel Telescope, Sentry |

---

## 📦 Installation

### Prerequisites

- PHP >= 8.2
- Composer 2.x
- MySQL 8.0+ / MariaDB 10.6+
- Node.js 18+ & NPM
- Redis (optional, for caching & queues)

### Quick Start

```bash
# Clone the repository
git clone https://github.com/yourusername/wanderwise-travel.git
cd wanderwise-travel

# Install PHP dependencies
composer install

# Install and compile frontend assets
npm install && npm run build

# Configure environment
cp .env.example .env
php artisan key:generate

# Configure your database in .env, then:
php artisan migrate --seed

# Link storage for media files
php artisan storage:link

# Start the development server
php artisan serve


# Build and start containers
docker-compose up -d

# Run migrations
docker-compose exec app php artisan migrate --seed

# Application
APP_NAME="WanderWise Travel"
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=wanderwise
DB_USERNAME=root
DB_PASSWORD=

# Mail (SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=postmaster@yourdomain.com
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls

# Payment Gateways
STRIPE_KEY=pk_live_xxxxxxxxxxxx
STRIPE_SECRET=sk_live_xxxxxxxxxxxx
PAYPAL_CLIENT_ID=xxxxxxxxxxxx
PAYPAL_SECRET=xxxxxxxxxxxx

# Redis (for caching & queues)
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Scout Search Driver
SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://127.0.0.1:7700
MEILISEARCH_KEY=masterKey


app/
├── Console/
│   └── Commands/
│       ├── SendBookingReminders.php
│       └── UpdateTourAvailability.php
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── TourController.php
│   │   │   └── BookingController.php
│   │   ├── Frontend/
│   │   │   ├── HomeController.php
│   │   │   ├── TourController.php
│   │   │   └── CheckoutController.php
│   │   └── Api/
│   │       └── V1/
│   ├── Middleware/
│   └── Requests/
├── Models/
│   ├── Tour.php
│   ├── Booking.php
│   ├── Customer.php
│   ├── Destination.php
│   └── Payment.php
├── Services/
│   ├── PaymentGateway.php
│   ├── PricingEngine.php
│   └── AvailabilityChecker.php
└── Mail/
    ├── BookingConfirmation.php
    └── PaymentReceipt.php

database/
├── migrations/
├── seeders/
│   ├── TourSeeder.php
│   └── DestinationSeeder.php
└── factories/

resources/
├── views/
│   ├── frontend/
│   │   ├── tours/
│   │   ├── checkout/
│   │   └── dashboard/
│   ├── admin/
│   └── components/
└── js/
    ├── Components/
    └── Pages/

routes/
├── web.php          # Public & authenticated web routes
├── admin.php        # Admin panel routes
├── api.php          # REST API endpoints
└── channels.php     # Broadcasting channels


# Run all tests
php artisan test

# Run specific test suites
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run tests in parallel
php artisan test --parallel

# Generate code coverage report
php artisan test --coverage-html coverage/
