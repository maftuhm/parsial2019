<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

        /* COMMON :: ADMIN & PUBLIC */
        /* Load */
        $this->load->database();
        //$this->set_timezone();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->add_package_path(APPPATH . 'third_party/ion_auth/');
        $this->load->config('common/dp_config');
        $this->load->config('common/dp_language');
        $this->load->library(array('form_validation', 'ion_auth', 'template', 'common/mobile_detect', 'user_agent', 'encryption'));
        $this->load->helper(array('array', 'language', 'url', 'anything', 'security', 'text'));
        $this->load->model(array('common/prefs_model', 'common/common_model'));

        /* Data */
        $this->data['lang']           = element($this->config->item('language'), $this->config->item('language_abbr'));
        $this->data['charset']        = $this->config->item('charset');
        $this->data['frameworks_dir'] = $this->config->item('frameworks_dir');
        $this->data['plugins_dir']    = $this->config->item('plugins_dir');
        $this->data['avatar_dir']     = $this->config->item('avatar_dir');
        $this->data['images_dir']      = $this->config->item('images_dir');

        $this->table                  = $this->config->item('tables', 'ion_auth');
        $this->content_url            = $this->config->item('content_url');
        $this->sk_url                 = $this->config->item('sk_url');
        $this->data['title']          = $this->config->item('title');
        $this->data['content_title']  = $this->config->item('content_title');

        /* Any mobile device (phones or tablets) */
        if ($this->mobile_detect->isMobile())
        {
            $this->data['mobile'] = TRUE;

            if ($this->mobile_detect->isiOS()){
                $this->data['ios']     = TRUE;
                $this->data['android'] = FALSE;
            }
            else if ($this->mobile_detect->isAndroidOS())
            {
                $this->data['ios']     = FALSE;
                $this->data['android'] = TRUE;
            }
            else
            {
                $this->data['ios']     = FALSE;
                $this->data['android'] = FALSE;
            }

            if ($this->mobile_detect->getBrowsers('IE')){
                $this->data['mobile_ie'] = TRUE;
            }
            else
            {
                $this->data['mobile_ie'] = FALSE;
            }
        }
        else
        {
            $this->data['mobile']    = FALSE;
            $this->data['ios']       = FALSE;
            $this->data['android']   = FALSE;
            $this->data['mobile_ie'] = FALSE;
        }
	}
}


class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

        if ( ! $this->ion_auth->logged_in()/* OR ! $this->ion_auth->is_admin()*/)
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Load */
            $this->load->config('admin/dp_config');
            $this->load->library(array('admin/page_title', 'admin/breadcrumbs'/*, 'admin/load_data'*/));
            $this->load->model(array('admin/admin_model', 'admin/core_model'));
            $this->load->helper(array('menu', 'gravatar'));
            $this->lang->load(array('admin/main_header', 'admin/main_sidebar', 'admin/footer', 'admin/actions'));

            /* Load library function  */
            $this->breadcrumbs->unshift(0, $this->lang->line('menu_dashboard'), 'admin/dashboard');

            /* Data */
            // $this->data['title']       = $this->config->item('title');
            $this->data['title_lg']    = $this->config->item('title_lg');
            $this->data['title_mini']  = $this->config->item('title_mini');
            $this->data['admin_prefs'] = $this->prefs_model->admin_prefs();
            $this->data['user_login']  = $this->prefs_model->user_info_login($this->ion_auth->user()->row()->id);

            if ($this->router->fetch_class() == 'dashboard')
            {
                $this->data['dashboard_alert_file_install'] = $this->core_model->get_file_install();
                $this->data['header_alert_file_install']    = NULL;
            }
            else
            {
                $this->data['dashboard_alert_file_install'] = NULL;
                $this->data['header_alert_file_install']    = NULL; /* << A MODIFIER !!! */
            }
            if ($this->ion_auth->is_admin())
            {
                $this->data['admin_menu'] = TRUE;
            }else{
                $this->data['admin_menu'] = FALSE;                
            }
        }
    }
}


class Public_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->lang->load(array('public/participants', 'admin/actions'));
        $this->form_validation->set_error_delimiters('', '');
        $this->table = $this->config->item('tables', 'ion_auth');
        $this->data['modal_success'] = '';
        $this->data['error'] = '';
        $this->data['message'] = '';
        $this->data['show_filedrag'] = FALSE;
        $this->data['futsal_js'] = FALSE;
        $this->data['singcomp_js'] = FALSE;

        if ($this->ion_auth->logged_in()/* && $this->ion_auth->is_admin()*/)
        {
            $this->data['admin_link'] = TRUE;
        }
        else
        {
            $this->data['admin_link'] = FALSE;
        }

        if ($this->ion_auth->logged_in())
        {
            $this->data['logout_link'] = TRUE;
        }
        else
        {
            $this->data['logout_link'] = FALSE;
        }
	}
}
