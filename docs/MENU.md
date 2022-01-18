# MENU

- [Home Page](https://github.com/mahendradwipurwanto/javacodeapp_docs/blob/main/README.md)

# #GET / menu

**endpoint**
```
https://javacode.ngodingin.com/api/menu/all
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
            "id_menu": 2,
            "nama": "coto makassar",
            "kategori": "makanan",
            "harga": 18000,
            "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": null,
            "status": 1,
            "is_deleted": 0,
            "created_at": "2022-01-17 09:42:03",
            "created_by": 1
        },
        {
            "id_menu": 3,
            "nama": "thai tea",
            "kategori": "minuman",
            "harga": 9000,
            "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": null,
            "status": 1,
            "is_deleted": 0,
            "created_at": "2022-01-17 09:42:03",
            "created_by": 1
        }
    ]
}
```

</p>
</details>



# #GET / menu by kategori

**endpoint**
```
https://javacode.ngodingin.com/api/menu/kategori/{kategori}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> kategori: string

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "id_menu": 2,
        "nama": "coto makassar",
        "kategori": "makanan",
        "harga": 18000,
        "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
        "foto": null,
        "status": 1,
        "is_deleted": 0,
        "created_at": "2022-01-17 09:42:03",
        "created_by": 1
    }
}
```

</p>
</details>



# #GET / menu detail

**endpoint**
```
https://javacode.ngodingin.com/api/menu/detail/{id_menu}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> id_menu: integer

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "menu": {
            "id_menu": 3,
            "nama": "thai tea",
            "kategori": "minuman",
            "harga": 9000,
            "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": null,
            "status": 1,
            "is_deleted": 0,
            "created_at": "2022-01-17 09:42:03",
            "created_by": 1
        },
        "topping": [
            {
                "id_detail": 1,
                "id_menu": 3,
                "keterangan": "boba",
                "type": "topping",
                "harga": 2000,
                "is_deleted": 0
            },
            {
                "id_detail": 2,
                "id_menu": 3,
                "keterangan": "oreo",
                "type": "topping",
                "harga": 2000,
                "is_deleted": 0
            }
        ],
        "level": [
            {
                "id_detail": 3,
                "id_menu": 3,
                "keterangan": "less ice",
                "type": "level",
                "harga": 2000,
                "is_deleted": 0
            },
            {
                "id_detail": 4,
                "id_menu": 3,
                "keterangan": "more ice",
                "type": "level",
                "harga": 2000,
                "is_deleted": 0
            }
        ]
    }
}
```

</p>
</details>



# #POST / add new menu

**endpoint**
```
https://javacode.ngodingin.com/api/menu/add
```

### Request body

<details><summary>Example Request</summary>
<p>

{
    "nama": "bakso beranak",
    "kategori": "makanan",
    "harga": 10000,
    "status": 1
}

</p>
</details>
<details><summary>Schema</summary>
<p>

{
    "nama": string,
    "kategori": string,
    "harga": integer,
    "status": integer
}

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "id_menu": 4,
        "nama": "bakso beranak",
        "kategori": "makanan",
        "harga": 1-000,
        "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
        "foto": null,
        "status": 1,
        "is_deleted": 0,
        "created_at": "2022-01-17 09:42:03",
        "created_by": 1
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
        "Terjadi masalah pada server"
    ]
}
```

</p>
</details>