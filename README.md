## Basic Instructions to run my web app

1. This project use SQLite Database which is already present in Database Folder.
2. But As metioned in the email, ive changed it to Mysql. But you might need to change database configuration according to your machine. please make adjustments to env file accordingly.
3. You'll need php 8.3, mysql and composer for this project to run
4. clone the project and navigate to the folder.
5. open terminal and run composer install (this will installed built-in laravel dependencies and packages needed)
6. once it's done, run php artisan migrate to start the project and follow the link generated in console to open project in browser.

7. You Will be welocmed with a sign-in page by default where you have to login using phone no. and password
8. If not registered, use link in the page to 'Sign up'.
9. Enter Basic Details and phone and password. After Entering, you will be redirected to Sign in page.
10. If an account with same phone number exists, you'll get an error.
11. During Sign in, if entered phone and password correctly, you'll be redirected to verify page where you have to enter an otp. As described in task, ive sent the otp in console. Open console and check and youll find the needed otp to login.

12. Upon successful login, youll be redirected to customers dashboard where you will find customers, and in navbar, there is a dedicated section to manage states.
13. In states table, there are options to edit, delete and see the cities of the corresponding States.
14. Similarly, the cities have pincodes in same way and you can add, edit, update and delete any data.
15. Use the logout link from navbar to logout and you'll be redirected to the login page again.

## Note

