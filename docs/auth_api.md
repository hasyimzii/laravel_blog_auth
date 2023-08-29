# Auth API Spec

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
        "Email already existed!",
        "Name required!"
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
        "Wrong email or password!"
    ]
}
```

## Logout
Endpoint: POST /api/logout

Headers :
- Authorization: "Bearer user-token"

Response Success (200) :
```json
{
    "messages": [
        "Logout success!"
    ]
}
```

Response Error (401) :
```json
{
    "message": [
        "You are unauthorized!"
    ]
}
```