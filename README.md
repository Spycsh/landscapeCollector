# landscapeCollector
------------------------------------------------------------
## Introduction
Landscape Collector is a website to collect the landscapes from different users. 
The users can upload the beautiful landscape images where they visited or lived with comments and location details to it.
Users can also choose to what extent they recommend the landscape when creating one record. 
Users can read others' records and landscapes, but they can only edit or delete their own records. 
It is also possible for users to search landscape records by country, city or user name who created the record. 

------------------------------------------------------------
## Operating environment
The website can go well on Microsoft Edge, Chrome and also Firefox.

------------------------------------------------------------
## Operating the software
Activate the eclipse and import the files.
The project hierarchy:

```
+--controller
|    +--ChangePageController.php
|    +--DBController.php
|    +--login_process.php
|    +--logout.php
|    +--RecordController.php
|    +--RegisterController.php
|    +--SearchController.php
+--css
|    +--CreateRecordWindow.css
|    +--font-awesome.min.css
|    +--img
|    |    +--informationBtn.png
|    |    +--logo.png
|    |    +--logout.png
|    |    +--star-off.png
|    |    +--star-on.png
|    |    +--starOff20.png
|    |    +--starOn20.png
|    +--login.css
|    +--main.css
|    +--mainPage.css
|    +--register.css
|    +--ShowRecordWindow.css
|    +--star-off.png
|    +--star-on.png
|    +--style.css
+--fonts
|    +--fontawesome-webfont.woff2
+--Initialization.php
+--js
|    +--back.js
|    +--changePage.js
|    +--createValidation.js
|    +--deleteRecord.js
|    +--editRecord.js
|    +--editValidation.js
|    +--jquery.min.js
|    +--registerTip.js
|    +--registerValidation.js
|    +--search.js
|    +--showRecord.js
+--model
|    +--Record.php
|    +--User.php
+--uploads
|    +--RecordImage
|    |    +--Berlin.jpg
|    |    +--Fussen.jpg
|    |    +--hamburg-church.jpg
|    |    +--...
|    +--userProfile
|    |    +--admin.jpg
|    |    +--default.jpg
+--window
|    +--CreateRecordWindow.php
|    +--EditRecordWindow.php
|    +--login.html
|    +--mainPage.php
|    +--register.html
|    +--ShowRecordWindow.php
```

1. First, you need to open the controller folder and open DBController.php

2. Find the code in line 6 and change the port with your own.

```
    // remember to change the port number!
    var $servername = "127.0.0.1:3307";
```

3. Please delete the landscapecollector database orginally exists in your database first. Then, it is very important to run our landscapecollector.sql in your database. There should be two tables after your running the file, which are user and record tables.

4. Run the Initialization.php with your port

```
http://localhost:8181/Assignment3/LandscapeCollector/Initialization.php
```

5. open the login.html

------------------------------------------------------------
## Change log
11/01/2020 ver1.0.0 First Version

------------------------------------------------------------
## Contact information

sihan.chen@stud.th-luebeck.de

zidi.chen@stud.th-luebeck.de

ce.song@stud.th-luebeck.de

------------------------------------------------------------
## That is all, thank you for your reading!
