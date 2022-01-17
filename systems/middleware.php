<?php

$app->add(function ($request, $response, $next) {
    /**
     * Get route name
     */
    $route = $request->getAttribute('route');

    $routeName = '';
    if ($route !== null) {
        $routeName = $route->getName();
    }

    /**
     * Set Global route
     */

    $publicRoutesArray = array(
        'session',
        'login',
        'logout'
    );

    // get header token if token is mobile
    $headers = $request->getHeaders();

    // if not send header token, read as web browser access
    if (!isset($headers['HTTP_TOKEN']) && empty($headers['HTTP_TOKEN'])) {

        /**
         * Return if isset session
         */

        if ((!isset($_SESSION['user']['id_user']) || !isset($_SESSION['user']['m_roles_id']) || !isset($_SESSION['user']['akses'])) && !in_array($routeName, $publicRoutesArray)) {
            return unauthorizedResponse($response, ['Mohon maaf, anda tidak mempunyai akses'])
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('content-type', 'application/json');
        }

    }

    // if there is a header token. check if token right
    if (isset($headers['HTTP_TOKEN'])) {
        if ($headers['HTTP_TOKEN'] == "m_app") {
            return unauthorizedResponse($response, ['Token tidak dikenali'])
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('content-type', 'application/json');
        }
    }

    // vd($headers['HTTP_TOKEN']);

    return $next($request, $response);
});
