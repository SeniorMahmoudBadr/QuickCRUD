# Egyptian Red Crescent

![Egyptian Red Crescent Logo](public/logo-white.png)

## Introduction

This project is a comprehensive system management tool designed for the Egyptian Red Crescent. Built with Laravel 10 and PHP 8.2, the system aims to streamline and manage various operational aspects of the organization efficiently.

## Features

- **User Management**: Manage user roles and permissions.
- **Notification System**: Real-time notifications for users.
- **Reporting**: Generate and view reports on various aspects of the organization.
- **Task Management**: Create, assign, and track tasks.
- **Resource Management**: Manage resources and inventory.
- **Audit Logs**: Track changes and activities within the system.

## Requirements

- PHP 8.2
- Composer
- Node.js & NPM
- MySQL or PostgreSQL

## Installation

Follow these steps to set up the project on your local machine.

### Clone the repository

```bash
git clone https://gitlab.com/intrazero/team2/erc.git
cd erc
```

### Install dependencies

```bash
composer install
npm install
```

### Set up environment file

Copy the `.env.example` file to `.env` and fill in your database and other environment variables.

```bash
cp .env.example .env
```

### Generate application key

```bash
php artisan key:generate
```

### Run migrations and seeders

```bash
php artisan migrate --seed
```

### Start the development server

```bash
php artisan serve
```

### Compile assets

```bash
npm run dev
```

## Usage

After installing the application, you can access the development server at `http://localhost:8000`.

### Admin Access

Use the following credentials to log in as an admin:

- **Email**: admin@example.com
- **Password**: password

## Seeding Data

To seed the database with initial data, you can use the following command:

```bash
php artisan db:seed
```

This will run all the seeders located in the `database/seeders` directory.

## Clearing Cache

To clear the application cache, you can use the following command:

```bash
php artisan cache:clear
```

## Contributing

We welcome contributions to the System Management project for the Egyptian Red Crescent! If you find a bug or have a feature request, please create an issue or submit a pull request. Make sure to follow the contribution guidelines.

### Contribution Guidelines

1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes with descriptive commit messages.
4. Push your branch and create a pull request.

## License

This project is open-source and available under the [MIT License](LICENSE).

## Contact

For any inquiries or support, please contact us at:

- **Email**: support@egyptianredcrescent.org
- **Phone**: +20 123 456 7890

---

Feel free to modify and expand upon this template to suit the specific needs and features of your project.
