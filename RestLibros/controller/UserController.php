<?php
/**
 * Created by PhpStorm.
 * User: aleja
 * Date: 25/02/2018
 * Time: 14:56
 */

class UserController
{
    public function manageGetVerb(Request $request)
    {

        $listaUsers = null;
        $id = null;
        $response = null;
        $code = null;

        //if the URI refers to a libro entity, instead of the libro collection
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }


        $listaUsers = UserHandlerModel::getUser($id);

        if ($listaUsers != null) {
            $code = '200';

        } else {

            //We could send 404 in any case, but if we want more precission,
            //we can send 400 if the syntax of the entity was incorrect...
            if (UserHandlerModel::isValid($id)) {
                $code = '404';
            } else {
                $code = '400';
            }

        }

        $response = new Response($code, null, $listaUsers, $request->getAccept());
        $response->generate();

    }
}