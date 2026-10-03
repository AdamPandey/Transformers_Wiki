# transformers_wiki

A small Laravel app that lists Transformers movies and TV series (18 seeded entries, from the 1984 series to Transformers One) with search, a director filter, pagination and create / edit / delete. Each entry is a title, release year, director and a poster image. User login comes from Laravel Breeze.

Built over 19 commits between 2024-10-21 and 2024-11-10.

## Stack

- PHP ^8.2, Laravel 11 (locked at 11.30.0)
- Laravel Breeze 2.2 (Blade stack) for register / login / password reset / profile
- Tailwind CSS 3, Alpine.js 3, Vite 5
- Database: `.env.example` is set to SQLite; the committed `.env` is set to MySQL (see below)
- PHPUnit 11, Laravel Pint, Sail (dev dependencies, stock)

## Running it

These are the standard Laravel steps; the project has no custom setup.

```
composer install
npm install
cp .env.example .env     # skip if you keep the committed .env
php artisan key:generate
php artisan migrate --seed
npm run dev              # or: npm run build
php artisan serve
```

Notes:

- `.env.example` uses SQLite. With that, create the database file before migrating: `touch database/database.sqlite`.
- The committed `.env` uses `DB_CONNECTION=mysql`, so with it you need a running MySQL server and a database matching the `DB_*` values in that file, or change them.
- `SESSION_DRIVER`, `CACHE_STORE` and `QUEUE_CONNECTION` are all `database`, which is why the cache and jobs migrations exist.
- `php artisan migrate --seed` runs `DatabaseSeeder`, which only calls `MovieSeeder`. No user is seeded, so register one in the browser to reach `/dashboard` or `/profile`.
- `npm run dev` and `npm run build` are the only npm scripts.
- Tests: `php artisan test`. They are the Breeze auth and profile tests plus the two stock example tests. Nothing tests the movie pages.

## Structure

```
app/Http/Controllers/MovieController.php   all movie CRUD, search, filter, pagination
app/Http/Controllers/Auth/                 Breeze auth controllers
app/Http/Controllers/ProfileController.php
app/Models/Movie.php, User.php
app/View/Components/                       MovieCard, MovieDetails, MovieForm, AlertSuccess, layouts
database/migrations/                       users, cache, jobs, movies
database/seeders/MovieSeeder.php           the 18 entries
resources/views/movies/                    index, show, create, edit
resources/views/components/                movie-card, movie-details, movie-form, alert-success, Breeze components
resources/views/layouts/                   app, guest, navigation
public/images/movies/                      1.jpg to 18.jpg poster images, plus uploaded posters
routes/web.php, routes/auth.php
```

## How it works

There is one model besides `User`: `Movie`, with columns `title` (string), `release_date` (integer, a year), `image` (text, a file name), `director` (string) and timestamps. There are no relations. The director is a plain string on the movie, not a separate table.

Routes in `routes/web.php` are written out one by one rather than with `Route::resource`:

| Method | Path | Action |
| --- | --- | --- |
| GET | `/movies` | `index`, accepts `search` (title) and `director` query parameters, 6 per page |
| GET | `/movies/create` | `create` |
| POST | `/movies` | `store` |
| GET | `/movies/{movie}` | `show` |
| GET | `/movies/{movie}/edit` | `edit` |
| PUT | `/movies/{movie}` | `update` |
| DELETE | `/movies/{movie}` | `destroy` |

`/` renders the unmodified Laravel welcome page, `/dashboard` is the Breeze "You're logged in!" page (`auth` and `verified` middleware), and `/profile` is the Breeze profile edit / update / delete group (`auth`).

Search and the director filter are `LIKE %term%` queries on `title` and `director`, combined if both are given. Both inputs sit in one GET form with two submit buttons, so either button submits both fields.

Uploaded posters (jpeg, png, jpg, gif, max 2 MB) are moved straight into `public/images/movies/` and named with `time()` plus the extension. The `image` column stores only that file name. The seeder uses `1.jpg` to `18.jpg`, which match the committed files.

Views are Blade. The movie pages use the Breeze `<x-app-layout>` and three small components: `movie-card` for the grid, `movie-details` for the show page and `movie-form`, shared by create and edit. Delete is a form with a JavaScript `confirm()` on the index page.

## Known gaps and issues

Things seen while reading the code. The app was not run, so the behaviour notes come from the code only.

- `.env` is committed (it is not in `.gitignore`, unlike stock Laravel). It has a non-empty `APP_KEY` and values for `DB_HOST`, `DB_DATABASE` and `DB_USERNAME` (`DB_PASSWORD` is empty). Treat the key as exposed and regenerate it, add `/.env` to `.gitignore` and remove the file from the repo.
- The movie routes have no `auth` middleware, so anyone can create, edit and delete movies. The pages also use the Breeze layout, whose navigation prints `Auth::user()->name`, so visiting `/movies` while logged out should throw an error.
- The mobile menu in `layouts/navigation.blade.php` only links to Dashboard; Movies and Add movie are in the desktop nav only.
- `movie-form` checks `isset($book)` (a leftover variable name) to decide whether the poster input is `required`, so the file input is always required, including on edit.
- The release date input has `type="integer"`, which is not a valid input type. The validation rule is `required|max:500`, which does not check that it is a number or a sensible year, although the column is an integer.
- `update` tries to delete the old poster with `Storage::delete(public_path(...))`, which does not point at the file, and `destroy` does not remove the poster at all. Old image files are left behind.
- Poster names come from `time()`, so two uploads in the same second would collide.
- `/` is the stock welcome page and the app name is still "Laravel". The Breeze dashboard has no content beyond the login message.
- `MovieSeeder` creates an unused `$currentTimestamp` and inserts rows with `Movie::insert`, so seeded movies have null `created_at` / `updated_at`. `show.blade.php` has a typo in its header (`_('All Transformers_movies')`, which is not the `__()` helper).
- `movie-form.blade.php` ends with a long explanatory comment block that sits in the rendered HTML.
- No factory or tests for `Movie`.
