# Bonnier Publications Coding Challenge
This repository contains a [Laravel](https://laravel.com/docs/7.x) and [VueJS](https://vuejs.org/) starter application, that doesn't quite work.

There are specified some tasks below, which needs to be solved to complete this coding challenge.

1. Don't fork the repository, please download/clone the source code instead.
2. Create a github public repository and push your solution to the repository master branch.
3. Send the repository URL to us. 

The estimated time spent on this challenge is around 5 hours.

## Project description
Bob is a freelancer that wants to keep track of how much time he spends working on different projects.
At any given time he is working on different projects, giving each of them a unique name.
He needs to be able to log the date, the time he starts, and the time he stops working on a project, so that he knows how much time (hours, minutes, seconds) in total he has spent on it.
He needs to be able to start and stop the same project multiple times.
For a GUI, Bob does not need much, but he must be able to see an overview of the time spent on his projects, create new projects, and add entries to existing ones.

## Tasks:
These objectives are mandatory:

- New user registration should be disabled. 
- Implement database user seed with email test@example.com (for testing purpose).
- If the user isn't logged in, all URLs should redirect to the login page.
- Verify project names are unique and display error when submitting existing name.
- Calculate total time (hours, minutes, seconds) spend on project and display in the overview.
- Add functionality to support adding entries to projects.
- Make auth middleware global, instead of in constructors of controllers.
- It should be possible to delete entries and projects.
- Readme file of how to boostrap (setup) your solution, so we can run it on our computer.

## Bonus:
These objectives are optional:
- Add tests to prove functionality.
- Improve existing code, if anything sticks out to you.
- When adding or updating a project, make the project overview automatically update.

## Readme how to bootstrap
Download og clone Repository.
From project root folder run these commands.
- composer install
- composer dump-autoload
- npm install
- npm run dev  (or)   npm run prod
- php artisan cache:clear
- php artisan config:clear
- php artisan migrate:fresh --seed
- php artisan serve
- navigate to http://127.0.0.1:8000/home
- login with test@example.com pass test1234
For testing run
- php artisan test
