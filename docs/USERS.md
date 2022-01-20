# USERS

- [Home Page](https://github.com/mahendradwipurwanto/javacodeapp_docs/blob/main/README.md)

# #GET / user

**endpoint**
```
https://javacode.ngodingin.com/api/user
```

### Request body
none.

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": [
        {
            "id_user": 1,
            "nama": "admin",
            "email": "admin@gmail.com",
            "tgl_lahir": null,
            "alamat": "",
            "telepon": "",
            "foto": null,
            "ktp": null,
            "status": 0,
            "roles_id": 1,
            "roles": "Super Admin"
        },
        {
            "id_user": 45,
            "nama": "test",
            "email": "test@gmail.com",
            "tgl_lahir": null,
            "alamat": null,
            "telepon": null,
            "foto": null,
            "ktp": null,
            "status": 0,
            "roles_id": 2,
            "roles": "User"
        },
    ]
}
```

</p>
</details>
<details><summary>204</summary>
<p>

> This mean that, there is no data can be found on database

</p>
</details>
<details><summary>403</summary>
<p>

```
{
    "status_code": 403,
    "errors": [
        "Mohon maaf, anda tidak mempunyai akses"
    ]
}
```

</p>
</details>


# #GET / user detail

**endpoint**
```
https://javacode.ngodingin.com/api/user/detail/{id_user}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> id_user: integer

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "id_user": 26,
        "nama": "User Testing",
        "email": "user@gmail.com",
        "alamat": "",
        "telepon": "",
        "tgl_lahir": null,
        "foto": null,
        "ktp": null,
        "status": 0,
        "m_roles_id": 2
    }
}
```

</p>
</details>
<details><summary>204</summary>
<p>

> This mean that, there is no data can be found on database

</p>
</details>
<details><summary>403</summary>
<p>

```
{
    "status_code": 403,
    "errors": [
        "Mohon maaf, anda tidak mempunyai akses"
    ]
}
```

</p>
</details>


# #POST / update user

**endpoint**
```
https://javacode.ngodingin.com/api/user/update/{id_user}
```

### Request body

<details><summary>Example body</summary>
<p>

```
{
    "nama": "namaku"
}
```

</p>
</details>
<details><summary>Schema</summary>
<p>

```
{
    "field": string, integer, bool
}
```

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "id_user": 26,
        "nama": "testing",
        "tgl_lahir": null,
        "email": "user@gmail.com",
        "alamat": "",
        "telepon": "",
        "foto": null,
        "password": "d033e22ae348aeb5660fc2140aec35850c4da997",
        "ktp": null,
        "status": 0,
        "is_google": 0,
        "m_roles_id": 2,
        "is_deleted": 0
    }
}
```

</p>
</details>
<details><summary>204</summary>
<p>

> This mean that, there is no data can be found on database

</p>
</details>
<details><summary>403</summary>
<p>

```
{
    "status_code": 403,
    "errors": [
        "Mohon maaf, anda tidak mempunyai akses"
    ]
}
```

</p>
</details>
