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
        $resulado = false;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();
        $usuario = null;

        $query = "SELECT " . \ConstantesDB\ConsUsersModel::ID . ","
            . \ConstantesDB\ConsUsersModel::PASSWORD . ","
            . \ConstantesDB\ConsUsersModel::NAME . " FROM " . \ConstantesDB\ConsUsersModel::TABLE_NAME
            . " WHERE " . \ConstantesDB\ConsUsersModel::NAME . " = ?";;


        $prep_query = $db_connection->prepare($query);

        $prep_query->bind_param('s', $user);

        $prep_query->execute();

        $prep_query->bind_result($id, $usuario, $contrasena);
        while ($prep_query->fetch()) {
            $usuario = new UserModel($id, $usuario, $contrasena);
        }

        if ($usuario != null)
        {
            $resultado = true;
        }


        return resultado;
    }

}