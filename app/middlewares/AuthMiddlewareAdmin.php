<?php
class AuthMiddlewareAdmin extends Middlewares {
    public function handle()
    {
        if( Session::data('role') !=='admin'){
            $response = new Response();
            $response->redirect('auth');
        }
    }
}
?>