# ORDER

- [Home Page](https://github.com/mahendradwipurwanto/javacodeapp_docs/blob/main/README.md)

### Status Order:
0. dalam antrian
1. sedang siapkan
2. bisa diambil
3. sudah diambil
4. dibatalkan

# #POST / order

**endpoint**
```
https://javacode.ngodingin.com/api/order/add
```

### Request header

<details><summary>Headers</summary>
<p>

```
{
    "Content-Type": "application/json"
}
```

</p>
</details>

### Request body

<details><summary>Example Request</summary>
<p>

```
{
    "order": {
        "id_user": 1,
        "id_voucher": 1,
        "potongan": 45000,
        "total_bayar": 12800
    },
    "menu": [
        {
            "id_menu": 2,
            "harga": 18000,
            "level": 1,
            "topping": [
                1,
                2
            ],
            "jumlah": 2
        },
        {
            "id_menu": 3,
            "harga": 10000,
            "level": 2,
            "topping": [
                2,
                3
            ],
            "jumlah": 1
        }
    ]
}
```

</p>
</details>
<details><summary>Schema</summary>
<p>

```
{
    "order": {
        "id_user": integer, #required
        "id_voucher": integer, #not required, choose between voucher or diskon
        "id_diskon": array(id_diskon: integer), #not required, choose between voucher or diskon
        "diskon": integer, #not required, choose between voucher or diskon
        "potongan": integer, #required
        "total_bayar": integer
    },
    "menu": [
        {
            "id_menu": integer,
            "harga": integer,
            "level": integer, #not required
            "topping": array(topping: integer), #not required
            "jumlah": integer
        },
        {
            "id_menu": integer,
            "harga": integer,
            "level": integer, #not required
            "topping": array(topping: integer), #not required
            "jumlah": integer
        }
    ]
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
        "message": "Order has been successfuly added",
        "no_struk": "002/KWT/01/2022"
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
        "<span class=\"gump-field\">voucher</span> harus diisi"
    ]
}
```

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



# #GET / order all

**endpoint**
```
https://javacode.ngodingin.com/api/order/all
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
            "id_order": 35,
            "no_struk": "001/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 12000,
            "tanggal": "2022-01-19",
            "status": 0,
            "menu": [
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "10000",
                    "total": 10000,
                    "catatan": "test"
                }
            ]
        },
        {
            "id_order": 37,
            "no_struk": "002/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 12000,
            "tanggal": "2022-01-19",
            "status": 3,
            "menu": [
                {
                    "id_menu": 3,
                    "kategori": "minuman",
                    "nama": "Lemon Tea",
                    "foto": "https://i.ibb.co/RNXcV2s/chicken-katsu.jpg",
                    "jumlah": 2,
                    "harga": "18000",
                    "total": 36000,
                    "catatan": "Testing"
                },
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "10000",
                    "total": 10000,
                    "catatan": ""
                }
            ]
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



# #GET / order list of one user

**endpoint**
```
https://javacode.ngodingin.com/api/order/user/{id_user}
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
            "id_order": 35,
            "no_struk": "001/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 12000,
            "tanggal": "2022-01-19",
            "status": 0,
            "menu": [
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "10000",
                    "total": 10000,
                    "catatan": "test"
                }
            ]
        },
        {
            "id_order": 37,
            "no_struk": "002/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 12000,
            "tanggal": "2022-01-19",
            "status": 3,
            "menu": [
                {
                    "id_menu": 3,
                    "kategori": "minuman",
                    "nama": "Lemon Tea",
                    "foto": "https://i.ibb.co/RNXcV2s/chicken-katsu.jpg",
                    "jumlah": 2,
                    "harga": "18000",
                    "total": 36000,
                    "catatan": "Testing"
                },
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "10000",
                    "total": 10000,
                    "catatan": ""
                }
            ]
        },
        {
            "id_order": 38,
            "no_struk": "003/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 8100,
            "tanggal": "2022-01-19",
            "status": 1,
            "menu": [
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "9000",
                    "total": 9000,
                    "catatan": "Testing"
                }
            ]
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



# #GET / order list of one user by status order

**endpoint**
```
https://javacode.ngodingin.com/api/order/status/{id_user}/{status}
```

### Request body
none.

