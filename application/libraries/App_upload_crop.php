<?php

class App_upload_crop
{
    protected $config;

    public function __construct($config=[])
    {
        $this->config = $config;
    }

    public function upload()
    {
        $CI =& get_instance();

        $config = [
            'upload_path'   => './public/'.$this->config['pasta'].'/',
            'allowed_types' => 'gif|png|jpg|jpeg',
            'max_size'      => '5000',
            'max_width'     => '6000',
            'max_height'    => '6000',
            'encrypt_name'  => TRUE
        ];

        $CI->load->library('upload', $config);

        $campo = $this->config['campo'];
        $img_antes = $campo . '_antes';

        if ( ! $CI->upload->do_upload($campo))
        {
            echo('Oops... ' . $CI->upload->display_errors(''));
        }

        $imagem = $CI->upload->data();

        // Remove imagem antiga
        if ($CI->input->post($img_antes))
        {
            $imagem_antiga = $config['upload_path'] . $_POST[$img_antes];
            $this->remove_imagem($imagem_antiga);
        }

        // Redimensiona a imagem
        $tamanho = $this->config['tamanho'];
        $altura  = $this->config['altura'];
        $x  = $this->config['x'];
        $y  = $this->config['y'];
        $x2  = $this->config['x2'];
        $y2  = $this->config['y2'];
        
        $config = [
            'image_library'  => 'gd2',
            'source_image'   => $imagem['file_path'] . $imagem['file_name'],
            'maintain_ratio' => FALSE,
            'width'          => $tamanho,
            'height'         => $altura
        ];
        
        $quality = 90;
        $dst_r = ImageCreateTrueColor($tamanho, $altura);
        $what = getimagesize($imagem['file_path'] .  $imagem['file_name']);

        switch(strtolower($what['mime'])) {
            case 'image/png':
                $img_r = imagecreatefrompng($imagem['file_path'] .  $imagem['file_name']);

                imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);
                
                # Genetate a png
                imagepng($dst_r, $imagem['file_path'] .  $imagem['file_name'], $quality);
                break;
            
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($imagem['file_path'] .  $imagem['file_name']);

                imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $tamanho, $altura, $tamanho, $altura);
                
                # Generates a jpeg.
                imagejpeg($dst_r, $imagem['file_path'] .  $imagem['file_name'], $quality);
                break;
            
            case 'image/gif':
                $img_r = imagecreatefromgif($imagem['file_path'] .  $imagem['file_name']);

                imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);
                
                # Generates a gif.
                imagegif($dst_r, $imagem['file_path'] .  $imagem['file_name'], $quality);
                break;

            default: die();
        }
       

        //Obs.. Criar thumbnail
        //$config = [
        //    'new_image'      => $imagem['file_path'] . $imagem['file_name'],
        //    'create_thumb'   => TRUE,
        //    'thumb_marker'   => '_thumb',
        //];

        $CI->load->library('image_lib', $config);

        if ( ! $CI->image_lib->resize())
        {
            abort('Oops.. Operação não realizada: ' . $CI->image_lib->display_errors());
        }

        return $imagem['file_name'];
    }

    public function remove_imagem($imagem)
    {
        @unlink($imagem);
    }
}
