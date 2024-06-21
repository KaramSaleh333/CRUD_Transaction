<?php

namespace Controllers;

class UserController {

    public $db;
    
    public function __construct()
    {
        include 'database_connect.php';
        $this->db = $db;
    }

    public function register($request)
    {
        // validation  -------------------------------
        session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
        if(! $request['user_name']){
            $_SESSION['validate_error'] = 'user name is required';
            header("location: creat_account.php");
            exit(); 
        }elseif(! $request['email']){
            $_SESSION['validate_error'] = 'email required';
            header("location: creat_account.php");
            exit(); 
        }elseif(doit($this->db , "select email from users where email = '$request[email]' ")){
            $_SESSION['validate_error'] = 'email is already exists';
            header("location: creat_account.php");
            exit(); 
        }elseif(! $request['password']){
            $_SESSION['validate_error'] = 'password required';
            header("location: creat_account.php");
            exit(); 
        }elseif(strlen($request['password']) < 8){
            $_SESSION['validate_error'] = 'password must be at least 8 char';
            header("location: creat_account.php");
            exit(); 
        }elseif($request['password'] != $request['Confirm_password']){
            $_SESSION['validate_error'] = 'password not equal Confirm Password';
            header("location: creat_account.php");
            exit(); 
        }
        
        // creation  -------------------------------
        $now = date('y-m-d h:i:s' , time());
        doit($this->db , "insert into users(name , email , password , created_at , updated_at)
        values('$request[user_name]' , '$request[email]' ,'$request[password]' , '$now' , '$now')");
        
        $user_id = doit($this->db ,"select id from users where email = '$request[email]' limit 1");
        
        $_SESSION['id'] = $user_id['id'];
        $_SESSION['created_at'] = time();
        
        header("location: home_page.php");
        exit();

    }

    public function login($request)
    {

        // validation  -------------------------------

        session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
        if(! $request['email']){
            $_SESSION['login_error'] = 'email required';
            header("location: login.php");
            exit(); 
        }elseif(! $request['password']){
            $_SESSION['login_error'] = 'password required';
            header("location: login.php");
            exit(); 
        }elseif(! $user = doit($this->db , "select * from users where email = '$request[email]' ")){
            $_SESSION['login_error'] = 'email is not exists';
            header("location: login.php");
            exit(); 
        }elseif($user['password'] != $request['password']){
            $_SESSION['login_error'] = 'password is wrong';
            header("location: login.php");
            exit(); 
        }

        // Authentication  -------------------------------

        $_SESSION['id'] = $user['id'];
        $_SESSION['created_at'] = time();
    
        header("location: home_page.php");
        exit();

    }

    public function logout()
    {
        session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
        session_unset();
        session_destroy();
        header("location: login.php");
        exit();
    }
    
    public function update($request)
    {
        session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
        // Email and Name Update ------------------------
        if(isset($request['email'])){
    
            if(! $request['user_name']){
                $_SESSION['validate_error'] = 'user name is required';
                header("location: edit_info.php");
                exit(); 
            }elseif(! $request['email']){
                $_SESSION['validate_error'] = 'email required';
                header("location: edit_info.php");
                exit(); 
            }
            $now = date('y-m-d h:i:s' , time());
            doit( $this->db  ,  "UPDATE `users` SET `name`='$request[user_name]',`email` = '$request[email]' , `updated_at` = '$now' where `id` = '$_SESSION[id]' ");
            header("location: edit_info.php");
            exit();
        // Password  Update ------------------------
        }elseif(isset($request['password'])){

            if(strlen($request['password']) < 8){
                $_SESSION['password_error'] = 'password must be at least 8 char';
                header("location: edit_info.php");
                exit(); 
            }elseif($request['password'] != $request['Confirm_password'] ){
                $_SESSION['password_error'] = 'password not equal Confirm Password';
                header("location: edit_info.php");
                exit(); 
            }
        
            $now = date('y-m-d h:i:s' , time());
            doit( $this->db  ,  "UPDATE `users` SET `password` = '$request[password]' , `updated_at` = '$now' where `id` = '$_SESSION[id]' ");
            header("location: edit_info.php");
            exit();
        
        }

    }

    public function delete()
    {
        session_start(['name'=> 'xc','cookie_lifetime' => 3600*2]);
        doit($this->db , "DELETE FROM `users` WHERE id = '$_SESSION[id]'");
        session_unset();
        session_destroy();
        header("location: login.php");
        exit();

    }


}
