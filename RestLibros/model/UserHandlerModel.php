<?php

/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 9/02/18
 * Time: 9:42
 */
require_once "ConsUsersModel.php";
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

    public static function getUser($id)
    {
        $listaUsers = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        //IMPORTANT: we have to be very careful about automatic data type conversions in MySQL.
        //For example, if we have a column named "cod", whose type is int, and execute this query:
        //SELECT * FROM table WHERE cod = "3yrtdf"
        //it will be converted into:
        //SELECT * FROM table WHERE cod = 3
        //That's the reason why I decided to create isValid method,
        //I had problems when the URI was like libro/2jfdsyfsd

        $valid = self::isValid($id);

        //If the $id is valid or the client asks for the collection ($id is null)
        if ($valid === true || $id == null) {
            $query = "SELECT " . \ConstantesDB\ConsUsersModel::ID . ","
                . \ConstantesDB\ConsUsersModel::NAME . ","
                . \ConstantesDB\ConsUsersModel::PASSWORD . " FROM " . \ConstantesDB\ConsUsersModel::TABLE_NAME;


            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsUsersModel::ID . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            //IMPORTANT: If we do not want to expose our primary keys in the URIS,
            //we can use a function to transform them.
            //For example, we can use hash_hmac:
            //http://php.net/manual/es/function.hash-hmac.php
            //In this example we expose primary keys considering pedagogical reasons

            if ($id != null) {
                $prep_query->bind_param('s', $id);
            }

            $prep_query->execute();
            $listaUsers = array();

            //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
            // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
            // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
            // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result

            $prep_query->bind_result($id, $user, $pass);
            while ($prep_query->fetch()) {
                $user = new UserModel($id, $user, $pass);
                $listaUsers[] = $user;
            }

//            $result = $prep_query->get_result();
//            for ($i = 0; $row = $result->fetch_object(LibroModel::class); $i++) {
//
//                $listaLibros[$i] = $row;
//            }
        }
        $db_connection->close();

        return $listaUsers;
    }

    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }
        return $res;
    }

}