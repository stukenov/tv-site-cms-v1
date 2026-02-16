# TV Site CMS v1

A Drupal 10-based Content Management System tailored for television channel websites. This project includes custom modules and themes designed specifically for managing TV channel content, program schedules, and projects.

## Features

### Custom Modules

#### 1. TV Schedule Module (`tv_schedule`)
A comprehensive module for managing TV program schedules:
- Display TV program schedules on the website
- Admin interface for adding and managing programs
- Custom template for schedule display
- Configurable settings for schedule management
- Routes:
  - `/tv-schedule` - Public schedule display page
  - `/admin/config/media/tv-schedule` - Admin settings
  - `/admin/tv-schedule/add-project` - Add new project form

#### 2. TV Site Module (`tvsite`)
Core module providing foundational functionality for TV channel websites:
- Channel configuration settings
- Custom permissions for TV site management
- Admin interface for site-wide TV channel settings
- Routes:
  - `/admin/config/media/tvsite` - TV Site configuration

### Custom Themes

#### 1. B5 Subtheme (`b5subtheme`)
A Bootstrap 5-based theme with custom styling:
- Built on Bootstrap 5 framework
- Custom SCSS variables and styles
- Responsive design
- Custom regions for TV channel layout
- CKEditor stylesheets included

#### 2. TV Site Gin Theme (`tvsitegin`)
A Gin-based admin theme:
- Clean, modern admin interface
- Based on Gin theme
- Custom styling for TV site administration

## Requirements

- PHP 8.1 or higher
- Drupal 10.2 or higher
- Composer 2.x
- Web server (Apache/Nginx)
- Database (MySQL, MariaDB, PostgreSQL, or SQLite)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/stukenov/tv-site-cms-v1.git
cd tv-site-cms-v1
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the example environment file and configure your database settings:

```bash
cp .env.example .env
```

Edit `.env` and update the database configuration according to your setup.

### 4. Configure Drupal

Copy the example settings file:

```bash
cp web/sites/default/default.settings.php web/sites/default/settings.php
chmod 644 web/sites/default/settings.php
```

Edit `web/sites/default/settings.php` and configure your database connection. For SQLite (development):

```php
$databases['default']['default'] = [
  'database' => 'sites/default/files/.ht.sqlite',
  'prefix' => '',
  'driver' => 'sqlite',
  'namespace' => 'Drupal\\sqlite\\Driver\\Database\\sqlite',
  'autoload' => 'core/modules/sqlite/src/Driver/Database/sqlite/',
];
```

For MySQL/MariaDB (production):

```php
$databases['default']['default'] = [
  'database' => 'your_database_name',
  'username' => 'your_database_user',
  'password' => 'your_database_password',
  'host' => 'localhost',
  'port' => '3306',
  'driver' => 'mysql',
  'prefix' => '',
];
```

### 5. Install Drupal

Run the Drupal installation:

```bash
cd web
php core/scripts/drupal install
```

Or use the web installer by navigating to your site URL in a browser.

### 6. Enable Custom Modules

```bash
drush en tv_schedule tvsite -y
```

Or enable them through the admin interface at `/admin/modules`.

### 7. Set the Theme

Enable and set the custom themes:

```bash
# Enable the frontend theme
drush theme:enable b5subtheme
drush config:set system.theme default b5subtheme -y

# Enable the admin theme
drush theme:enable tvsitegin
drush config:set system.theme admin tvsitegin -y
```

## Usage

### Managing TV Schedules

1. Navigate to `/admin/config/media/tv-schedule` to configure schedule settings
2. Add programs via `/admin/tv-schedule/add-project`
3. View the public schedule at `/tv-schedule`

### Configuring TV Site Settings

1. Navigate to `/admin/config/media/tvsite`
2. Configure channel name and other site-wide settings

## Project Structure

```
tv-site-cms-v1/
├── web/
│   ├── modules/
│   │   └── custom/
│   │       ├── tv_schedule/     # TV Schedule module
│   │       └── tvsite/          # TV Site module
│   ├── themes/
│   │   └── custom/
│   │       ├── b5subtheme/      # Bootstrap 5 frontend theme
│   │       └── tvsitegin/       # Gin-based admin theme
│   ├── core/                    # Drupal core (excluded from repo)
│   ├── modules/contrib/         # Contributed modules (excluded from repo)
│   └── themes/contrib/          # Contributed themes (excluded from repo)
├── composer.json                # Composer dependencies
├── .gitignore                   # Git ignore rules
├── .env.example                 # Environment configuration example
├── LICENSE                      # MIT License
└── README.md                    # This file
```

## Development

### Installing Contributed Modules

Use Composer to install additional Drupal modules:

```bash
composer require drupal/module_name
```

### Theme Development

The custom themes use SCSS for styling. After making changes to SCSS files in `b5subtheme`, compile them:

```bash
cd web/themes/custom/b5subtheme
# Compile SCSS (you'll need to set up your preferred SCSS compiler)
sass scss/style.scss css/style.css
```

## Security Notes

- Never commit the `web/sites/default/settings.php` file with real credentials
- Use `.env` files for environment-specific configuration (not included in repository)
- Keep Drupal core and contributed modules up to date
- Review and apply security updates regularly

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

Copyright (c) 2025 Saken Tukenov

## Support

For issues, questions, or contributions, please open an issue on the GitHub repository.

## Acknowledgments

- Built with [Drupal](https://www.drupal.org/)
- Bootstrap 5 theme framework
- Gin admin theme
