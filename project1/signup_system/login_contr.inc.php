<?php 

declare(strict_types=1);

function is_username_wrong(bool|array $result){ //result here can be an array or a bool
    if (!$result){
        return true;
    }
    return false;
}

function is_password_wrong(string $pwd, string $hashPwd){ //result here can be an array or a bool

    if (!password_verify($pwd, $hashPwd)){ //if the password is wrong
        return true;
    }
    return false; //else password is correct
}

function is_input_empty(string $username, string $password){ //result here can be an array or a bool

    if (empty($username) || empty($password)){
        return true;
    }
    return false;
}