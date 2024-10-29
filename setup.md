## Operating System

Prepare fresh new `Linux Mint 21.3 Virginia` as Cinnamon with `ubuntu jammy 22.04`. Debian distribution.  
Run all necessity `apt-get update` and `apt-get dist-upgrade` before and after the software installation. Use `apt-get autoclean` and `apt-get autoremove`.  
Some packages, repositories and softwares require editing the terminal line to work with current ubuntu version and name instead of linux. Browse for jammy.  
The installation will ask to add keys and generate them, apt store and repository and their version url.  
Additional software and ubuntu core packages are required based on the following install.  

## Installation

Software to install:  
- mysql community server 8  
- mysql workbench 8  
- apache2 version 2.4.52  
- php 8.3.12  
- node 19.9.0  
- npm 9.6.3  
- VSCode or code 1.94.2  
- eclipse for php 2024-09  
- chrome 130  
- postman 10 (non cloud version)  
- composer 2.8.1  
- laravel 11  
- docker 27.3.1  

## Configuration

MySQL server contains auto generated user/password in `/etc/mysql/debian.cnf`, obtain it to login using workbench and create administrative user `root2laravel` with the same password and grant all global privileges on host `localhost`. Add and keep both connections. Laravel `.env` file is configured with the same mysql user and pass.  
Apache2 require special module to use php and by default will autoconfigure after install. Change the main directory and `/var/www/` to your local user home folder projects destination. Edit `/etc/apache2/apache2.conf` for main directory change to `Options Indexes FollowSymLinks Includes ExecCGI`, `AllowOverride All`, `Allow from all`, `Require all granted` or research your preference, comment `/var/www/` and copy directory `/home/user/projects/` with example `Options Indexes FollowSymLinks`, `AllowOverride None`, `Require all granted`. User main folder will generate security error on apache and htaccess requirement usually for no permissions update, change the permissions of the main user folder to access the path in destination project to `755` or `775`. Using symbolic links create your vhost by template in `sites-available` and `sites-enabled`. Add symlinks also of `mods-available` and `mods-enabled` for `php8.3.conf` and `php8.3.load`, if you are missing any additional mod check the installation errors and messages. Add to `/etc/hosts` vhost servername and configuration.  
PHP v8.3 requires many additional extensions as `mysqli`, check for `apt-get install php8.3` using tab and the internet support. Read the errors and messages for missing ext and install them.  
Node and npm are needed for `package.json` and `node_modules`, this includes `npm run build` and frontend. Usually install with `code`.  
VSCode IDE can be used for php development in addition to css and js, configure to skip `vendor` folder in search and filter as `node_modules`, whitespace rendering, install more extensions for php.  
Eclipse for php developers includes php8.3 experimental in 2024-09 release, install from archive folder and add to panel menu using Applets->Menu tab Menu, Open the menu editor, add item with url and icon to programming group, searching in the main linux menu for eclipse will allow add to panel. First start of eclipse will configure the workspace folder, change settings of PSR to `myPSR` by cloning your favorite and modify it. Enable whitespace rendering and any additional options. Create PHP project with name by selecting the `laravel-example1` folder, choose php8.3 and finish the steps. Folders `node_modules` and `vendor` must become library folder to skip the build, also right click and add exclude filter on them. Change file filter in Project Explorer to show dot files.  
Older version of Postman must be installed from the internet that disables autoupdate by editing the `hosts` file with the set of ips. Add to panel using the eclipse method for linux menu.  

## Docker

Docker requires first installation instructions and change of string to jammy distribution, can be inspected by the download url.  

```
sudo apt-get update
sudo apt-get install ca-certificates curl
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc

echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/ubuntu \
  jammy stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update

sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

sudo docker run hello-world
```

Proceed to download `docker-desktop-amd64.deb` and install all dependencies automatically.  
Requires virtualization support on the host machine.  

## Laravel

Follow the steps of installing `composer`, including making it global by moving the binary to the system directory as it is described on the website documentation.  
Do the same about `Laravel Installer` and use `PATH` line method described to make laravel global in the terminal.  
Creation of new project using `composer create-project laravel/laravel myprojectname`, also `laravel new myprojectname`. If the project folder is missing the `vendor` run `composer install` and `php artisan optimize`. After composer you have to install the `node_modules` by writing `npm install` and then `npm run build`, this will produce `manifest.json` and new files in the public directory.  
Adding assets to public folder as css, js and jpg.  
Create the database schema described in `.env` using workbench and execute `php artisan migrate:fresh`. For each change of migration list run `php artisan migrate`, table `migrations` shows the currently active.  
Host the example with `php artisan serve` instead of apache for ease. View on `http://127.0.0.1:8000`.  

The provided examples include: generate and edit of models, creation and update of tables for them, new controller, blade layout app template, route with view/api/download/messaging, seeding, traits, strong typing, Dependency Injection (DI) automation, form requests with rule validation, html validation, bulk operations with database and data mapping.  
