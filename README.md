#MagneticOne, welcome to my test work

My name is Viktor Martsiv i'm from Rivne

My email: vitia@protonmail.com

My work email: martsivwork@gmail.com

##How to up a project
1. Clone my gitHub project as you like
2. Create in your mysql new DB. Set name for DB, again, as you like.
3. Create config file for nginx or add the virtual host for Apache
4. cd to folder with project and do command ``composer install``. ( before a _composer install_  command make sure you have installed a composer
https://getcomposer.org/ )
5. Set db connection in file `./config/autoload/development.local.php` ( if file do not exist then make copy from  _./config/autoload/development.local.php.dist_ )
6. Set Shopify API configuration in `./config/autoload/development.local.php`  
7. Next step is to up DB migration. Use a command: ` ./vendor/bin/doctrine-module migrations:migrate ` 
8. To upload products from shopify API use a command: `./vendor/bin/laminas shopify:upload-products `
9. And go to the browser on your local domain
 
 PS:_I hope all gon okay :)_

##My environment: 
- PHP 7.4.11 (Xdebug v2.9.0, Zend OPcache v7.4.11) 
- Nginx 1.19.2
- MySql  Ver 8.0.21 for osx10.15 on x86_64 (Homebrew)
- macOS Catalina 10.15.7
- Composer version 1.10.13
- IDE PhpStorm 2020.2.2

##My Nginx conf
```
server {
	listen       80;
	server_name  laminasapp.local;
	root         /path/to/the/magnetic-one-test/public/;
	index index.php;

	location / {
		try_files $uri $uri/ /index.php?$query_string;
	}

	location ~ \.php$ {	
                try_files      $uri = 404;
                fastcgi_pass   127.0.0.1:9000;
                fastcgi_index  index.php;
                fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include        fastcgi_params;
        }
}
```

