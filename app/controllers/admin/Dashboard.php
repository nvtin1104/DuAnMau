<?php
class Dashboard extends Controller
{
    public $dashboard_model, $data;
    public function __construct()
    {
        $this->dashboard_model = $this->model('Dashboard');
    }
    function index()
    {
        $this->data['content'] = 'admin/dashboard/dashboard';
        $this->render('layout/admin_layout', $this->data);
    }
}
?>
