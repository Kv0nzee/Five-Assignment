<?php 

$productColors = [
    '1' => 'bg-zinc-700',
    '2' => 'bg-slate-600',
    '3' => 'bg-emerald-700',
    '4' => 'bg-amber-600',
];

function dd($data){
    echo "<pre>";
    die(var_dump($data));
}

function printD($data){
    die(print_r($data));
}

function redirect($uri){
    header("Location: $uri");
}

function request($name){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        return $_POST[$name];
    }
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        return $_GET[$name];
    }
}

function getAllProduct(){
    return App::get("query")->getAll("products");
}

function getAllUsers(){
    return App::get("query")->getAll("users");
}

function getAllOrders(){
    return App::get("query")->showOrders("orders");
}

function getAllOrderItems(){
    return App::get("query")->showOrders("order_items");
}

function getCategoryName($id){
    return App::get("query")->getbyId("categories", $id)->name;
}

function getAllCategories(){
    return App::get("query")->getAll("categories");
}

function getProductById($id){
    return App::get("query")->getbyId("products", $id);
}

function getProductByFilter($id){
    return App::get("query")->getbyfilter("products", $id);
}

function getUserById($id){
    return App::get("query")->getbyId("users", $id);
}

function getUserByName($name){
    return App::get("query")->findByName($name)->username;
}

function findLastInsertId(){
    return App::get("query")->lastInsertId(); 
}

function deleteProduct($id){
    return App::get("query")->delete("products", $id);
}

function deleteUser($id){
    return App::get("query")->delete("users", $id);
}

function deleteOrderItems($id){
    return App::get("query")->deleteOrderItems( $id);
}

function deleteOrder($id){
    return App::get("query")->delete("orders" ,$id);
}
function showThreeProducts(){
    return App::get("query")->showThreeItems("products", 3);
}

function addToCart($product, $qty = 1) {
    if (!isset($_SESSION['cart'][$product->id])) {
        $_SESSION['cart'][$product->id] = [
            'id'    => $product->id,
            'name'  => $product->name,
            'description' => $product->description,
            'category_id'   => $product->category_id,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'productImg'   => $product->productImg,
            'qty'          => $qty
        ];
    } else {
        $_SESSION['cart'][$product->id]["qty"] += $qty;
    }
}

function login($email, $password) {
    $user =App::get("query")->findByEmail($email);

    if ($user && verifyPassword($password, $user->password)) {
        $_SESSION['user'] = $user;
        return true;
    }
    else{
        return false;
    }
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

function register($data) {
    App::get("query")->insert($data, 'users');
    return true;
}

function createProduct($data) {
    App::get("query")->insert($data, 'products');
    return true;
}


function createOrder($data){
    $dat = App::get('query')->insert($data, 'orders');
    return $dat;
}

function createOrderItem($data){
    $dat = App::get('query')->insert($data, 'order_items');
    return $dat;
}

function updateProduct($data, $id){
    return App::get("query")->update($data, 'products', $id);
}

function updateUser($data, $id){
    return App::get("query")->update($data, 'users', $id);
}

function showSearchResult($search){
    return App::get("query")->search($search, 'products');
}

function findByPriceMinMax($max, $min){
    return App::get("query")->betweenPrice($max, $min, 'products');
}

function time_elapsed_string($ptime)
{
    if (!is_numeric($ptime)) {
        return 'Invalid timestamp';
    }

    $etime = time() - $ptime;

    if ($etime < 1) {
        return '0 seconds';
    }

    $a = array(
        365 * 24 * 60 * 60  => 'year',
        30 * 24 * 60 * 60   => 'month',
        24 * 60 * 60        => 'day',
        60 * 60             => 'hour',
        60                  => 'minute',
        1                   => 'second',
    );

    $a_plural = array(
        'year'   => 'years',
        'month'  => 'months',
        'day'    => 'days',
        'hour'   => 'hours',
        'minute' => 'minutes',
        'second' => 'seconds',
    );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }

    return 'Invalid timestamp'; 
}
