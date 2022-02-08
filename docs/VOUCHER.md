# VOUCHER

- [Home Page](https://github.com/mahendradwipurwanto/javacodeapp_docs/blob/main/README.md)

# #GET / voucher

**endpoint**
```
https://javacode.ngodingin.com/api/voucher/all
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
            "id_voucher": 1,
            "nama": "Koordinator Program kekompakan",
            "id_user": 1,
            "nominal": 50000,
            "info_voucher": "https://i.ibb.co/bJ10gcZ/Voucher-Java-Code-app-01.jpg",
            "periode_mulai": 1610838000,
            "periode_selesai": 1613516400,
            "type": 1,
            "status": 1,
            "catatan": null
        },
        {
            "id_voucher": 2,
            "nama": "Birthday",
            "id_user": 47,
            "nominal": 25000,
            "info_voucher": "https://i.ibb.co/bJ10gcZ/Voucher-Java-Code-app-01.jpg",
            "periode_mulai": 1610838000,
            "periode_selesai": 1613516400,
            "type": 0,
            "status": 1,
            "catatan": null
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


# #GET / voucher list of one user

**endpoint**
```
https://javacode.ngodingin.com/api/voucher/user/{id_user}
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
            "id_voucher": 1,
            "nama": "Koordinator Program kekompakan",
            "id_user": 1,
            "nominal": 50000,
            "info_voucher": "https://i.ibb.co/bJ10gcZ/Voucher-Java-Code-app-01.jpg",
            "periode_mulai": 1610838000,
            "periode_selesai": 1613516400,
            "type": 1,
            "status": 1,
            "catatan": null
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


# #GET / detail voucher

**endpoint**
```
https://javacode.ngodingin.com/api/voucher/detail/{id_voucher}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> id_voucher: integer

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
            "id_voucher": 1,
            "nama": "Koordinator Program kekompakan",
            "id_user": 1,
            "nominal": 50000,
            "info_voucher": "https://i.ibb.co/bJ10gcZ/Voucher-Java-Code-app-01.jpg",
            "periode_mulai": 1610838000,
            "periode_selesai": 1613516400,
            "type": 1,
            "status": 1,
            "catatan": null
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