## IpvDataTest

To start:

- Copy .env.example to .env
- `./vendor/bin/sail up` (keep this running in the background)
- `./vendor/bin/sail bash` (Make sure you're in the container)
- `composer install` (if dependencies are not already installed)
- `php artisan key:generate`
- `php artisan sail:install` (install mysql and redis)
- `php artisan migrate`
- `npm run install`

Open 2 terminals with: `./vendor/bin/sail bash` and run these in the background:

- `npm run dev` (keep this running in the background)
- `php artisan queue:work` (keep this running in the background)

App is running on: http://localhost

To check database:

- `./vendor/bin/sail mysql`

Stack:

- Laravel
- Vue3
- GraphQL (nuwave/lighthouse-php)
- Vuetify3
- ApolloVue
- Axios
