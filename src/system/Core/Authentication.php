<?php

namespace System\Core;

use System\Core\PHPFunctions as PHP;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\Models\Users;
use App\Models\LogUsers;

class Authentication
{
    public static function authenticated():bool
    {
        return !PHP::is_null(Session::get('authenticated'));
    }

    public static function authenticate():array
    {
        $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

        $error = Validation::createValidator()->validate($user, [new Length(['min'=>3, 'max'=>64]), new NotBlank()]);

        if (count($error))
        {
            return $error;
        }

        $user = Users::find(['conditions'=>['user_name = ?', $user]]);

        if (!PHP::is_object($user) && !PHP::password_verify($pass, $user->password)) {
            return ['Usuário ou senha inválidos'];
        }

        $user->last_access = date('Y-m-d H:i:s');
        $user->save();

        LogUsers::create([
                            'init'=>date('Y-m-d H:i:s'),
                            'users_id'=>$user->id
                       ]);
        Session::set('user_id', $user->id);
        Session::set('authenticated', PHP::md5(PHP::getenv('SECURITY_KEY').$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));
        Session::set('session_lifetime', time());

        return [];
    }

    public static function authorized($rule):bool
    {
        
    }
}