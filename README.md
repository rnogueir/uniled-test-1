# UniLED Technical Test 1

This is the implementation of a contact form developed with PHP. No framework has been used - neither in the front nor in the back end, including unit tests.



## Architecture

For the sake of simplicity, a popular LAMP stack has been chosen:

- Ubuntu 18.04
- Apache 2.4.29
- MySQL 5.7.28
- PHP 7.2.25

This configuration is available as a virtual machine for Vagrant under `laravel/homestead`.


## How it works

The main application page builds the input form. A second page will receive the input fields, validate them, save the data and show a confirmation message; in case of invalid data, the user will be redirected back to the form and receive an error message showing the reason.

An asynchronous routine (cron job) is responsible for checking the latest entries and sending the respective e-mail.



## Installation steps

- clone repository into the staging/production server
- add PDO extension to PHP (if applicable)
- run `composer install`
- load the initial database dump into the MySQL installation of choice (dump available in the `database` folder)
- add MySQL and SMTP connection configuration into the `./.env` file
- set-up an Apache server pointing to the `public` folder
- add a cronjob task in order to run the mailing routine under the `jobs` folder
```
* * * * * php /path/to/uniled-test-1/jobs/mail.php >> /dev/null 2>&1
```



## Unit Test (to be completed)

- run with command:
```
$ php test/TestApp.php
```

