
# CakePHP Property Management System

This is a simple property management system built using CakePHP. It allows users to:
- Add, edit, and delete property listings.
- Upload and manage property photos.
- Search through the list of properties with a robust search feature.
- Display property information with pagination.

---

## Features
- **Add Property**: Create a new property entry with title, beds, baths, price, and an optional photo.
- **Edit Property**: Modify property details, replace or delete photos.
- **Delete Property**: Remove properties and their associated images.
- **Search Feature**: Search by title, beds, baths, or price.
- **Pagination**: View properties with a 5-row per page limit.
- **File Upload**: Upload photos for properties (with file validation).

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/your-repository-name.git
   ```

2. Navigate to the project directory:
   ```bash
   cd your-repository-name
   ```

3. Install dependencies using Composer:
   ```bash
   composer install
   ```

4. Create and configure your database:
   - Create a database in MySQL (or any supported DBMS).
   - Update the `config/app_local.php` file with your database credentials.

5. Run migrations to set up the database schema:
   ```bash
   bin/cake migrations migrate
   ```

6. Start the development server:
   ```bash
   bin/cake server
   ```

7. Visit the app at `http://localhost:8765`.

---

## Requirements
- PHP 7.4 or higher
- Composer
- CakePHP 4.x
- MySQL or any supported database

---

## Usage
1. Navigate to the `Properties` page.
2. Add, edit, or delete properties as needed.
3. Use the search bar to filter properties by title, beds, baths, or price.

---

## Contributing
Feel free to fork this repository and contribute. Pull requests are welcome!

---

## License
This project is open-source and available under the [MIT License](LICENSE).