### Request Parameters

<details><summary>2 Path Parameter</summary>
<p>

> id_user: integer #required

> status: integer #required

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
            "id_order": 35,
            "no_struk": "001/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 12000,
            "tanggal": "2022-01-19",
            "status": 0,
            "menu": [
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "10000",
                    "total": 10000,
                    "catatan": "test"
                }
            ]
        },
        {
            "id_order": 43,
            "no_struk": "006/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 11700,
            "tanggal": "2022-01-20",
            "status": 0,
            "menu": [
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "9000",
                    "total": 9000,
                    "catatan": "Testing"
                }
            ]
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



# #GET / order list of one user by status is process (0- dalam antrian, 1 - sedang disiapkan, 2 - bisa diambil)

**endpoint**
```
https://javacode.ngodingin.com/api/order/status/{id_user}/{status}
```

### Request body
none.

### Request Parameters

<details><summary>2 Path Parameter</summary>
<p>

> id_user: integer #required

> status: integer #required

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
            "id_order": 35,
            "no_struk": "001/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 12000,
            "tanggal": "2022-01-19",
            "status": 0,
            "menu": [
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "10000",
                    "total": 10000,
                    "catatan": "test"
                }
            ]
        },
        {
            "id_order": 38,
            "no_struk": "003/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 8100,
            "tanggal": "2022-01-19",
            "status": 1,
            "menu": [
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "9000",
                    "total": 9000,
                    "catatan": "Testing"
                }
            ]
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



# #GET / order history of one user

**endpoint**
```
https://javacode.ngodingin.com/api/order/history/{id_user}
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
            "id_order": 37,
            "no_struk": "002/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 12000,
            "tanggal": "2022-01-19",
            "status": 3,
            "menu": [
                {
                    "id_menu": 3,
                    "kategori": "minuman",
                    "nama": "Lemon Tea",
                    "foto": "https://i.ibb.co/RNXcV2s/chicken-katsu.jpg",
                    "jumlah": 2,
                    "harga": "18000",
                    "total": 36000,
                    "catatan": "Testing"
                },
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "10000",
                    "total": 10000,
                    "catatan": ""
                }
            ]
        },
        {
            "id_order": 40,
            "no_struk": "005/KWT/01/2022",
            "nama": "dev noersy",
            "total_bayar": 8100,
            "tanggal": "2022-01-19",
            "status": 4,
            "menu": [
                {
                    "id_menu": 9,
                    "kategori": "makanan",
                    "nama": "Nasi Goreng",
                    "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                    "jumlah": 1,
                    "harga": "9000",
                    "total": 9000,
                    "catatan": "Testing"
                }
            ]
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



# #GET / order detail

**endpoint**
```
https://javacode.ngodingin.com/api/order/detail/{id_order}
```

### Request body
none.

### Request Parameters

<details><summary>1 Path Parameter</summary>
<p>

> id_order: integer #required

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "order": {
            "id_order": 43,
            "no_struk": "006/KWT/01/2022",
            "nama": "dev noersy",
            "id_voucher": 0,
            "nama_voucher": null,
            "diskon": 10,
            "potongan": 1300,
            "total_bayar": 11700,
            "tanggal": "2022-01-20",
            "status": 0
        },
        "detail": [
            {
                "id_menu": 9,
                "kategori": "makanan",
                "nama": "Nasi Goreng",
                "foto": "https://i.ibb.co/mRJnq3Z/nasi-goreng.jpg",
                "jumlah": 1,
                "harga": "9000",
                "total": 9000,
                "catatan": "Testing"
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

# #POST / order batal

**endpoint**
```
https://javacode.ngodingin.com/api/order/batal/{id_order}
```

### Request header

<details><summary>Headers</summary>
<p>

>    id_order: integer

</p>
</details>

### Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "id_order": 60,
        "no_struk": "009/KWT/01/2022",
        "id_user": 1,
        "tanggal": "2022-01-21",
        "id_voucher": 1,
        "id_diskon": "",
        "diskon": 0,
        "potongan": 45000,
        "total_bayar": 12800,
        "status": 4,
        "is_deleted": 0
    }
}
```

</p>
</details>
<details><summary>304</summary>
<p>

> This mean the order already change status like already prepare by kitchen

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