# Quick Linkz Launcher
A very simple, minimalistic, self-hosted, password-protected links launchpad for your LAN or personal projects.
Great mini-app, PHP based with no JS required client side/browser for use in setups with different
dockerized applications as well as other personal quick links store launcher that greatly helps
keep track of your docker apps and the occupied server ports your docker apps use.
This was the initial inspiration for this app; to try keep track of and at the same time open
saved links in a new browser tab for convenience.
Enjoy!

🚀 Features
Add, edit, and delete links via a slim, web interface.
Password-protected admin actions (default: password).
Responsive dark theme.
No database required (uses a simple JSON file).
Dockerized for easy deployment anywhere.
🛠️ Quick Start (with Docker)
Find & Pull ready-made docker image from here:
https://hub.docker.com/r/codingcentury/quicklinkzlauncher

Clone this repo: git clone [https://github.com/yourusername/quicklinkzlauncher.git](https://github.com/codingcentury/quicklinkzlauncher.git) cd quicklinkzlauncher
Build and run with Dockerfile:
docker build -t quicklinkzlauncher:latest .
#Do not omit, or do not to paste the above command to your terminal/cli eaxactly as shown,
including the .(dot) at the end, otherwise the image will not be build and you will get an error.

After building the image you can then run it with this command:
docker run -d -p 9697:80 quicklinkzlauncher
after which you can then browse this app at http://localhost:9697
Login as admin:
Use the default password: password
Change this password in index.php before using in production!
Stop the app:
Type: docker stop quicklinkzlauncher

📝 Manual (Non-Docker) Setup
Copy all files to a folder on your PHP-enabled web server.
Make sure linkz.json is writable by the web server.
Edit index.php and set your own password ($admin_password).
Visit index.php in your browser.

📂 Folder Structure

quicklinkzlauncher/

  ├── index.php
  
  ├── style.css
  
  ├── linkz.json
  
  ├── Dockerfile
  
  ├── docker-compose.yml
  
  └── README.md

🔒 Security
The default admin password is 'password' (without the quotes) for demo purposes.
Change the password in index.php before using on a real network or the internet!
Suggested for personal closed and controlled network environments, i.e. LAN networks.
Not recommended for use in production.
If you decide to use this in a production setup, you are on your own.
No guarantees given and you are the sole responsible person or group of persons.

🙌 Contributing
Pull requests are welcome!
Feel free to open issues or suggest features.

📄 License
This project is free to use, modify, and share.
MIT License.

![Screenshot 2025-05-26 at 22-35-40 Quick Linkz Launcher](https://github.com/user-attachments/assets/ad0cf51e-b550-489e-8008-cbeb75d3a6b7)

![Screenshot 2025-05-26 at 22-36-45 Quick Linkz Launcher](https://github.com/user-attachments/assets/07089097-f7af-42e4-be78-e37d7fbafda6)

![Screenshot 2025-05-26 at 22-36-57 Quick Linkz Launcher](https://github.com/user-attachments/assets/bd77ef6e-6d52-42c2-9f54-99de55f149c8)
