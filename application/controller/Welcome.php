<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}

	/**
     * Salva dados do formulário
     * @return void
     */
    public function salvar()
    {
        if ($_FILES)
        {
            
            $config = [
                'x'         => $this->input->post('x'),
                'y'         => $this->input->post('y'),
                'x2'        => $this->input->post('x2'),
                'y2'        => $this->input->post('y2'),
                'campo'     => 'imagem',
                'pasta'     => 'blog',
                'tamanho'   => $this->input->post('w'),
                'altura'    => $this->input->post('h')
            ];

            $this->load->library('app_upload_crop', $config);
            $post['imagem'] = $this->app_upload_crop->upload();
        }


        redirect('welcome');
    }

}
