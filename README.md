# CandidatureTracker

CandidatureTracker is a modern web application built with **Laravel**, **Tailwind CSS**, and **Alpine.js**, designed to help you easily manage and track your job applications. 

## Features

- **Job Application Tracking**: Keep track of all your ongoing job applications (company name, role, status).
- **Interview Management**: Schedule and log interviews associated with each application.
- **File Attachments**: Upload and manage files (CVs, cover letters, technical tests) for each application.
- **Archiving System**: Archive past or inactive applications to keep your dashboard clean, with the ability to restore or permanently delete them.
- **User Authentication**: Secure your application data with user accounts, powered by Laravel Breeze.

## Tech Stack

- **Backend**: Laravel 13.x (PHP 8.3+)
- **Frontend**: Blade Templates, Tailwind CSS 4, Alpine.js, Vite
- **Database**: SQLite (default, configurable)
- **Testing**: Pest

## Prerequisites

Make sure you have the following installed:
- PHP 8.3 or higher
- Composer
- Node.js & npm

## Installation

1. **Clone the repository** (if applicable) or download the project files.

2. **Install PHP dependencies**:
```bash
composer install
```

3. **Install JavaScript dependencies**:
```bash
npm install
```

4. **Environment Setup**:
Copy the example `.env` file and generate the application key.
```bash
cp .env.example .env
php artisan key:generate
```

5. **Database Setup**:
Run the database migrations. By default, it will create an SQLite database if configured in `.env`.
```bash
php artisan migrate
```

6. **Build Frontend Assets**:
```bash
npm run build
```

## Running the Application Locally

You can use the built-in Composer script to run both the Laravel development server and Vite simultaneously:

```bash
composer run dev
```

Alternatively, you can run them in separate terminal windows:
```bash
php artisan serve
npm run dev
```

The application will be accessible at `http://127.0.0.1:8000`.

## Testing

This project uses [Pest](https://pestphp.com/) for automated testing. To run the test suite:

```bash
composer test
# or
php artisan test
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
