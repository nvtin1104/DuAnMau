<?php
class ParamsMiddleware extends Middlewares
{
    public function handle()
    {
        if (empty($_SERVER['QUERY_STRING'])) {
            $response = new Response();
            var_dump(Routes::getFullUrl());
            // $response->redirect(Routes::getFullUrl());
        }
    }
}
?>