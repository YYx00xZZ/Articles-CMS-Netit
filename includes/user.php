<?php
    class User{
        public function fetch_all_users(){
            global $pdo;
            $query = $pdo->prepare("SELECT * FROM users ORDER BY user_id DESC");
            $query->execute();
            return $query->fetchAll();
        }
        public function fetch_data_user($user_id){
            global $pdo;
            $query = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
            $query->bindValue(1, $user_id);
            $query->execute();
            return $query->fetch();
        }
    }
?>