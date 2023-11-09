<?php
class Setting extends Controller
{
    public $setting_model, $data, $request, $response, $session;
    public function __construct()
    {
        $this->setting_model = $this->model('SettingModel');
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
    }
    function index()
    {
        $inforWeb = $this->setting_model->getInforWebsite();
        $success = $this->session->flash('update_success');
        foreach ($inforWeb as $value) {
            $this->data['sub_content'][$value['name']] = $value['value'];
        }
        $this->data['sub_content']['success'] = $success;
        $this->data['content'] = 'admin/setting/index';
        $this->render('layout/admin_layout', $this->data);
    }
    function handle_infor()
    {
        if ($this->request->isPost()) {
            $data = $this->request->getFields();
            $this->request->rules(
                [
                    'business_name' => 'required|min:2|max:100',
                    'address' => 'required|min:10|max:500',
                    'email' => 'required|min:10|max:100',
                    'phone' => 'required|phone|max:10',
                    

                ]
            );
            $this->request->messages([
                'business_name.required' => 'Tên công ty không được để trống',
                'business_name.min' => 'Tên công ty tối thiểu 2 kí tự',
                'business_name.max' => 'Tên công ty không quá 100 kí tự',
                'address.required' => 'Địa chỉ không được để trống',
                'address.min' => 'Địa chỉ tối thiểu 10 kí tự',
                'address.max' => 'Địa chỉ không quá 500 kí tự',
                'email.required' => 'Địa chỉ email không được để trống',
                'email.min' => 'Địa chỉ email tối thiểu 10 kí tự',
                'email.max' => 'Địa chỉ email không quá 100 kí tự',
                'phone.required' => 'SDT không được để trống',
                'phone.phone' => 'SDT không đúng định dạng',
                'phone.max' => 'SDT không đúng định dạng',
            ]);

            if ($this->request->valides()) {
                echo '<pre>';
                print_r($data);
                echo '</pre>';
                $result = $this->setting_model->updateWebsite($data);
                if ($result) {
                    $this->session->data('update_success', 'Cập nhật thành công!');
                    $this->response->redirect('admin/setting');
                } else {
                    $this->session->data('update_error', 'Cập nhật thất bại!');
                    $this->response->redirect('admin/setting');
                }
            } else {
                $this->response->redirect('admin/setting');
            }
        } else {
            $this->response->redirect('admin/setting');
        }
    }
}
?>