<?php 
    class QueryBuilder{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getAll($table){
            $statement = $this->pdo->prepare("select * from $table");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function getbyId($table, $id){
            $statement = $this->pdo->prepare("select * from $table where id = $id");
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        }

        public function getbyfilter($table, $id){
            $statement = $this->pdo->prepare("select * from $table where category_id = $id");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function insert($dataArr, $table){
            $columns = implode(",", array_keys($dataArr));
            $values = "'" . implode("','", array_values($dataArr)) . "'";
        
            $sql = "INSERT INTO $table ($columns) VALUES ($values)";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        }

        public function update($dataArr, $table, $id) {
            $setClause = "";
            foreach ($dataArr as $column => $value) {
                $setClause .= "$column = :$column, ";
            }
            $setClause = rtrim($setClause, ', '); 

            $sql = "UPDATE $table SET $setClause WHERE id= :id";

            $statement = $this->pdo->prepare($sql);
        
            foreach ($dataArr as $column => $value) {
                $statement->bindValue(":$column", $value);
            }
            $statement->bindValue(":id", $id);
        
            return $statement->execute();
        }

        public function findByEmail($email){
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        }

        public function findByName($name){
            $statement = $this->pdo->prepare("SELECT * FROM users WHERE username = :name");
            $statement->bindParam(':name', $name, PDO::PARAM_STR);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_OBJ);
        }

        public function delete($table, $id){
            $statement = $this->pdo->prepare("delete from $table where id = $id");
            return $statement->execute();
        }

        public function showThreeItems($table, $limit){
            $statement = $this->pdo->prepare("SELECT * FROM $table ORDER BY RAND() DESC  LIMIT $limit;");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function lastInsertId(){
            return $this->pdo->lastInsertId();
        }

        public function showOrders(){
            $statement = $this->pdo->prepare("SELECT orders.id AS order_id, order_items.product_id, orders.user_id, orders.order_date,  order_items.quantity
            FROM orders
            JOIN order_items ON orders.id = order_items.order_id");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function deleteOrderItems($id){
            $statement =  $this->pdo->prepare("DELETE FROM order_items WHERE order_id = $id");
            return $statement->execute();
        }

        public function search($search, $table){
            $statement = $this->pdo->prepare("SELECT * FROM $table WHERE name LIKE '%$search%' OR description LIKE '%$search%' ");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }

        public function betweenPrice($max, $min, $table){
            $statement = $this->pdo->prepare("SELECT * FROM $table WHERE price BETWEEN $min AND $max");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }
    };
