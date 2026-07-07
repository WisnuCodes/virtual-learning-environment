# 🎓 Virtual Learning Environment (VLE)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Xendit](https://img.shields.io/badge/Payment-Xendit-blue?style=for-the-badge)

A comprehensive, enterprise-grade Online Learning System built with Laravel. This platform provides a seamless experience for both instructors to manage courses and students to learn interactively.

## ✨ Features

- **📚 Course Management:** Easy creation, editing, and management of courses and lessons.
- **💳 Integrated Payment Gateway:** Automated enrollment and payment verification using Xendit & Midtrans API.
- **🧑‍🏫 Multi-role System:** Dedicated dashboards for Admin, Instructors, and Students.
- **📝 Assessments & Quizzes:** Built-in quiz system with automated grading.
- **💬 Interactive Forums:** Discussion boards for students and instructors.
- **📜 Certification:** Automated certificate generation upon course completion.

## 🚀 Tech Stack

- **Backend:** Laravel (PHP)
- **Frontend:** Laravel Blade, HTML, CSS, JavaScript
- **Database:** MySQL
- **Payments:** Xendit / Midtrans

## 🛠️ Installation & Setup

Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/WisnuCodes/virtual-learning-environment.git
   cd virtual-learning-environment
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install NPM Dependencies**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your database and payment gateway (Xendit/Midtrans) credentials in the `.env` file.*

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Start the Development Server**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## 👨‍💻 Author

**WisnuCodes**
- GitHub: [@WisnuCodes](https://github.com/WisnuCodes)
- Email: wisnunugraha.dev@gmail.com

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
