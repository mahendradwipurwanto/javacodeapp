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
            "nama": "Ayam Preksu",
            "kategori": "makanan",
            "harga": 18000,
            "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": "https://i.ibb.co/5F0wY8N/ayam-preksu.jpg",
            "status": 1
        },
        {
            "id_menu": 3,
            "nama": "Lemon Tea",
            "kategori": "minuman",
            "harga": 9000,
            "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": "https://i.ibb.co/RNXcV2s/chicken-katsu.jpg",
            "status": 1
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

> kategori: string #required

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
            "id_menu": 2,
            "nama": "Ayam Preksu",
            "kategori": "makanan",
            "harga": 18000,
            "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": "https://i.ibb.co/5F0wY8N/ayam-preksu.jpg",
            "status": 1
        },
        {
            "id_menu": 4,
            "nama": "Chiken Katsu",
            "kategori": "makanan",
            "harga": 12000,
            "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": "https://i.ibb.co/Q9rL5f0/lemon-tea.jpg",
            "status": 1
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

> id_menu: integer #required

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
            "nama": "Lemon Tea",
            "kategori": "minuman",
            "harga": 9000,
            "deskripsi": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            "foto": "https://i.ibb.co/RNXcV2s/chicken-katsu.jpg",
            "status": 1
        },
        "topping": [
            {
                "id_detail": 1,
                "id_menu": 3,
                "keterangan": "boba",
                "type": "topping",
                "harga": 2000
            },
            {
                "id_detail": 2,
                "id_menu": 3,
                "keterangan": "oreo",
                "type": "topping",
                "harga": 2000
            }
        ],
        "level": [
            {
                "id_detail": 3,
                "id_menu": 3,
                "keterangan": "1",
                "type": "level",
                "harga": 2000
            }
        ]
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



# #POST / add new menu
*this will be replace in few days*
**endpoint**
```
https://javacode.ngodingin.com/api/menu/add
```

### Request body

<details><summary>Example Request</summary>
<p>

```
{
    "nama": "bakso beranak",
    "kategori": "makanan",
    "harga": 10000,
    "status": 1
}
```

</p>
</details>
<details><summary>Schema</summary>
<p>

```
{
    "nama": string,
    "kategori": string,
    "harga": integer,
    "status": integer
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