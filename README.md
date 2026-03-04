# 🚀 LaraQuiz Native

A powerful, cross-platform Quiz Management System built with **Laravel 12**, **Livewire**, and **NativePHP**. This application allows teachers to manage MCQs and Quizzes while providing students with a seamless mobile-friendly interface to take exams.



---

## ✨ Features

- **Dual Dashboard:** Separate, secure interfaces for Teachers and Students.
- **Teacher Panel:** - Manage Questions (Create, Read, Update, Delete).
    - Manage Quizzes (Organize questions into specific exams).
- **Student Experience:**
    - Real-time Quiz player powered by Livewire.
    - Responsive UI optimized for mobile devices.
- **Cross-Platform:** Runs as a Web App, Desktop Software (Electron), and Mobile App (Bifrost).
- **Secure Access:** Role-based redirection based on teacher email white-listing.

---

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Frontend:** Livewire, Tailwind CSS
- **App Wrapper:** NativePHP (Electron & Mobile)
- **Database:** SQLite (Native Friendly)

---

## 🚀 Installation & Setup

### 1. Clone the repository

git clone [https://github.com/Nvd063/LaraQuiz-Native.git]
cd LaraQuiz-Native
2. Install DependenciesBashcomposer install
npm install && npm run dev
3. Environment ConfigurationBashcp .env.example .env
php artisan key:generate
Note: Ensure DB_CONNECTION=sqlite is set in your .env.4. Database SetupBashtouch database/database.sqlite
php artisan migrate
php artisan db:seed --class=UserSeeder
📱 Running as an App (NativePHP)Desktop AppTo launch the project as a desktop application:Bashphp artisan native:serve
Mobile App (Bifrost Jump)To test the app on your mobile using the Bifrost app:Bashphp artisan native:jump
Scan the generated QR code with the Bifrost app on your phone.🔒 Credentials (Default)
RoleEmailPassword: Teacherteacher@quiz.com/12345678
Student:  ahmad@gmail.com/12345678


<img width="1920" height="1543" alt="image" src="https://github.com/user-attachments/assets/3d5a2ade-e613-44d4-ac98-3ffc4736408d" />
<img width="1920" height="1277" alt="image" src="https://github.com/user-attachments/assets/194d3d9d-fee8-48cf-9359-8445a5d769f6" />
<img width="1920" height="1002" alt="image" src="https://github.com/user-attachments/assets/543f2327-b990-4b07-9027-ca8905955aec" />

