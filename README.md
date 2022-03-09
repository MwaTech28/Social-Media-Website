# Mini-Social-Media-Website

# Screenshots
![mwasocialall2](https://user-images.githubusercontent.com/98475826/157348100-fa77a93a-f03f-441a-8f28-fdb30d822cd2.png)
![mwasocialall3](https://user-images.githubusercontent.com/98475826/157348305-df884e91-1df4-4d82-b972-96d28ece3f4d.png)

This is a simple responsive small scaled social media website that allows you to sign up and register an account, edit you profle information 
and engage in conversations through chat sessions. P.S. this app uses the wamp software (apache, mysql and php) with php my admin for the database 
gui so it can be tested on your local machine. You can as well put this app on a cloud server that supports apache, mysql and php like aws 
to make it go online.

I provided the database in the folder called database

Database name is Called: s1, aka (sample1)

# *Note: You need to install wamp for windows or lamp for linux (apache, mysql and php) for the next steps

The location where your wamp directory is saved create a file inside the folder www called MwaSocialMedia and add all the files that you downloaded under app
inside it eg  C:/wamp/www/MwaSocialMedia/(all the files under app includind pics and js folders)

copy or cut the file s1 in the database folder and add it to these specific locations below under wamp(location where your wamp application is installed)

For maria db which i used, port 3307 -> bin/mariadb/mariadb(your version name)/data/s1

If you prefer mysql, port 3306 -> bin/mysql/mysql(your version name)/data/s1

Once done with the steps above everything should be fine, run the app by typing this url on a browser -> localhost/MwaSocialMedia/home.php

# If you want to do things manually, custom editing follow the steps below

This is the way i have specified the database names with my code.

Take note of the key datatypes to use, I specified below

First table name is: users and the field names are id(auto increment),fname,lname,email,pass varchar(100),loc,age
Second table name is: proimg and the field names are id(auto increment),userid(int),status(int)
Third table name is: comments and the field names are id(auto increment),userid(int),com(varchar)


# Note: only enter the firstname and password of the database as the username and the password when loging in.

Forgive me for my too much exploration but i used a foreign key tactic of assigning a status attribute 
of the proimg(profile image) table to 0 or 1 for personal and default pictures that can be found on the pics folder

Note: user's personal image will replace the default picture upon editing the profile on the edit button
      of the user profile and a new profile image will be appended to the pics folder together with its 
      unique id name which is its user primary key of that particular session.
