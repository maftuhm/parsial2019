<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->helper('number');
        $this->load->model('admin/dashboard_model');
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in()/* OR ! $this->ion_auth->is_admin()*/)
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Title Page */
            $this->page_title->push(lang('menu_dashboard'));
            $this->data['pagetitle'] = $this->page_title->show();
            $directory = '/storage/ssd4/516/7459516';
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['count_users']       = $this->dashboard_model->get_count_record($this->table['users']);
            $this->data['count_groups']      = $this->dashboard_model->get_count_record($this->table['groups']);
            $this->data['count_tryout']      = $this->dashboard_model->get_count_record($this->table['tryout']);
            $this->data['count_mathcomp']    = $this->dashboard_model->get_count_record($this->table['mathcomp']);
            $this->data['count_futsal']      = $this->dashboard_model->get_count_record($this->table['futsal']);
            $this->data['count_singcomp']    = $this->dashboard_model->get_count_record($this->table['singcomp']);
            $this->data['disk_totalspace']   = $this->dashboard_model->disk_totalspace($directory);
            $this->data['disk_freespace']    = $this->dashboard_model->disk_freespace($directory);
            $this->data['disk_usespace']     = $this->data['disk_totalspace'] - $this->data['disk_freespace'];
            $this->data['disk_usepercent']   = $this->dashboard_model->disk_usepercent($directory, FALSE);
            $this->data['memory_usage']      = $this->dashboard_model->memory_usage();
            $this->data['memory_peak_usage'] = $this->dashboard_model->memory_peak_usage(TRUE);
            $this->data['memory_usepercent'] = $this->dashboard_model->memory_usepercent(TRUE, FALSE);


            /* TEST */
            $this->data['url_exist']    = is_url_exist('http://www.domprojects.com');


            /* Load Template */
            $this->template->admin_render('admin/dashboard/index', $this->data);
        }
	}
}
