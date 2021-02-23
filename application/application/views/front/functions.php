<?php
// GET FILE SIZE
function ImageWatermark($sources){
  if ($this->load->library('image_lib')) {
    $imgConfig = array();
    $imgConfig['image_library'] = 'GD2';
    // $imgConfig['source_image']  = './uploads/fxcon/download.png';
    $imgConfig['source_image'] = $sources;
    $imgConfig['wm_type']       = 'overlay';
    $imgConfig['wm_overlay_path'] = '/assets/watermark.png';
    $this->load->library('image_lib', $imgConfig);
    $this->image_lib->initialize($imgConfig);
      if (!$this->image_lib->watermark()){
          return $this->image_lib->display_errors();
      }else{
        return TRUE;
      }
  }
}
// Resize Images
function createThumbnail($path,$w){
  $this->load->helper('string');
  $hash = random_string('alnum', 30);
  if ($w >= 640) {
    $config['width']   = 640;
  }
  $config['height']   = 'auto';
  $config['image_library'] = 'gd2';
  $config['source_image'] = $path;
  $config['create_thumb'] = TRUE;
  // $config['quality'] = '60%';
  $config['new_image'] = './uploads/x24/';
  $config['master_dim'] = 'auto';
  $this->load->library('image_lib', $config);
  if ( ! $this->image_lib->resize()){
          return $this->image_lib->display_errors();
  }else{
    return TRUE;
  }
}
