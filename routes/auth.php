<?php

function validasi($data, $custom = array())
{
    $validasi = array(
        "email" => "required"
    );

    $cek = validate($data, $validasi, $custom);
    return $cek;
}

$app->get('/', function ($request, $response) {
    return unprocessResponse($response, ['can`t find any route with this end point']);
});

/**
 * Ambil session user
 */
$app->get('/auth/session', function ($request, $response) {
    if (isset($_SESSION['user']['m_roles_id'])) {
        return successResponse($response, $_SESSION);
    }
    return unprocessResponse($response, ['can`t find session']);
})->setName('session');

/**
 * Proses login
 */
$app->post('/auth/login', function ($request, $response) {
    $params = $request->getParams();
    $db = $this->db;

    $validasi = validasi($params);

    if ($validasi === true) {

        $user = get_account($db, $params['email']);

        if (isset($params['is_google']) && $params['is_google'] == "is_google") {

            if (!isset($user->id_user)) {
                $validasi = validasi($params, ["nama" => "required"]);

                if ($validasi !== true) {
                    return unprocessResponse($response, $validasi);
                }

                try {
                    $password = create_password();

                    $input = [
                        'nama' => $params['nama'],
                        'email' => $params['email'],
                        'password' => sha1($password),
                        'is_google' => true
                    ];

                    $user = $db->insert('m_user', $input);

                    $mail = [
                        'id_user' => $user->id_user,
                        'subject' => "Selamat bergabung di JavaCodeAPP Cafe",
                        'message' => "Hai {$user->nama}, selamat bergabung di javacodeapp cafe, berikut password untuk akun anda {$password}",
                    ];

                    send_mail($db, $mail);
                } catch (Exception $e) {
                    return unprocessResponse($response, ["Terjadi masalah pada server"]);
                }

                $user = get_account($db, $params['email']);
            }
        } else {
            $validasi = validasi($params, ["password" => "required"]);

            if ($validasi !== true) {
                return unprocessResponse($response, $validasi);
            }

            if (!isset($user->id_user)) {
                return nocontentResponse($response);
            }

            if (sha1($params['password']) !== $user->password) {
                return unprocessResponse($response, ['Password yang anda masukkan salah !']);
            }
        }

        if ($user->pin == 111111) {

            $mail = [
                'id_user' => $user->id_user,
                'subject' => "PIN JavaCodeAPP Cafe",
                'message' => "Hai {$user->nama}, akunmu masih menggunakan PIN default. Harap segera ubah pin.",
            ];

            send_mail($db, $mail);
        }


        $_SESSION['user']['id_user'] = $user->id_user;
        $_SESSION['user']['email'] = $user->email;
        $_SESSION['user']['nama'] = $user->nama;
        $_SESSION['user']['pin'] = $user->pin;
        $_SESSION['user']['foto'] = $user->foto;
        $_SESSION['user']['m_roles_id'] = $user->m_roles_id;
        $_SESSION['user']['is_google'] = $user->is_google;
        $_SESSION['user']['is_customer'] = $user->is_customer;
        $_SESSION['user']['roles'] = $user->roles;
        $_SESSION['user']['akses'] = json_decode($user->akses);
        $_SESSION['token'] = token();

        return successResponse($response, $_SESSION);
    } else {
        return unprocessResponse($response, $validasi);
    }
})->setName('login');

/**
 * Ambil semua roles aktif
 */
$app->get("/auth/roles", function ($request, $response) {
    $db = $this->db;
    $db->select("a.*")
        ->from('m_roles a')
        ->where("a.is_deleted", "=", 0);
    $roles = $db->findAll();

    if (empty($roles)) {
        return nocontentResponse($response);
    }

    return successResponse($response, $roles);
});

/**
 * Ambil semua roles aktif
 */
$app->post("/auth/akses", function ($request, $response) {
    $params = $request->getParams();
    $db = $this->db;

    try {
        $roles = $db->insert("m_roles", $params);
        return successResponse($response, $roles);
    } catch (Exception $e) {
        return unprocessResponse($response, ["Terjadi masalah pada server"]);
    }
});
/**
 * Hapus semua session
 */
$app->get('/auth/logout', function ($request, $response) {
    if (!isset($_SESSION['user']['m_roles_id'])) {
        return successResponse($response, ['Anda telah logout']);
    }
    session_destroy();
    return successResponse($response, ['Berhasil logout']);
})->setName('logout');
