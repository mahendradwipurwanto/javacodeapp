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
  $password = random_int(1000, 9999);

  // insert checking process here

  return $password;
}

function create_struk($db)
{
  $order = $db->find("SELECT COUNT(no_struk) as jumlah FROM m_order WHERE MONTH(tanggal) = MONTH(CURRENT_DATE())");
  $order = $order->jumlah + 1;
  $id = str_pad($order, 3, '0', STR_PAD_LEFT);

  $no_struk = $id . "/KWT" . "/" . date("m") . "/" . date("Y");

  return $no_struk;
}

// Database function
function get_account($db, $email)
{
  $db->select("m_user.*, m_roles.akses")
    ->from("m_user")
    ->leftJoin("m_roles", "m_roles.id = m_user.m_roles_id")
    ->where("email", "=", $email);
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