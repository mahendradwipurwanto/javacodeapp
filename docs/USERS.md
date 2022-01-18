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
            "id_user": 26,
            "nama": "User Testing",
            "tgl_lahir": null,
            "email": "user@gmail.com",
            "alamat": "",
            "telepon": "",
            "foto": null,
            "password": "d033e22ae348aeb5660fc2140aec35850c4da997",
            "ktp": null,
            "status": 0,
            "m_roles_id": 2
        },
        {
            "id_user": 30,
            "nama": "User Testing 2",
            "tgl_lahir": null,
            "email": "user2@gmail.com",
            "alamat": null,
            "telepon": null,
            "foto": null,
            "password": "3643e257d63e4066aca072eab8427045d93bb9b2",
            "ktp": null,
            "status": 0,
            "m_roles_id": 2
        }
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
<details><summary>422</summary>
<p>

```
{
    "status_code": 422,
    "errors": [
        "Tidak dapat menemukan data"
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
<details><summary>422</summary>
<p>

```
{
    "status_code": 422,
    "errors": [
        "Tidak dapat menemukan data"
    ]
}
```

</p>
</details>
