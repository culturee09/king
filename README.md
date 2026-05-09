# Uru Minor Seminary Website

Premium Catholic seminary website for Uru Minor Seminary in Moshi, Tanzania.

## Project Structure

- `index.html` — Home page
- `about.html` — Our Heritage page
- `admissions.html` — Admissions page with multi-step form
- `contact.html` — Contact page with details and embedded map
- `style.css` — Global styling for the site
- `admission.css` — Admissions form styling
- `script.js` — Navigation and admissions form behavior
- `db_connect.php` — MySQL connection helper
- `process_admission.php` — PHP backend for admissions form submission
- `picha/` — Local image folder for all site visuals
- `database.sql` — Database creation script

## Local Setup

### 1. Install XAMPP

1. Download and install XAMPP for Windows (32-bit) from https://www.apachefriends.org.
2. Start Apache and MySQL from the XAMPP Control Panel.
3. Verify `localhost` and `localhost/phpmyadmin` open in your browser.
4. Place this project folder in your XAMPP `htdocs` directory, for example `C:\xampp\htdocs\king`.

### 2. Create the Database

1. Open phpMyAdmin at `http://localhost/phpmyadmin/`.
2. Create a database named `uruseminary`.
3. Import `database.sql` or run the SQL commands from that file.

### 3. Database Credentials

The default PHP connection settings are in `db_connect.php`:

- Host: `localhost`
- User: `root`
- Password: (empty)
- Database: `uruseminary`

If your XAMPP setup uses a password, update `db_connect.php` accordingly.

### 4. Add Local Images

Place all image files in the `picha/` folder. Recommended filenames:

- `hero.jpg`
- `heritage.jpg`
- `admissions.jpg`
- `contact.jpg`
- `campus1.jpg`
- `campus2.jpg`
- `campus3.jpg`
- `leader1.jpg`
- `leader2.jpg`
- `leader3.jpg`

You can use placeholders or your own photography. The site uses relative paths like `picha/hero.jpg`.

## Running the Site

Open `http://localhost/king/index.html` in your browser.

### Admissions Form

The admissions form submits to `process_admission.php`, which inserts records into the `admissions` table.

### Contact Form

The contact form submits to `process_contact.php`, which inserts messages into the `contact_messages` table.

### Admin Page

Visit `admin_login.php` to sign in and review admissions and contact submissions locally. This page uses a simple session login guard for your local XAMPP environment.

Default credentials:
- Username: `admin`
- Password: `King2026!`

Change these values directly in `admin_login.php` before using or deploying publicly.

## Notes

- The contact page uses a simple mailto form submission.
- The admissions backend is built with PHP and MySQL using prepared statements.
- Replace `<!-- EDIT THIS -->` placeholders in the HTML files with your official school content.
