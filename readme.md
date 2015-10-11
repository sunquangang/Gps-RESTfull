## Restfull Api for handling GPS coordinates and Images

### Purpose
The purpose of this Restfull api is to be a backend for an GPS application where you can create a `Point`, `Tag the point` and upload `images`.

Images are stored in the database as base_64 encoded strings

This API is build on the [Laravel 5.1 framework](http://laravel.com/docs/5.1)

### Installation
- Clone this repository
- Change the '.env' file to your need
- `composer install`
- `cp .env.example > .env` and edit `.env` to your specific needs
- `php artisan migrate`
- `php artisan db:seed`
- You are ready to go

### Endpoints

**Points**
 
 `GET -> api/points` - Get all points

 **Avalible URL params:** 
 * `limit` default set to 10, 
 * `popular` Default set to false. If set `TRUE` the response will be ordered by the point with most hits **@todo**


 `GET -> api/points/{id}` - Get point by ID.
 
 Fires an Event that updated the `PointHits table` **@todo** 

 `POST -> api/points` - Create a point
 
 `POST -> api/point/{id}/upload` - Add a image to a point
 
 

**@todo**
 `PUT -> api/points/{id}` - Update name and description of a point. - Only the auther will be able to update a entry


 **Tags**
 
 `GET -> api/tags` - Get all tags

 `GET -> api/tags/{id}` - Get tag by id

 `POST -> api/tags` - Create a tag
 

 **Upload**
 
 `GET -> api/upload/{filename}` - Get a image by its filename (a random generated hash)


### License
[MIT License](https://github.com/arelstone/Gps-App-Restful-API/blob/master/license.md)
