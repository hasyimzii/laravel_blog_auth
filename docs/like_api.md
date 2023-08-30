# Like API Docs

## Get Post Likes and Dislikes
Endpoint: GET /api/post/{post_id}/like

Headers :
- Authorization: "Bearer user-token"

Response Success (200) :
```json
{
    "data": {
        "post_id": 1,
        "post_likes": [
            {
                "post_like_id": 1,
                "user": "user",
                "is_like": true,
                "date": "2023-01-01"
            }
        ],
        "post_dislikes": [
            {
                "post_like_id": 2,
                "user": "user",
                "is_like": false,
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

## Like or Dislike Post
Endpoint: POST /api/post_like

Headers :
- Authorization: "Bearer user-token"

Request Body :
```json
{
    "data": {
        "post_id": 1,
        "is_like": true
    }
}
```

Response Success (200) :
```json
{
    "data": {
        "post_like_id": 1,
        "post_id": 1,
        "user": "user",
        "is_like": true,
        "date": "2023-01-01"
    }
}
```

Response Error (400) :
```json
{
    "messages": [
        "is_like required!"
    ]
}
```

## Get Comment Likes and Dislikes
Endpoint: GET /api/post_comment/{post_comment_id}/like

Headers :
- Authorization: "Bearer user-token"

Response Success (200) :
```json
{
    "data": {
        "post_comment_id": 1,
        "comment_likes": [
            {
                "comment_like_id": 1,
                "user": "user",
                "is_like": true,
                "date": "2023-01-01"
            }
        ],
        "comment_dislikes": [
            {
                "comment_like_id": 2,
                "user": "user",
                "is_like": false,
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

## Like or Dislike Comment
Endpoint: POST /api/comment_like

Headers :
- Authorization: "Bearer user-token"

Request Body :
```json
{
    "data": {
        "post_comment_id": 1,
        "is_like": false
    }
}
```

Response Success (200) :
```json
{
    "data": {
        "comment_like_id": 1,
        "post_comment_id": 1,
        "user": "user",
        "is_like": false,
        "date": "2023-01-01"
    }
}
```

Response Error (400) :
```json
{
    "messages": [
        "is_like required!"
    ]
}
```