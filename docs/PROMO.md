# PROMO

- [Home Page](https://github.com/mahendradwipurwanto/javacodeapp_docs/blob/main/README.md)

# #GET / promo

**endpoint**
```
https://javacode.ngodingin.com/api/promo/all
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
            "id_promo": 3,
            "type": "diskon",
            "nama": "Mengisi survey",
            "diskon": 10,
            "nominal": null,
            "kadaluarsa": 1,
            "syarat_ketentuan": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": null
        },
        {
            "id_promo": 2,
            "type": "voucher",
            "nama": "Birthday",
            "diskon": null,
            "nominal": 15000,
            "kadaluarsa": 1,
            "syarat_ketentuan": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": null
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



# #GET / list promo by type

**endpoint**
```
https://javacode.ngodingin.com/api/promo/type/{type}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> type: string (voucher / diskon) #required

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
            "id_promo": 1,
            "nama": "Koordinator Program kekompakan",
            "diskon": null,
            "nominal": 20000,
            "kadaluarsa": 1,
            "syarat_ketentuan": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": null
        },
        {
            "id_promo": 2,
            "nama": "Birthday",
            "diskon": null,
            "nominal": 15000,
            "kadaluarsa": 1,
            "syarat_ketentuan": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": null
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



# #GET / list promo of one user

**endpoint**
```
https://javacode.ngodingin.com/api/promo/user/{id_user}
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
        [
            {
                "id_promo": 1,
                "type": "voucher",
                "nama": "Koordinator Program kekompakan",
                "diskon": null,
                "nominal": 20000,
                "kadaluarsa": 1,
                "syarat_ketentuan": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "foto": null
            }
        ],
        [
            {
                "id_promo": 3,
                "type": "diskon",
                "nama": "Mengisi survey",
                "diskon": 10,
                "nominal": null,
                "kadaluarsa": 1,
                "syarat_ketentuan": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "foto": null
            },
            {
                "id_promo": 3,
                "type": "diskon",
                "nama": "Mengisi survey",
                "diskon": 10,
                "nominal": null,
                "kadaluarsa": 1,
                "syarat_ketentuan": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
                "foto": null
            }
        ]
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



# #GET / detail promo

**endpoint**
```
https://javacode.ngodingin.com/api/promo/detail/{id_promo}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> id_promo: integer #required

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "id_promo": 1,
        "nama": "Koordinator Program kekompakan",
        "diskon": null,
        "nominal": 20000,
        "kadaluarsa": 1,
        "syarat_ketentuan": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
        "foto": null
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