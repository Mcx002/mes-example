# Shoes MES

This first shoes mes project that we builded

## Installation

Install Composer in your project

```bash
composer install
```

Install Node in your project

```bash
npm install
```

## Create a copy of your .env file
`.env` files are not generally committed to source control for security reasons. But there is a .env.example which is a template of the `.env` file that the project expects us to have. So we will make a copy of the `.env.example` file and create a `.env` file that we can start to fill out to do things like database configuration in the next few steps.

```bash
cp .env.example .env
```

## Generate an app encryption key
Laravel requires you to have an app encryption key which is generally randomly generated and stored in your .env file. The app will use this encryption key to encode various elements of your application from cookies to password hashes and more.

Laravel’s command line tools thankfully make it super easy to generate this. In the terminal we can run this command to generate that key. (Make sure that you have already installed Laravel via composer and created an .env file before doing this, of which we have done both).

```bash
php artisan key:generate
```

## Start the project

To start the project out of the server is that mean you have to start laravel server in your command prompt

```bash
php artisan serve
```

Then if you have any changes in your javascript or scss or css file you have to compile that with:

```bash
npm run prod
```

or if you wanna always compile your code when you save your code you can run this command:

```bash
npm run watch
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

*Thank you for your attend*
