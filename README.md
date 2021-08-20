# **HEAD**
### Software Engineering Project

## Higher Education Applicant Database (HEAD)

HEAD manages a database for all the students of I.O.E applying abroad for higher education (Master's  Level and above) through a simple and light-weight web interface.
There are 3 uses categories in HEAD System. They are:
- Adminnistrator
- Student
- Teacher
## **Installation Notes**

To get our system up and running on your device *with your device as **localhost***, you will need to install the following:
- Apache Server
- php
- MySQL
*For Windows Devices*,We recommend you install the complete package "[Wamp Server](https://www.wampserver.com/en/)" , which also includes [phpMyAdmin](https://www.phpmyadmin.net/) needed to manage your database.
*For Linux Devices*, use [XAMPP](https://www.apachefriends.org/download.html) to run the server.

### Setting up the connection to database
In the files connect_todb.php present in ./php and ./admin , users need to edit and write their credentials in order to successfully establish connection to databse.
``` php
$sqldb = new mysqli('localhost', 'USERNAME', 'PASSWORD');
```
| USERNAME | PASSWORD |
| ------ | ------ |
|sql server username | sql server password|

##### Note: Teacher and Student users can not sign up and Administrator must add data for student and teacher in the database
