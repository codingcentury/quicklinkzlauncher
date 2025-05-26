uncher
A simple, self-hosted, password-protected link launchpad for your LAN or personal use.

🚀 Features
Add, edit, and delete links via a web interface
Password-protected admin actions (default: password)
Responsive dark theme
No database required (uses a simple JSON file)
Dockerized for easy deployment anywhere
🛠️ Quick Start (with Docker)
Clone this repo: git clone https://github.com/yourusername/quick-linkz-launcher.git cd quick-linkz-launcher

Build and run with Docker Compose: docker compose up --build > The app will be available at http://localhost:9697

Login as admin:
Use the default password: password

Change this password in index.php before using in production!

Stop the app:
Press Ctrl+C in your terminal, then: docker compose down

📝 Manual (Non-Docker) Setup
Copy all files to a folder on your PHP-enabled web server.
Make sure linkz.json is writable by the web server.
Edit index.php and set your own password ($admin_password).
Visit index.php in your browser.
📂 Folder Structure
quick-linkz-launcher/ ├── index.php ├── style.css ├── linkz.json ├── Dockerfile ├── docker-compose.yml └── README.md

🔒 Security
The default admin password is password for demo purposes.
Change the password in index.php before using on a real network or the internet!
🙌 Contributing
Pull requests are welcome!
Feel free to open issues or suggest features.

📄 License
This project is free to use, modify, and share.
MIT License.
