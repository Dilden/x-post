# x-post by closingtags

## What is this?
A WordPress plugin for sharing published posts to various social media platforms and networks.

## Requirements
* Working WordPress installation
* [ngrok](https://ngrok.com/)
* `docker-compose` (optional)


## Installation
Set up a WordPress installation (via the next section) and then [clone this repo](https://github.com/Dilden/Ansible-Proxmox-Automation) into the plugins directory of the WordPress installation.

## Set up w/docker-compose
To set up a quick WordPress environment, a `docker-compose.yml` similar to this may be used:
```
services:
  db:
    image: mariadb:10.6.4-focal
    command: '--default-authentication-plugin=mysql_native_password'
    volumes:
      - db_data:/var/lib/mysql
    restart: always
    environment:
      - MYSQL_ROOT_PASSWORD=somewordpress
      - MYSQL_DATABASE=wordpress
      - MYSQL_USER=wordpress
      - MYSQL_PASSWORD=wordpress
    ports:
      - 33060:3306
  wordpress:
    depends_on:
      - db
    image: wordpress:latest
    ports:
      - "8000:80"
    restart: always
    volumes:
      - ./:/var/www/html
      - ./uploads.ini:/usr/local/etc/php/conf.d/uploads.ini
    environment:
      - WORDPRESS_DB_HOST=db
      - WORDPRESS_DB_USER=wordpress
      - WORDPRESS_DB_PASSWORD=wordpress
      - WORDPRESS_DB_NAME=wordpress
volumes:
  db_data:
```

## Development
To get this plugin to set valid webhooks for a development version of the site, a few things need to be done:
1) Be sure to install the [relative-url](http://wordpress.org/plugins/relative-url/) plugin. 
2) Set these options set in `wp-config.php` to forward traffic appropriately:
```
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
```
3) Start ngrok: `ngrok http --host-header=rewrite http://localhost:8000`
or a valid ngrok config might look like this:
```
version: "2"
authtoken: YOUR_TOKEN_HERE

tunnels:
  x-post:
    proto: http
    addr: localhost:8000
    host_header: rewrite
```
See [ngrok documentation](https://ngrok.com/docs/using-ngrok-with#wordpress) for more information.

## Permissions
It's inevitable to run into permissions issues. On initial setup, everything should work fine for the web server but
once ownership/permissions get changed, the WP Admin interface will start running into issues. The commands to set
default permisssion are:
`find /path/to/your/wordpress/install/ -type d -exec chmod 755 {} \;` for directories
`find /path/to/your/wordpress/install/ -type f -exec chmod 644 {} \;` for files
