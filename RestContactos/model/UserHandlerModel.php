<?php

/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 9/02/18
 * Time: 9:42
 */
class UserHandlerModel
{
    public function verifyPassword ($user, $password)
    {
        $resultado = false;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();
        $usuario = null;

        /*
        $query = "SELECT " . \ConstantesDB\ConsUsersModel::ID . ","
            . \ConstantesDB\ConsUsersModel::PASSWORD . ","
            . \ConstantesDB\ConsUsersModel::NAME . " FROM " . \ConstantesDB\ConsUsersModel::TABLE_NAME
            . " WHERE " . \ConstantesDB\ConsUsersModel::NAME . " = ?";
        */

        $query = "SELECT ID, password, name FROM usuarios WHERE name = ?";


        $prep_query = $db_connection->prepare($query);

        $prep_query->bind_param('s', $user);

        $prep_query->execute();

        $prep_query->bind_result($id,$contrasena, $usuario);
        while ($prep_query->fetch()) {
            //$usuarioFinal = new UserModel($id, $usuario, $contrasena);
            if ($contrasena != null)
            {
                //Comprobar contraseña aqui
                //echo $prueba = password_hash($password,PASSWORD_DEFAULT);
                $resultado = password_verify($password, $contrasena);
                //echo $resultado;
            }
        }




        return $resultado;
    }

}