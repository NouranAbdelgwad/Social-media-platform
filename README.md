# 💥 My Latest Full-Stack Project: Social Media Platform

This platform allows users to create profiles, share posts, like and comment on posts, and follow each other. It’s designed to be user-friendly and responsive across all devices.

---

## 🎥 Website Video:
[Check out the demo video here: [Insert your video link]](https://github.com/user-attachments/assets/43c89210-b640-4ae3-95ee-0f3c2a000b1e)

---

## 👩🏻‍💻 Technologies Used:

### Front-end:
- HTML
- CSS
- JavaScript
- Bootstrap

### Back-end:
- Laravel

### Database:
- MySQL

## 🔮 Future Work:
I plan to add real-time chat functionality using web sockets to enhance user interaction!



## 🛠️ Installation and Usage Instructions

### Prerequisites:
- **XAMPP**: Ensure XAMPP is installed and running on your machine. 🖥️
- **Composer**: Make sure you have Composer installed to manage Laravel dependencies. 📦
- **Git**: Install Git to clone the repository. 🧑‍💻

### Steps to Install the Project:

1. **Clone the Repository**:
    ```bash
    git clone https://github.com/YourUsername/Social-Media-Platform.git
    ```
   
2. **Navigate to the Project Directory**:
    ```bash
    cd Social-Media-Platform
    ```

3. **Install Dependencies**:
    Run the following command to install the required PHP packages:
    ```bash
    composer install
    ```

4. **Set Up the Environment File**:
    Copy the `.env.example` file to create your `.env` file:
    ```bash
    cp .env.example .env
    ```

5. **Configure the Database**:
    Open the `.env` file in your code editor and update the following lines to match your XAMPP database configuration:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=social_media
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. **Create the Database**:
    - Open phpMyAdmin by navigating to [http://localhost/phpmyadmin](http://localhost/phpmyadmin) 🌍
    - Create a new database with the name specified in your `.env` file (`social_media`). 🗂️

7. **Run Migrations**:
    Run the following command to create the necessary tables:
    ```bash
    php artisan migrate
    ```


## 🔑 Key Functionalities:

### Responsive Design 📱:
Ensures that the platform is optimized for desktops, tablets, and smartphones with a user-friendly layout that adapts to different screen sizes.

### Authentication 🔒:
Users can register, log in, and manage their accounts securely. Features include password recovery and email verification.

### User Profiles 🧑‍🤝‍🧑:
Allows users to create and edit profiles, upload profile pictures, and share posts.

### Likes, Comments, and Follows 👍💬:
Enables users to like, comment on posts, and follow each other, fostering engagement within the platform.
