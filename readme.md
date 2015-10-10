## Restfull Api for handling GPS coordinates and Images

### Purpose
The purpose of this Restfull api is to be a backend for an GPS application where you can create a `Point`, `Tag` the point and upload images.

### Endpoints

##### Points
 
 `GET -> api/points` - Get all points
 `GET -> api/points/{id}` - Get point by ID
 `POST -> api/points` - Create a point
 `PUT -> api/points/{id}` - Update name and description of a point.

 ##### Tags
 
 `GET -> api/tags` - Get all tags
 `GET -> api/tags/{id}` - Get tag by id
 `POST -> api/tags` - Create a tag
 
 #### Images
 
 `GET -> api/upload/{filename}` - Get a image by its filename (a random generated hash)
 `POST -> api/upload` - Upload image 
