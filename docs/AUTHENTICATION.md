# AUTHENTICATION

- [Home Page](https://github.com/mahendradwipurwanto/javacodeapp_docs/blob/main/README.md)

# #POST / login

**endpoint**
```
https://javacode.ngodingin.com/api/auth/login
```

## #**Login with JavaCodeApp Account**

### Request body
user auth data.

<details><summary>Example Request</summary>
<p>

```
{
    "email": "admin@gmail.com",
    "password": "admin"
}
```

</p>
</details>
<details><summary>Schema</summary>
<p>

```
{
    email : type string #required,
    password : type string #required
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
        "user": {
            "id_user": 1,
            "email": "admin@gmail.com",
            "nama": "Super Admin",
            "m_roles_id": 1,
            "is_google": 0,
            "akses": {
                "master_roles": true,
                "master_user": true,
                "master_akses": true,
                "pengguna_akses": true,
                "pengguna_user": true,
                "app_transaksi1": true,
                "laporan_laporan1": true
            }
        },
        "token": token()
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
<details><summary>422</summary>
<p>

```
{
    "status_code": 422,
    "errors": [
        "<span class=\"gump-field\">Email</span> harus diisi"
    ]
}
```

```
{
    "status_code": 422,
    "errors": [
        "Password yang anda masukkan salah !"
    ]
}
```

</p>
</details>

## #**Login with Google**

### Request body
user google data.

<details><summary>Example Request</summary>
<p>

```
{
    "is_google": "is_google",
    "nama": "test",
    "email": "test@gmail.com"
}
```

</p>
</details>
<details><summary>Schema</summary>
<p>

```
{
    is_google : type string
    nama : type string,
    email : type string,
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
        "user": {
            "id_user": 45,
            "email": "test@gmail.com",
            "nama": "test",
            "m_roles_id": 2,
            "is_google": 0,
            "akses": {
                "master_roles": true,
                "master_user": true,
                "master_akses": true,
                "pengguna_akses": true,
                "pengguna_user": true,
                "app_transaksi1": true,
                "laporan_laporan1": true
            }
        },
        "token": token()
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
<details><summary>422</summary>
<p>

```
{
    "status_code": 422,
    "errors": [
        "<span class=\"gump-field\">Nama</span> harus diisi"
    ]
}
```

</p>
</details>


## #GET / sessions

**endpoint**
```
https://javacode.ngodingin.com/api/auth/session

```
#Request body
none.

#Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": {
        "user": {
            "id_user": 45,
            "email": "test@gmail.com",
            "nama": "test",
            "m_roles_id": 2,
            "is_google": 0,
            "akses": {
                "master_roles": true,
                "master_user": true,
                "master_akses": true,
                "pengguna_akses": true,
                "pengguna_user": true,
                "app_transaksi1": true,
                "laporan_laporan1": true
            }
        },
        "token": "m_app"
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
        "can`t find session"
    ]
}
```

</p>
</details>



## #GET / logout

**endpoint**
```
https://javacode.ngodingin.com/api/auth/logout

```
#Request body
none.

#Responses

<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": [
        "Berhasil logout"
    ]
}
```

</p>
</details>
<details><summary>200</summary>
<p>

```
{
    "status_code": 200,
    "data": [
        "Anda telah logout"
    ]
}
```

</p>
</details>