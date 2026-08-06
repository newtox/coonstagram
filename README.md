[![CC BY-NC-SA 4.0][cc-by-nc-sa-shield]][cc-by-nc-sa]

This work is licensed under a
[Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License][cc-by-nc-sa].

[![CC BY-NC-SA 4.0][cc-by-nc-sa-image]][cc-by-nc-sa]

[cc-by-nc-sa]: http://creativecommons.org/licenses/by-nc-sa/4.0/
[cc-by-nc-sa-image]: https://licensebuttons.net/l/by-nc-sa/4.0/88x31.png
[cc-by-nc-sa-shield]: https://img.shields.io/badge/License-CC%20BY--NC--SA%204.0-lightgrey.svg

# Coonstagram

Welcome to the **Coonstagram** repository! This is a Laravel-based social media clone inspired by the in-universe app from *South Park: The Fractured but Whole*, featuring a full feed system, profiles, moderation tools, and a dark, purple-accented UI.

> This is a non-commercial fan/learning project. South Park, its characters, and all related trademarks belong to their respective owners. No original assets, images, or dialogue from the show are included — character names are used purely as an homage.

## Overview

- **Functionality**: A social feed with posts, likes, comments (with replies), follows, profiles, admin moderation, and multi-language support
- **Technology**: Built with Laravel 12, Blade + Tailwind CSS, Alpine.js for interactivity, and a Nix flake for a reproducible dev environment

## Features

- Auth (register, login, password reset, email verification) via Laravel Breeze
- Feed with "For you" / "Following" filters, text and image posts
- Likes, comments, and threaded replies — all AJAX-driven, no page reloads
- Follow/unfollow, profile pages with follower/following lists in a modal
- Profile editing (avatar, bio, username, password, account deletion)
- Admin tools: post as any seeded character, user management (promote/demote admins, delete accounts)
- DE/EN language switcher covering UI text, validation, and auth messages
- Custom-styled error pages (403/404/419/429/500)

## How to Use

### Prerequisites

- **PHP 8.4+**: Ensure PHP is installed with required extensions (`pdo_mysql`, `mbstring`, `xml`, `curl`, `zip`, `bcmath`, `intl`, `fileinfo`)
- **Composer**: For PHP dependency management
- **Node.js & NPM**: For frontend asset compilation
- **MySQL/MariaDB**: For database management

A [Nix flake](./flake.nix) is included if you prefer a reproducible dev shell (`nix develop`) instead of installing PHP/Node manually.

### Installation

1. **Clone this repository**:
   ```bash
   git clone git@github.com:newtox/coonstagram.git
   cd coonstagram
   ```

2. **Setup**:
   - Create a `.env` file based on the provided `.env.example`:
     ```bash
     cp .env.example .env
     ```
   - Configure your database and mail settings in `.env`

3. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

4. **Application Setup**:
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   npm run build
   ```

### Core Dependencies

#### Backend (composer.json):
- **Laravel Framework**: ^12.0
- **Laravel Breeze**: Auth scaffolding
- **Resend PHP**: Transactional email delivery

#### Frontend (package.json):
- **Tailwind CSS**: Utility-first styling
- **Alpine.js**: Lightweight interactivity (modals, AJAX likes/comments, dropdowns)
- **Vite**: Asset bundling

### Usage

- Access the application at `http://127.0.0.1:8000`
- Log in with a seeded character account (e.g. `kyle_broflovski@southpark.test` / `password`) or the admin account (`you@southpark.test` / `password`)

## Contributing

Want to improve Coonstagram? Here's how:

1. **Fork** the repository
2. **Create** a feature branch: `git checkout -b feature/your-feature`
3. **Commit** your changes: `git commit -m 'Add: your feature'`
4. **Push** to your branch: `git push origin feature/your-feature`
5. Submit a **pull request**

## License

This project's code is licensed under the **Creative Commons Attribution-NonCommercial-ShareAlike (CC BY-NC-SA)** License.

- **License**: [CC BY-NC-SA 4.0](https://creativecommons.org/licenses/by-nc-sa/4.0/)

By contributing, you agree that your contributions will be licensed under the same license. This license covers the code in this repository only — it does not grant any rights to South Park-related names, characters, or trademarks.

## Contact

Have questions or found a bug?
- Open an issue on GitHub
- Or reach out to me at [contact@placeholder.de](mailto:contact@placeholder.de)