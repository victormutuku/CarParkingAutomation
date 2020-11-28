<?php
    interface Account {
        public function register ($pdo);
        public function login($pdo);
        public function carReg($pdo);
        public function carcheckout($pdo);
        public function logout ($pdo);
    }
?>