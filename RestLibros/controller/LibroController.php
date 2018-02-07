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
        $libro = null;
        $codigo = null;
        $numpag = null;
        $titulo = null;

        if ($request->getBodyParameters() != null) {
            $codigo = $request->getBodyParameters()->codigo;
            $numpag = $request->getBodyParameters()->numpag;
            $titulo = $request->getBodyParameters()->titulo;
        }

        else
        {
            $code = 400;
        }

        $libro = new LibroModel($codigo, $titulo, $numpag);

        //if the URI refers to a libro entity, instead of the libro collection
        /*
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }
        */

        LibroHandlerModel::postLibro($libro);


        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();

    }

    public function managePutVerb(Request $request)
    {

        $id = null;
        $response = null;
        $code = null;
        $libro = null;
        $codigo = null;
        $numpag = null;
        $titulo = null;

        $id = $request->getUrlElements()[2];

        if ($request->getBodyParameters() != null) {
            $titulo = $request->getBodyParameters()->titulo;
            $codigo = $request->getBodyParameters()->codigo;
            $numpag = $request->getBodyParameters()->numpag;

        }

        else
        {
            $code = 400;
        }

        $libro = new LibroModel($codigo, $titulo, $numpag);

        //if the URI refers to a libro entity, instead of the libro collection
        /*
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }
        */

        LibroHandlerModel::putLibro($libro, $id);


        $response = new Response($code, null, null, $request->getAccept());
        $response->generate();

    }

}