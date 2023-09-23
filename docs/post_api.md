# Post API Docs

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
        "data not found!"
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
        "data not found!"
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
    "author_id": 1,
    "title": "post title",
    "content": "post content",
    "status": "published"
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
    "messages": [
        "title required!",
        "content required!"
    ]
}
```

## Update Post
Endpoint: PATCH /api/post/{post_id}

Headers :
- Authorization: "Bearer user-token"

Request Body :
```json
{
    // optional (must send at least one)
    "title": "post title",
    "content": "post content",
    "status": "draft"
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
    "messages": [
        "title required!",
        "content required!"
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
        "delete post success!"
    ]
}
```

Response Error (404) :
```json
{
    "messages": [
        "data not found!"
    ]
}
```