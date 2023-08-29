# Post API Spec

## Get Posts
Endpoint: GET /api/post

Headers :
- Authorization: "Bearer user-token"

Request Parameter :
```json
{
    "search": "post title" // optional
}
```

Response Success (200) :
```json
{
    "data": [
        {
            "post_id": 1,
            "author": "user",
            "title": "post title",
            "content": "post content",
            "status": "published",
            "published_date": "2023-01-01"
        }
    ]
}
```

Response Error (404) :
```json
{
    "messages": [
        "Data not found!"
    ]
}
```

## Get Single Post
Endpoint: GET /api/post/{post_id}

Headers :
- Authorization: "Bearer user-token"

Response Success (200) :
```json
{
    "data": {
        "post_id": 1,
        "author": "user",
        "title": "post title",
        "content": "post content",
        "status": "published",
        "published_date": "2023-01-01"
    }
}
```

Response Error (404) :
```json
{
    "messages": [
        "Data not found!"
    ]
}
```

## Create Post
Endpoint: POST /api/post

Headers :
- Authorization: "Bearer user-token"

Request Body :
```json
{
    "data": {
        "author_id": 1,
        "title": "post title",
        "content": "post content",
        "status": "published"
    }
}
```

Response Success (200) :
```json
{
    "data": {
        "author": "user",
        "title": "post title",
        "content": "post content",
        "status": "published",
        "published_date": "2023-01-01"
    }
}
```

Response Error (400) :
```json
{
    "message": [
        "Title required!",
        "Content required!"
    ]
}
```

## Update Post
Endpoint: PUT /api/post/{post_id}

Headers :
- Authorization: "Bearer user-token"

Request Body :
```json
{
    "data": {
        "title": "post title",
        "content": "post content",
        "status": "draft"
    }
}
```

Response Success (200) :
```json
{
    "data": {
        "author": "user",
        "title": "post title",
        "content": "post content",
        "status": "draft",
        "published_date": null
    }
}
```

Response Error (400) :
```json
{
    "message": [
        "Title required!",
        "Content required!"
    ]
}
```

## Delete Post
Endpoint: DELETE /api/post/{post_id}

Headers :
- Authorization: "Bearer user-token"

Response Success (200) :
```json
{
    "messages": [
        "Delere post success!"
    ]
}
```

Response Error (404) :
```json
{
    "messages": [
        "Data not found!"
    ]
}
```