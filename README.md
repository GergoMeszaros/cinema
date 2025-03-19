## Cinema App

Technologies used:

- Laravel for backend
- React for frontend
- Mysql database
- Nginx as webserver
- Docker

## Downloading and managing the project

    1. clone the repo: git clone git@github.com:GergoMeszaros/cinema.git
    2. start: docker-compose up -d
    3. run db migrations: docker-compose exec php php artisan migrate:fresh
    4. seed the db: docker-compose exec php php artisan db:seed
    
    5. stop: docker-compose down

## API endpoints

All endpoints return JSON objects as responses

**In this phase of the development the host is http://localhost**

**1. Movies**

- GET /movies
- Description: Retrieve a list of all movies.
- Response:
    - 200 OK: A list of movies.


- GET /movies/{id}
- Description: Retrieve details of a specific movie by ID.
- Parameters:
  id (integer): The unique ID of the movie.
- Response:
    - 200 OK: Movie details in JSON
    - 404 Not Found: Movie not found!


- POST /movies/new
- Description: Create a new movie.
- Request Body: Movie details (title, description, language, age_restriction, cover_picture_id)
- Response:
    - 201 Created: Movie created successfully.


- PATCH /movies/{id}
- Description: Update details of a specific movie by ID.
- Parameters: id (integer): The unique ID of the movie.
- Request Body: Updated movie details.
- Response:
    - 200 OK: Movie details in JSON
    - 404 Not Found: Movie not found!


- DELETE /movies/{id}
- Description: Remove a movie by ID.
- Parameters: id (integer): The unique ID of the movie.
- Response:
    - 200 OK: Movie successfully deleted!
    - 404 Not Found: Movie not found!

**2. Showtime Details**

- POST /showtime_details/new
- Description: Create new showtime_details for a movie.
- Request Body: Showtime details (showtime, available_seats, movie_id)
- Response:
    - 201 Created: Showtime details in JSON


- PATCH /showtime_details/{id}
- Description: Update parts of a specific showtime_details by ID.
- Parameters: id (integer): The unique ID of the showtime_details.
- Request Body: Updated showtime details (showtime, available_seats, movie_id).
- Response:
    - 200 OK: Showtime details in JSON
    - 404 Not Found: Showtime details not found!


- DELETE /showtime_details/{id}
- Description: Remove a showtime_details by ID.
- Parameters: id (integer): The unique ID of the movie.
- Response:
    - 200 OK: Showtime details successfully deleted!
    - 404 Not Found: Showtime details not found!

**3. Cover Picture**

- POST /cover_picture/new
- Description: Upload a new cover picture for a movie.
- Request Body: Image details (name, cover_text, movie_id).
- Response:
    - 201 Created: Cover picture details.


- PATCH /cover_picture/{id}
- Description: Update the cover picture details by ID.
- Parameters: id (integer): The unique ID of the cover picture.
- Request Body: Image details(name).
- Response:
    - 200 OK: Cover picture updated successfully.
    - 404 Not Found: Cover picture not found!

- DELETE /cover_picture/{id}
- Description: Remove the cover picture by ID.
- Parameters: id (integer): The unique ID of the cover picture.
- Response:
  - 200 OK: Cover picture successfully deleted!
  - 404 Not Found: Cover picture not found!
