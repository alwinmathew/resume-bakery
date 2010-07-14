Steps for setting up Resume-Bakery on localhost server

1. Extract or copy the contents (install folder, admin.php, installer.php files) to /var/www folder.
2. Set the owner of resume-bakery folder as "www-data". This may be done by :
	a. Open terminal & execute the following command as root (or as sudo user)

		chown -hR www-data /var/www

3. Open web browser & go to "http://localhost/installer.php
4. Submit database details including host server name, MySQL user, MySQL password & MySQL database name
5. Now the Resume-Bakery database is set up succesfully.

Enjoy!
