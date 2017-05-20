shoplo
======

A Symfony project created on May 20, 2017, 3:02 pm.


1. Create user with pass:
$ php bin/console fos:user:create USER_NAME USER_MAIL USER_PASS

2. Promote user
$ php app/console fos:user:promote USER_NAME ROLE_ADMIN

----

3. Tests:
- in /tests/AppBundle/Controller/ApplicationAvailabilityFunctionalTest.php change user name and password:
'PHP_AUTH_USER' => '*USER_NAME*',
'PHP_AUTH_PW' => '*USER_PASSWORD*',
