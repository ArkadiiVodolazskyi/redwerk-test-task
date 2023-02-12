# Redwerk Test Task

## See on live site

### http://redolx.rf.gd/

[Admin panel](http://redolx.rf.gd/wp-admin):

> Username: **redwerk**

> Password: **redwerk**

or

### http://redolx.byethost11.com/

[Admin panel](http://redolx.byethost11.com/wp-admin):

> Username: **redwerk**

> Password: **redwerk**

---

## Develop locally

### Get files

Requires: [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git), [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos), [Docker](https://docs.docker.com/desktop/install/linux-install/), [Docker Compose](https://docs.docker.com/compose/install/other/).

1. Clone the repo into folder:

	> $ `git clone https://github.com/ArkadiiVodolazskyi/redwerk-test-task.git <path/to/folder>`

2. Install Wordpress themes, unzip Wordpress uploads folder, unzip database:

	> $ `composer install`

3. Download and install the enviroment to run Wordpress: Wordpress core, MySQL, phpMyAdmin, Mailhog:

	> $ `docker-compose up -d`

---

### Import database and login into the site

4. Open [phpMyAdmin](http://localhost:2001).

5. Log in to phpMyAdmin:

	> Username: **wordpress**

	> Password: **wordpress**

6. Import contentful database from db/wordpress.sql intro wordpress database:

	> `wordpress - Import - Browse - db/wordpress.sql - Import`.

7. Log into [site admin panel](http://localhost:2000/wp-admin/):

	> Username or Email Address: **redwerk**
	> Password: **redwerk**

### Build and watch assets

Requires: [NodeJS](https://nodejs.org/en/download/package-manager/), [NPM](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm/).

[Laravel Mix](https://laravel-mix.com/) is used as module bundler.

8. Install dependencies to run Node plugins:

	> $ `npm install`

9. Compile source files and put into theme folder:

	> $ `npm run build`

	or start watching assets source files to develop.

	> $ `npm run dev`

## Notable files and sections of code

- [Docker Compose settings](https://github.com/ArkadiiVodolazskyi/redwerk-test-task/blob/master/package.json)
- [Composer settings](https://github.com/ArkadiiVodolazskyi/redwerk-test-task/blob/master/composer.json)
- [NPM settings](https://github.com/ArkadiiVodolazskyi/redwerk-test-task/blob/master/package.json)
- [Laravel Mix settings](https://github.com/ArkadiiVodolazskyi/redwerk-test-task/blob/master/webpack.mix.js)
- The delay of sending email to the post author:
	- In code: [__constants.php:23](https://github.com/ArkadiiVodolazskyi/redwerk-test-task/blob/master/themes/redwerk/inc/_functions/__constants.php#L23)
	- In admin panel: [Settings - General](/wp-admin/options-general.php) - Затримка відправки email автору оголошення [minutes]
- Schedule an email after post published: [__rw_olx.php:85](https://github.com/ArkadiiVodolazskyi/redwerk-test-task/blob/master/themes/redwerk/inc/_functions/__rw_olx.php#L85)
- Source files for Laravel Mix: [src/](https://github.com/ArkadiiVodolazskyi/redwerk-test-task/tree/master/src)

---

![](/themes/redwerk/screenshot.png)