# DISKON

- [Home Page](https://github.com/mahendradwipurwanto/javacodeapp_docs/blob/main/README.md)

# #GET / diskon

**endpoint**
```
https://javacode.ngodingin.com/api/diskon/all
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
            "id_diskon": 1,
            "id_user": 1,
            "nama_user": "admin",
            "nama": "Mengisi survey",
            "diskon": 10
        },
        {
            "id_diskon": 2,
            "id_user": 47,
            "nama_user": "dev noersy",
            "nama": "Mengisi survey",
            "diskon": 10
        },
        {
            "id_diskon": 3,
            "id_user": 1,
            "nama_user": "admin",
            "nama": "Mengisi survey",
            "diskon": 10
        }
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


# #GET / diskon list of one user

**endpoint**
```
https://javacode.ngodingin.com/api/diskon/user/{id_user}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> id_user: integer #required

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": [
        {
            "id_diskon": 1,
            "id_user": 1,
            "nama_user": "admin",
            "nama": "Mengisi survey",
            "diskon": 10
        },
        {
            "id_diskon": 3,
            "id_user": 1,
            "nama_user": "admin",
            "nama": "Mengisi survey",
            "diskon": 10
        }
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


# #GET / detail diskon

**endpoint**
```
https://javacode.ngodingin.com/api/diskon/detail/{id_diskon}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> id_diskon: integer #required

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "id_diskon": 1,
        "id_user": 1,
        "nama_user": "Super Admin",
        "nama": "Mengisi survey",
        "diskon": 10,
        "status": 1
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