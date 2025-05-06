#  Game Distribution Management System

A full-stack web application built using PHP and MySQL to manage the digital and physical distribution of video games. The system enables CRUD operations for entities like games, companies, stores, platforms, gamers, and support tickets. Deployed live, the platform integrates AJAX-based modals, normalized relational schema, and real-time interface updates.

---

##  Features

-  Full CRUD support for:
  - Games
  - Gamers
  - Companies (Publishers/Developers)
  - Stores
  - Platforms (Console, PC, Mobile)
  - Support Tickets
-  Asynchronous form handling using **AJAX**
-  Structured with **modular PHP scripts** and **PDO-based DB abstraction**
-  Input validation and **SQL injection protection**
-  Dynamic search, filter, and update interfaces
-  Normalized relational **MySQL schema** with many-to-many and one-to-many relationships
-  Responsive, mobile-friendly layout using **Bootstrap 5**
-  Deployed via **Apache** on a live hosting server without reliance on local stacks like XAMPP

---

##  Tech Stack

| Layer        | Technologies                                   |
|--------------|------------------------------------------------|
| Frontend     | HTML5, CSS3, Bootstrap 5, JavaScript, AJAX     |
| Backend      | PHP (modular), PDO, Apache                     |
| Database     | MySQL (normalized schema, join queries)        |      |

---

##  Entity Relationships

-  A **Game** can be linked to many **Platforms** and **Stores**
-  A **Company** can develop/publish many **Games**
-  A **Gamer** can own many **Games** and use multiple **Platforms**
-  **Support tickets** are linked to individual **Gamers**
-  Relationships implemented with **foreign keys** and **join queries**

---

## 🛠 Setup Instructions

1. Import the database:
   ```bash
   mysql -u root -p < GameDistribution.sql
Configure dbconfig.php with your DB credentials:

php
Copy
Edit
$host = 'localhost';
$dbname = 'GameDistribution';
$username = 'root';
$password = 'yourpassword';
Upload files to your PHP-enabled server (e.g., Apache).



📸 Screenshots
![image](https://github.com/user-attachments/assets/dbf29726-8ffe-4348-8aaf-59907a6f1842)
![image](https://github.com/user-attachments/assets/4e8d697f-f1dc-42bb-bfeb-706d3b094d3d)


 Author
Max Djafarov
Computer Engineering | University of Kansas (May 2025)

 License
This project is open-source and available under the MIT License.
