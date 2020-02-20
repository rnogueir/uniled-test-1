# UniLED Technical Test 1

This is the implementation of a contact form developed with PHP. No framework has been used - neither in the front nor in the back end, including unit tests.



## Structure

For the sake of simplicity, a popular LAMP stack has been chosen.

The Form class is responsible for validating the input data, saving it into the database and calling an e-mail service.



## Installation

- clone repository into the staging/production server
- add PDO extension to PHP (if applicable)
- run `composer install`
- load the initial database dump into the MySQL installation of choice (dump available in the `database` folder)
- add MySQL and SMTP connection configuration into the `./.env` file
- set-up an Apache server pointing to the `public` folder
- add a cronjob task in order to run the mailing routine under the `jobs` folder
```
* * * * * cd /path/to/project/jobs && php mail.php >> /dev/null 2>&1
```



## Unit Test

- run with command:
```
$ php test/TestApp.php
```

