# Comment API Docs

## Get Post Comments
Endpoint: GET /api/post/{post_id}/comment

Headers :
- Authorization: "Bearer user-token"

Response Success (200) :
```json
{
    "data": {
        "post_id": 1,
        "post_comments": [
            {
                "post_comment_id": 1,
                "user": "user",
                "comment": "post comment",
                "date": "2023-01-01"
            }
        ]
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

## Get Single Post Comment
Endpoint: GET /api/post_comment/{post_comment_id}

Headers :
- Authorization: "Bearer user-token"

Response Success (200) :
```json
{
    "data": {
        "post_comment_id": 1,
        "post_id": 1,
        "user": "user",
        "comment": "post comment",
        "date": "2023-01-01"
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
Endpoint: POST /api/post_comment

Headers :
- Authorization: "Bearer user-token"

Request Body :
```json
{
    "data": {
        "post_id": 1,
        "comment": "post comment"
    }
}
```

Response Success (200) :
```json
{
    "data": {
        "post_id": 1,
        "user": "user",
        "comment": "post comment",
        "date": "2023-01-01"
    }
}
```

Response Error (400) :
```json
{
    "messages": [
        "comment required!"
    ]
}
```

## Update Post
Endpoint: PATCH /api/post_comment/{post_comment_id}

Headers :
- Authorization: "Bearer user-token"

Request Body :
```json
{
    "data": {
        "comment": "post comment"
    }
}
```

Response Success (200) :
```json
{
    "data": {
        "post_id": 1,
        "user": "user",
        "comment": "post comment",
        "date": "2023-01-01"
    }
}
```

Response Error (400) :
```json
{
    "messages": [
        "comment required!"
    ]
}
```

## Delete Post
Endpoint: DELETE /api/post_comment/{post_comment_id}

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