<p align="center">
    <img height="80" src="https://user-images.githubusercontent.com/58954229/144369383-d6eda64c-b003-491c-a102-11e67d80c1f1.png"/>
<h1 align="center">Laravel Chat</h1>
</p>

## Laravel Live chatting web app with pusher
<p align="center">
<img src="https://user-images.githubusercontent.com/58954229/144369233-56820d2b-d800-4e82-ad43-e81902954879.png"/>
    <img src="https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white"/>
    <img src="https://img.shields.io/badge/vuejs-%2335495e.svg?style=for-the-badge&logo=vuedotjs&logoColor=%234FC08D"/>
    <img src="https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white"/>
</p>


##

## Features 📝

🟣 &nbsp;&nbsp; Modern UI and responsive design.
<br/>
🟣 &nbsp;&nbsp; Real-time messaging events and invitations.
<br/>
🟣 &nbsp;&nbsp; Invite other users to new chat rooms.
<br/>
🟣 &nbsp;&nbsp; Real-time notifications and alerts.
<br/>
🟣 &nbsp;&nbsp; Private and public chat rooms.

##

## Getting Started 🚀
### Installation:
After cloning the repository:

```ruby
# Install composer dependencies
composer install

# Install NPM dependencies
npm install && npm run dev

# Create a copy of .env file
cp .env.example .env

# Generate an app encryption key
php artisan key:generate

# Create 'chat' database and run
php artisan migrate --seed

# Sign up / sign in to pusher.com

# Add your pusher credentials to .env by following pusher getting started document

# Run project using 
php artian serve
npm run watch
```
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
