# Laravel Logs

## Overview
This packages allows you to interact with the Laravel logs via artisan.

## Commands

### log:tail

`php artisan log:tail`

Automatically tail the current log file when using `single` or `daily` logs.

### log:list

`php artisan log:list`

List all the current log files.

### log:mail

`php artisan log:mail me@example.com[,you@example.com]`

Mail the current log file to an email or list of emails.

### log:delete

`php artisan log:delete`

Delete all the Laravel log files.
