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
            "id_promo": 1,
            "type": "voucher",
            "nama": "Koordinator Program kekompakan",
            "diskon": null,
            "nominal": 20000,
            "kadaluarsa": 1,
            "syarat_ketentuan": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": null
        }
    ]
}
```

</p>
</details>


# #GET / detail diskon

**endpoint**
```
https://javacode.ngodingin.com/api/promo/type/{type}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> type: string (voucher / diskon)

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