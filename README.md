<p align="center">
    <img height="60" src="https://user-images.githubusercontent.com/58954229/144369383-d6eda64c-b003-491c-a102-11e67d80c1f1.png"/>
<h1 align="center">Laravel Chat</h1>
</p>

## Laravel Live chatting web app with pusher
<p align="center">
<img src="https://user-images.githubusercontent.com/58954229/144369233-56820d2b-d800-4e82-ad43-e81902954879.png"/>
<img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
</p>

##

## Features 📝

🟣 Modern UI and responsive design.
<br/>
🟣 Real-time messaging events and invitations.
<br/>
🟣 Invite other users to new chat rooms.
<br/>
🟣 Real-time notifications and alerts.

## Getting Started 🚀
### Installation:
1. Clone Repo.
2. Install composer dependencies 
```composer install```.
3. Install NPM dependencies
```npm install && npm run dev```.
4. Create a copy of .env file
```cp .env.example .env```.
5. Generate an app encryption key
```php artisan key:generate```.
6. Create 'chat' database and run 
```php artisan migrate --seed```.
7. Sign up / sign in to pusher from [pusher website](https://pusher.com/).
8. Add your pusher credentials to .env by following pusher getting started document.
9. Run project using 
```php artian serve```and ```npm run  watch```.

### Technical Stack:
- Laravel (v8.1)
- Vue js (v3.0.5)
- Tailwindcss (v2.0.1)
- Inertia (v0.10.0)
### Packages/Libraries Used:
- Laravel Actions (v2.2)
- Laravel Jetstream Inertia (v2.4)
- Laravel Sanctum (v2.12)
- Laravel Echo (v1.11.3)
- Pusher js (v7.0.3)
- Vue Toastification (v2.0)

##
## License ⚖️
The Laravel Chat is open-sourced website licensed under the [MIT license](https://opensource.org/licenses/MIT).
