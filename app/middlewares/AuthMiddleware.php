<?php
class AuthMiddleware extends Middlewares {
    public function handle()
    {
        if(Session::data('isLogin')==null){
            $response = new Response();
            $response->redirect('auth');
        }
    }
}
?>