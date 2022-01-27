<?php

function vd($data)
{
  var_dump($data);
  die;
}

function token()
{
  return "m_app";
}

function create_password()
{
  $password = random_int(100000, 999999);

  // insert checking process here

  return $password;
}

function base64ToFile2($base64, $path, $custom_name = null)
{

  $img = str_replace(' ', '+', $base64);
  $data = base64_decode($img);
  $file = $path . uniqid() . '.jpeg';
  $success = file_put_contents($file, $data);
  print $success ? $file : 'Unable to save the file.';
  die;
  if (isset($base64['base64'])) {
    $extension = substr($base64['filename'], strrpos($base64['filename'], ",") + 1);

    if (!empty($custom_name)) {
      $nama = $custom_name;
    } else {
      $nama = $base64['filename'];
    }

    $file = base64_decode($base64['base64']);
    file_put_contents($path . '/' . $nama, $file);

    return [
      'fileName' => $nama,
      'filePath' => $path . '/' . $nama,
    ];
  } else {
    return [
      'fileName' => '',
      'filePath' => '',
    ];
  }
}

function create_struk($db)
{
  $order = $db->find("SELECT COUNT(no_struk) as jumlah FROM m_order WHERE MONTH(tanggal) = MONTH(CURRENT_DATE())");
  $order = $order->jumlah + 1;
  $id = str_pad($order, 3, '0', STR_PAD_LEFT);

  $no_struk = $id . "/KWT" . "/" . date("m") . "/" . date("Y");

  return $no_struk;
}

function send_mail($db, $params)
{

  $user = get_user($db, $params['id_user']);

  $data = [
    'name' => $user->nama,
    'to' => $user->email,
    'subject' => $params['subject'],
    'message' => $params['message']
  ];
  return mailer($data);
}

// Database function
function get_account($db, $email)
{
  $db->select("m_user.*, m_roles.nama as roles, m_roles.akses")
    ->from("m_user")
    ->leftJoin("m_roles", "m_roles.id = m_user.m_roles_id")
    ->where("email", "=", $email);
  $user = $db->find();
  return $user;
}
function get_user($db, $id_user)
{
  $db->select("*")
    ->from("m_user")
    ->where("id_user", "=", $id_user);
  $user = $db->find();
  return $user;
}

function get_menuDetail($db, $id_menu, $type = null)
{
  $db->select("a.id_detail, a.id_menu, a.keterangan, a.type, a.harga")
    ->from("m_menu_detail a")
    ->where("a.id_menu", "=", $id_menu);
  if ($type != null) {
    $db->where("type", "LIKE", $type);
  }

  return $db->findAll();
}

function get_orderDetail($db, $id_order)
{
  $db->select("a.id_menu, b.kategori, b.nama, b.foto, a.jumlah, ROUND((a.total/a.jumlah)) as harga, a.total, a.catatan")
    ->from("m_detail_order a")
    ->leftJoin("m_menu b", "a.id_menu = b.id_menu")
    ->where("a.id_order", "=", $id_order);
  $menu = $db->findAll();
  return $menu;
}

function get_order($db, $id_order)
{
  $db->select("*")
    ->from("m_order a")
    ->where("a.id_order", "=", $id_order);
  $order = $db->find();
  return $order;
}

function orderVoucher($db, $id_voucher, $nominal)
{

  $db->select("*")
    ->from("m_voucher")
    ->where("id_voucher", "=", $id_voucher);
  $voucher = $db->find();

  if (isset($voucher->id_voucher)) {
    $nominal = ($voucher->nominal - $nominal) <= 0 ? 0 : ($voucher->nominal - $nominal);
    if ($voucher->type === 1) {
      // berkurang
      $status = 1;
      $data = [
        'nominal' => $nominal,
        'status' => $nominal <= 0 ? 0 : 1
      ];
    } else {
      // sekali pakai
      $data = [
        'nominal' => $nominal,
        'status' => 0
      ];
    }
    $db->update('m_promo', ['nominal' => $nominal], ['id_promo' => $voucher->id_promo]);

    return $db->update('m_voucher', $data, ['id_voucher' => $id_voucher]);
  }
}

function orderDiskon($db, $id_diskon)
{
  $id = json_decode($id_diskon, true);

  foreach ($id as $key) {
    $db->update('m_diskon', ['status' => 0], ['id_diskon' => $key]);
  }
}
