# Event management system

### Installation
Open the terminal and run the below commands
```shell
git clone https://github.com/ravitiwar/event-management.git
cd event-management
composer install
cp .env.example .env
php artisan key:generate
```
### Configuration
#### Database
open the `.env` file and edit the below details
```text
DB_HOST={your database host}
DB_PORT={{your databse port}
DB_DATABASE={your database}
DB_USERNAME={database user}
DB_PASSWORD={database password
```
Then run the below command in ternminal
```
php artisan migrate
```
#### Email
```text
MAIL_HOST={your SMTP host}
MAIL_PORT={your smtp port}
MAIL_USERNAME={your SMTP username}
MAIL_PASSWORD={your smtp password}
MAIL_ENCRYPTION="tls"
MAIL_FROM_ADDRESS={email from address}
```
#### Optional configuration
In case you want to reduce the load time at the time of inviting you can configure the worker in linux environment
Change `QUEUE_CONNECTION` option in `.env` file to 'database' and configure the supervisor in linux
[Click here](https://laravel.com/docs/8.x/queues#supervisor-configuration) to know how to install and configure supervisor

Now you will be ready for calling API
Visit the below url for api details
[https://documenter.getpostman.com/view/9021543/UVXjKG2t](https://documenter.getpostman.com/view/9021543/UVXjKG2t)
