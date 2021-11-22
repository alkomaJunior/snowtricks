[![SymfonyInsight](https://insight.symfony.com/projects/c03de2bd-d868-4ca3-859e-498ebca3e276/big.svg)](https://insight.symfony.com/projects/c03de2bd-d868-4ca3-859e-498ebca3e276)

# snowtricks
SnowTricks is a community site that aims to make the public aware of the different tricks that exist.

## Tools & Technologies
* Symfony 5.2.14
* Composer 2.1.10
* Bootstrap 4.6
* jQuery 3.6.1
* PHPUnit 9.5.10
* WampServer 3.2.0
    * Apache 2.4.46
    * PHP 7.4.9
    * MySQL 8.0.21

## Installation
1. Clone the project :
```
    git clone https://github.com/alkomaJunior/snowtricks.git
```
2. Configure your environment variables such as the database connection or your SMTP server or email address in the `.env.local` file which should be created at the root of the project by making a copy of the `.env` file.

3. Download and install th backend dependencies with [Composer](https://getcomposer.org/download/) :
```
    composer install
```
4. Downlad and install the front-end dependencies with [Npm](https://www.npmjs.com/get-npm) :
```
    npm install
```
5. Build the assets folder into the public directory with [Npm](https://www.npmjs.com/get-npm) :
```
    npm run build
```
6. If the databse is not created yet use the following command to do that :
```
    php bin/console doctrine:database:create
```
7. Use the following command to execute migrations into the database with initials data :
```
    php bin/console doctrine:migrations:migrate
```

8. Now you're done, congratulations!! The project is well-installed.
