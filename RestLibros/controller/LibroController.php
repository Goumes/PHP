<?php

require_once "Controller.php";


class LibroController extends Controller
{
    public function manageGetVerb(Request $request)
    {

        $listaLibros = null;
        $id = null;
        $response = null;
        $code = null;

        //if the URI refers to a libro entity, instead of the libro collection
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }


        $listaLibros = LibroHandlerModel::getLibro($id);

        if ($listaLibros != null) {
            $code = '200';

        } else {

            //We could send 404 in any case, but if we want more precission,
            //we can send 400 if the syntax of the entity was incorrect...
            if (LibroHandlerModel::isValid($id)) {
                $code = '404';
            } else {
                $code = '400';
            }

        }

        $response = new Response($code, null, $listaLibros, $request->getAccept());
        $response->generate();

    }

    public function manageDeleteVerb(Request $request)
    {

        $id = null;
        $response = null;
        $code = null;

        //if the URI refers to a libro entity, instead of the libro collection
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }


        LibroHandlerModel::deleteLibro($id);


        //We could send 404 in any case, but if we want more precission,
        //we can send 400 if the syntax of the entity was incorrect...
        if (LibroHandlerModel::isValid($id)) {
            $code = '404';
        } else {
            $code = '400';
        }


        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();

    }

    public function managePostVerb(Request $request)
    {
        $id = null;
        $response = null;
        $code = null;
        $libro = new LibroModel();

        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        $array = $request->getBodyParameters();

        $libro->setTitulo($array[0]);
        $libro->setCodigo($array[1]);
        $libro->setNumpag($array[2]);

        LibroHandlerModel::insertLibro($libro);


        if (LibroHandlerModel::isValid($id)) {
            $code = '404';
        } else {
            $code = '400';
        }


        $response = new Response('405', null, null, $request->getAccept());
        $response->generate();
    }

}