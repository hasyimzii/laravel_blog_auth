# Auth API Docs

## Register
Endpoint: POST /api/register

Request Body :
```json
{
    "name": "user",
    "email": "user@mail.com",
    "password": "secret"
}
```

Response Success (200) :
```json
{
    "data": {
        "name": "user",
        "email": "user@mail.com"
    }
}
```

Response Error (400) :
```json
{
    "messages": [
        "email already existed!",
        "name required!"
    ]
}
```

## Login
Endpoint: POST /api/login

Request Body :
```json
{
    "email": "user@mail.com",
    "password": "secret"
}
```

Response Success (201) :
```json
{
    "data": {
        "name": "user",
        "authorization": {
            "token": "user-token",
            "type": "bearer"
        }
    }
}
```

Response Error (401) :
```json
{
    "messages": [
        "wrong email or password!"
    ]
}
```

## Get User
Endpoint: GET /api/user

Headers :
- Authorization: "Bearer user-token"

Response Success (200) :
```json
{
    "data": {
        "name": "user",
        "authorization": {
            "token": "user-token",
            "type": "bearer"
        }
    }
}
```

Response Error (401) :
```json
{
    "messages": [
        "you are unauthorized!"
    ]
}


## Logout
Endpoint: POST /api/logout

Headers :
- Authorization: "Bearer user-token"

Response Success (200) :
```json
{
    "messages": [
        "logout success!"
    ]
}
```

Response Error (401) :
```json
{
    "messages": [
        "you are unauthorized!"
    ]
}
```