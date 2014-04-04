codeigniter-gettext-poeditor
============================

POEditor integration on CodeIgniter


Installation
===================

Copy all files from application/{config,libraries,controllers,locale} to your
projects.

You must edit the application/config/languages.php file and set your
API informations (key and project ID).


How to Use
====================

To extract all strings and sync with POEditor, you must execute this
command from shell :

```php
php -q index.php cli translate
```

You can look the application/controllers/cli.php file and adjust the
code based on your own need.

On your scripts, you can use standard gettext tags like :

```php
$string = _("This is a test string"); 
```


[Joel Vandal - CodeIgniter Gettext POEditor Library](http://joel.vandal.ca/)
