## c9ui

![c9ui](http://i.imgur.com/BSbwbfh.jpg)

c9ui is a very simple PHP web app using the [Lumen framework](http://lumen.laravel.com/) allowing you to manage your [Cloud9 IDE (c9/core)](https://github.com/c9/core) workflows on your own server without the need of a terminal.

### Installation

#### Install c9/core 

[Official installation instructions here](https://github.com/c9/core). As easy as:
```
git clone git://github.com/c9/core.git c9sdk
cd c9sdk
scripts/install-sdk.sh
```

#### Install c9ui

Install c9ui on the same server and with the same user you installed c9/core. c9ui needs:
- php >= 5.5.9
- lumen-framework 5.1.*
- sqlite
- nohup
- shell_exec allowed

```
git clone git://github.com/orditeck/c9ui.git c9ui
cd c9ui
touch database/database.sqlite
cp .env.example .env
composer install
php artisan migrate
```

Now open your `.env` file and fill in the `APP_KEY` setting ([32 chars random string](http://randomkeygen.com/)) and (if needed), serve the application on the PHP development server:

```
php artisan serve
```

c9ui should now be up and running on [http://localhost:8000](http://localhost:8000). I personally created a vhost with Apache using a subdomain, for example c9ui.mysite.com with an HTTP Basic Auth, pointing to `lumen/public` folder.

### Configuration

c9ui needs some basic information before you can start using it. 

| Setting                       | Example value                 | Required  |
| ----------------------------- | ------------------------      | :-------: |
| Home user path                | /home/c9ui                    | Yes |
| NodeJS full path              | /usr/bin/nodejs               | Yes |
| Cloud9 server.js full path    | /home/c9ui/c9sdk/server.js    | Yes |
| Default options               | --listen 0.0.0.0 --auth test:test |  No |

### About
This is my first open source project. This is just for fun. Don't expect more than what there is now, unless you create a pull request :-)
