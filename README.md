# Voyagers Beat (CodeIgniter 4)

The migrated CodeIgniter 4 version of the [Voyagers Beat](https://voyagersbeat.com) travel company website. Voyagers Beat is a Delhi-based travel company, active since 2017, that organises group departures, corporate trips, college trips, family trips, honeymoons and personalised trips to offbeat destinations across India.

> **Status:** Migrated from the earlier version of the site to CodeIgniter 4.

---

## Features

### Public website
- **Destination and package listings** – Himachal (Kasol, Manali, Spiti), Goa, Ladakh, Rajasthan, the North-East (Darjeeling, Shillong), Uttarakhand (Dehradun, Rishikesh) and more, with starting prices or "cost as per requirement"
- **Trip categories** – fixed-departure group tours, corporate trips, college and educational trips, family trips, honeymoon trips, solo and backpacking trips
- **Adventure activities** – trekking, camping, bike rides, road trips, river rafting, paragliding
- **Blog / travel guides** – destination guides and trek write-ups
- **About Us page** – company story and founder
- **Careers page** – open roles (sales, tour leading), perks and application info
- **Testimonials** – traveller reviews
- **Contact and enquiry** – phone, email, office address and social links
- **SEO-friendly pages** – structured data (company name, address, phone, social profiles)

### Technical
- Built on **CodeIgniter 4** (MVC)
- Clean routing, controllers, views and models
- Environment-based configuration via `.env`
- Responsive layout for mobile and desktop

> Please verify this list against the code and edit as needed: some items come from the live website rather than the source.

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | CodeIgniter 4 |
| Language | PHP 8.1+ |
| Database | MySQL / MariaDB |
| Frontend | HTML, CSS, JavaScript |
| Dependencies | Composer |

---

## Project Structure

```
ci4.voyagerbeat.com/
├── app/
│   ├── Config/        # Routes, database, app config
│   ├── Controllers/   # Page and feature controllers
│   ├── Models/        # Database models
│   └── Views/         # Templates
├── public/            # Web root (index.php, assets)
├── writable/          # Logs, cache, sessions
├── .env               # Environment config (not committed)
└── composer.json
```

---

## Getting Started

### Prerequisites
- PHP 8.1 or newer, with the `intl`, `mbstring`, `json` and `mysqlnd` extensions
- Composer
- MySQL or MariaDB

### Installation

```bash
git clone https://github.com/abhiib02/ci4.voyagerbeat.com.git
cd ci4.voyagerbeat.com
composer install
cp env .env
```

Edit `.env`:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = your_db
database.default.username = your_user
database.default.password = your_password
database.default.DBDriver = MySQLi
```

Run migrations (if the project includes them) and start the dev server:

```bash
php spark migrate
php spark serve
```

Open http://localhost:8080.

---

## Deployment

Point the web server's document root to the `public/` folder, set `CI_ENVIRONMENT = production` in `.env`, and make sure `writable/` is writable by the web server.

---

## Contact

Website: https://voyagersbeat.com

---

## License

Add your license here (e.g. MIT) or state that the project is proprietary.
