<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view('admin/test');
    }
    public function do_upload()
    {
        if(!$this->input->is_ajax_request()){
            show_404();
        }
        try{
            if( ! empty($_FILES['myfile']))
            {
                $watermark_type = $this->input->post('watermark_type');
                $config=  array(
                    'upload_path'      => "./uploads/files/img/",
                    'allowed_types'   => "gif|jpg|png|jpeg",
                    'overwrite'       => TRUE,
                    // 'max_size'        => "1000KB",
                );
                if(!is_dir($config['upload_path'])){
                    mkdir($config['upload_path'], 0777, TRUE);
                }
                
                $this->load->library('upload', $config);
                $response = false;
                if($this->upload->do_upload('myfile'))
                {
                    $response['status'] = 'success';
                    $response['message'] = 'Successfully uploaded';
                    $response['data'] = $this->upload->data();

                    //Watermark newly uploaded image
                    $this->load->library('image_lib');
                    $config['source_image'] = './uploads/files/img/'.$response['data']['file_name'];
                    
                    if($watermark_type == 'text'){
                        $config['wm_text'] = 'kodemadesimple.com';
                        $config['wm_type'] = 'text';
                        $config['wm_font_path'] = 'C:/xampp/htdocs/pnghill/assets/font.ttf';
                        $config['wm_font_size'] = 16;
                        $config['wm_font_color'] = 'ffffff';
                        $config['wm_padding'] = '20';
                    }
                    else if($watermark_type == 'overlay'){
                        $config['image_library'] = 'gd2';
                        $config['wm_type'] = 'overlay';
                        $config['wm_overlay_path'] = './assets/watermark3.png';//the overlay image
                        $config['wm_x_transp'] = 4;
                        $config['wm_y_transp'] = 4;
                        $config['width'] = 50;
                        $config['height'] = 50;
                        $config['padding'] = 50;
                        $config['wm_opacity'] = 40;
                    }
                    $config['wm_vrt_alignment'] = 'middle';
                    $config['wm_hor_alignment'] = 'center';

                    $this->image_lib->initialize($config);
                    if (!$this->image_lib->watermark()) {
                        $response['wm_errors'] = $this->image_lib->display_errors();
                        $response['wm_status'] = 'error';
                    } else {
                        $response['wm_status'] = 'success';
                    }
                }
                else
                {
                    $response['status'] = 'error';
                    $response['message'] = 'Failed to upload file';
                    $response['errors'] = $this->upload->display_errors();
                }
            }
            else{
                $response['status'] = 'error';
                $response['message'] = 'Please select an image to upload';
            }
        }
        catch(Exception $e){
            $response['status']='error';
            $response['message']='Something went wrong while trying to communicate with the server.';
        }
        echo json_encode($response);
    }
}