
# Xstros - Support panel

A laravel based support panel made specific for customer to create tickets and see their stripe transactions in real time. The application gets trough stripe API the transactions of the user and let the user view them in the panel. Likewise they can create tickets and reply to them including staff.


[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://github.com/Scraayp/xstros-support-panel/blob/master/LICENSE)

## Authors

- [@scraayp](https://github.com/scraayp)


## Demo

You can view the page at: https://support.xstros.xyz


## Installation

- Clone the repository:
```bash
# FOR SSH
git clone git@github.com:Scraayp/xstros-support-panel.git
# FOR HTTPS
git clone https://github.com/Scraayp/xstros-support-panel.git 
```

- Install sail in the folder:
```bash
cd xstros-support-panel
# Install sail packages.
composer require laravel/sail --dev
# Install sail in the directory
php artisan sail:install
# Start the docker containers.
./vendor/bin/sail up
```

- Install all dependencies:
```bash
# Install all packages
./vendor/bin/sail composer install
# Install all modules
./vendor/bin/sail npm install
```

- Run the migrations:
```bash
./vendor/bin/sail artisan migrate
```
