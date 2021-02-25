<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function pagination($total,$perpage,$link=''){
		$this->load->library('pagination');
		$config['base_url'] = base_url() . $link;
		$config['total_rows'] = $total;
		$config['query_string_segment'] = 'page';
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = $perpage;
		$config['next_link'] = '<i class="material-icons" style="height:30px;line-height:30px">chevron_right</i>';
		$config['prev_link'] = '<i class="material-icons" style="height:30px;line-height:30px">chevron_left</i>';
		$config['num_links'] = 5;
		$config['attributes'] = array('class' => 'waves-effect pdes');
		$config['full_tag_open'] = '<ul class="pagination center-align">';
		$config['full_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
		return  $this->pagination->create_links();
	}
	// Some Custom Fucntion
	public function ChangeMeta($string, $title, $tags=''){
	$exp = explode(' ', $string);
	$new = '';
		foreach ($exp as $key => $value) {
		  if ($value == "{title}") {
			$new .= ' ' . $title;
			}elseif ($value == "{tags}") {
				$new .= ' ' . $tags;
			}else{
				$new .= ' '.$value;
		  }
		}
		return $new;
  }
	public function getCurrentUser(){
	  $this->load->helper('cookie');
		$this->load->model('checks');
		if (isset($_COOKIE[md5(base_url())])) {
			$hash = $_COOKIE[md5(base_url())];
			$user = $this->checks->Fetch('sigma',array('u_hash' => $hash),'UID');
			return $user->result();
		}else{
			return false;
		}
	}
	public function api(){
	  $this->load->model('checks');
	  if($_GET['action'] == 'python'){
	      $url = $_GET['url'];
	   	  $post = $this->checks->Fetch('posts',array('post_clink' => $url),'ID');
	   	  if($post->num_rows() > 0){
	   	      $res = base_url().$post->result()[0]->slug;
	   	      	echo json_encode(array('action' => 'alreadyPosted' , 'url' => $res));
	   	  }else{
	   	      	echo json_encode(array('action' => 'HaveSpace'));
	   	  }
            
	  }
	}
	public function isUser(){
		$this->load->helper('cookie');
	  if (isset($_COOKIE[md5(base_url())])) {
	  	return true;
	  }else{
			return false;
		}
	}
	public function isAdmin(){
		$this->load->helper('cookie');
	  if (isset($_COOKIE[md5(base_url())])) {
			$hash = $_COOKIE[md5(base_url())];
	  	$user = $this->checks->Fetch('sigma',array('u_hash' => $hash),'UID');
			if ($user->num_rows() > 0) {
				return $user->result()[0]->u_role;
			}else{
				return false;
			}
	  }else{
			return false;
		}
	}
	public function userAction($action = FALSE , $email){
		$this->load->helper('cookie');
	  if ($action) {
			$cookie= array(
					'name'   => md5(base_url()),
					'value'  => md5($email),
					'expire' => '86400',
					'path'   => '/',
			);
			$cc = set_cookie($cookie);
			return ($cc)?1:0;
	  }else{
			$dc = delete_cookie(md5(base_url()));
			return ($dc)?1:0;
		}
	}
	public function log_checking($email = '' , $password = ''){
		$this->load->model('checks');
	  if ($password == '') {
	  	$ret = $this->checks->Fetch('sigma',array('u_email' => $email),'UID');
			if ($ret->num_rows() > 0) {
				return $ret->result();
			}else{
				return FALSE;
			}
			exit();
	  }else{
			$ret = $this->checks->Fetch('sigma',array('u_email' => $email,'u_pass'=> $password),'UID');
			if ($ret->num_rows() > 0) {
				return $ret->result();
			}else{
				return FALSE;
			}
		}
	}
	public function adminlog(){
		$this->load->model('checks');
		$this->load->view('admin/login');
	}
	public function login(){
		if (isset($_GET['hash'])) {
			$token = $_GET['hash'];
			$data = json_decode(base64_decode($token), TRUE);
			$this->load->model('checks');
			$email = $data['email'];
			$password = $data['password'];
			if ($data['action'] == 'signup') {
				if ($this->log_checking($email) == FALSE) {
					$idata['u_email'] = $email;
					$idata['u_name'] = $data['uname'];
					$idata['u_pass'] = md5($data['password']);
					$idata['u_img'] = base_url('assets/avatar.jpg');
					$idata['u_ginfo'] = FALSE;
					$idata['u_hash'] = md5($email);
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$check = $this->checks->Upload($idata, 'sigma');
							if ($check) {
								$this->userAction(TRUE,$email);
								echo ($check == TRUE)?json_encode(array('action' => true)):json_encode(array('action' => false, 'msg' => 'something wrong try again'));
								exit();
							}
						}else {
							echo json_encode(array('action' => false,'msg' => 'email adress not valid'));
							exit();
						}
				}else {
					echo json_encode(array('action' => false,'msg' => 'Email Already Exists'));
					exit();
				}
			}elseif($data['action'] == 'login'){
				$log = $this->log_checking($email, md5($password));
				if ($log != FALSE) {
					$this->userAction(TRUE,$email);
					echo json_encode(array('action' => true));
					exit();
				}else {
					echo json_encode(array('action' => false,'msg' => 'email & password wrong'));
					exit();
				}
			}
		}
	}
	public function glogin(){
		if (isset($_GET['hash'])) {
			$token = $_GET['hash'];
			$data = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))), TRUE);
			$this->load->model('checks');
			$email = $data['email'];
			if ($this->log_checking($email) == FALSE) {
				$indata['u_email'] = $email;
				$indata['u_name'] = $data['given_name'];
				$indata['u_img'] = $data['picture'];
				$indata['u_hash'] = md5($email);
				$indata['u_ginfo'] = json_encode($data);
				$check = $this->checks->Upload($indata, 'sigma');
				echo ($check == TRUE)?json_encode(array('action' => true,'name' => $indata['u_name'], 'email' => $email , 'img' => $indata['u_img'])) : json_encode(array('action' => false,'msg' => 'something wrong try again'));
				if ($check) {
					$this->userAction(TRUE,$email);
				}				
			}else{
				$uinf = $this->log_checking($email);
				$info =$uinf[0];
				$this->userAction(TRUE,$info->u_email);
				echo json_encode(array('action' => true,'name' => $info->u_name, 'email' => $info->u_email, 'img' => $info->u_img));
			}
		}else{
			show_404();
		}
	}
	public function check_internet(){
		if ( @fopen("https://google.com", "r") ) {
		  return true;
		} else {
		  return false;
		} 
	}
	// End Some Custom Function
	public function index(){
		$this->load->model('checks');
		if (isset($_GET['page'])) {
			$segmet = $_GET['page'];
			$data['posts'] = $this->checks->Limited($segmet,20);
		}else{
			$data['posts'] = $this->checks->Limited('',20);
		}
		$data['pg'] = $this->checks->Fetch('posts','all','ID');
		$data['pagination'] = $this->pagination($data['pg']->num_rows(),20);
		$data['index'] = 'index';
		$data['title']	= 'Millions of Premium Graphics Download For Free  - PNGhill';  
		$data['keywords']	= 'free, illustrations, Wallpapers, graphics, png images, backgrounds, vector, clipart, psd, icons, free images, free download';  
		$data['description']	= 'pnghill provides Millions of  free download of ,Wallpapers, illustrations, png images, backgrounds and vector. Millions of high quality free png images, PSD, AI and EPS Files are available';  
		$this->load->view('front/header',$data);
		$this->load->view('front/homepage',$data);
		$this->load->view('front/footer');
	}
	// Downlaod page
	public function download(){
		$this->load->library('encryption');
		if (isset($_GET['go']) && isset($_GET['t'])) {
			$this->load->model('checks');
			$string = str_replace(' ', '+', $_GET['go']);
			$ID = explode('_', $_GET['t'])[1];
			$post = $this->checks->Fetch('posts',array('ID' => $ID),'ID');
			if ($post->num_rows() > 0 ) {
				$count = $post->result()[0]->downloads;
				$ct = $post->result()[0]->category;
				$data['downloads'] = $count + 1;
				$this->checks->Update('posts',$data,array('ID' => $ID));
			}
			$data['dlink'] = $this->encryption->decrypt($string);
			$data['Related'] = $this->checks->Fetch('posts','search',$ct);
			$data['post'] = $post;
			$data['index'] = 'noindex';
			$data['title']	= 'Millions of Premium Graphics Download For Free  - PNGhill';  
			$data['keywords']	= 'free, illustrations, Wallpapers, graphics, png images, backgrounds, vector, clipart, psd, icons, free images, free download';  
			$data['description']	= 'pnghill provides Millions of  free download of ,Wallpapers, illustrations, png images, backgrounds and vector. Millions of high quality free png images, PSD, AI and EPS Files are available';   
			$this->load->view('front/header',$data);
			$this->load->view('front/download',$data);
			$this->load->view('front/footer');
		}else{
			show_404();
		}
	}
	public function search(){
		$this->load->model('checks');
		if (!isset($_GET['q'])) {
			show_404();
		}
		$data['metaTitle'] = $_GET['q'] . ' - PNGhill';
		$query = $_GET['q'];
		if (isset($_GET['page'])) {
			$segmet = $_GET['page'];
			$data['posts'] = $this->checks->Limited($segmet,20,$query);
		}else{
			$data['posts'] = $this->checks->Limited('',20,$query);
		}
		$data['pg'] = $this->checks->Fetch('posts','search',$query, 20);
		$data['pagination'] = $this->pagination($data['pg']->num_rows(),10,'search?q='.$query);
		$data['index'] = 'index';
		$data['title']	= $query . " Images | Vector and PSD Files | Free Download from PNGhill";  
		$data['keywords']	= $query . ", png, illustrations, Backgrounds, Wallpapers, vectors, psd, png images";  
		$data['description']	= "Are you searching for ".$query." png images or vector? Choose from Millions of ".$query." graphic resources and download in the form of PNG, EPS, AI or PSD. - PNGhill";
		$this->load->view('front/header',$data);
		$this->load->view('front/search',$data);
		$this->load->view('front/footer');
	}
	function createThumbnail($path,$ext,$size,$up=FALSE,$x24=''){
		if ($up == TRUE) {
			$newp = './uploads/x24/';
			$newpath = './uploads/x24/' . pathinfo($path)['filename'] . '_thumb.' . pathinfo($path)['extension'];
			if ($size > 320) {
				$config['width']   = 320;
			}else{
				$config['width']   = $size;
			}
			$config['height']   = 'auto';
		  $config['image_library'] = 'gd2';
		  $config['source_image'] = $path;
		  $config['create_thumb'] = TRUE;
			$config['new_image'] = './uploads/x24/';
		  $config['quality'] = '80%';
		  $config['master_dim'] = 'auto';
		  $this->load->library('image_lib', $config);
		  if ( ! $this->image_lib->resize()){
		          return $this->image_lib->display_errors();
		  }else{
				$rp = $newp.pathinfo($x24)['basename'];
				rename($newpath, $rp);
				return $rp;
		  }
			exit();	
		}else{
			$newp = './uploads/x24/';
		  $this->load->helper('string');
		  $hash = random_string('alnum', 30);
			$newpath = './uploads/x24/' . pathinfo($path)['filename'] . '_thumb.' . pathinfo($path)['extension'];
			if ($size > 320) {
				$config['width']   = 320;
			}else{
				$config['width']   = $size;
			}
			$config['height']   = 'auto';
		  $config['image_library'] = 'gd2';
		  $config['source_image'] = $path;
		  $config['create_thumb'] = TRUE;
			$config['new_image'] = './uploads/x24/';
		  $config['quality'] = '80%';
		  $config['master_dim'] = 'auto';
		  $this->load->library('image_lib', $config);
		  if ( ! $this->image_lib->resize()){
		          return $this->image_lib->display_errors();
		  }else{
				$rp = $newp.$hash.'.'.$ext;
				rename($newpath, $rp);
				return $rp;
		  }
			exit();	
		}
	}
	public function textWatermark($source_image)
	{
	$this->load->library('image_lib');
	$config['source_image'] = $source_image; //The path of the image to be watermarked
	$config['wm_text'] = 'www.pnghill.com';
	$config['wm_type'] = 'text';
	$config['create_thumb'] = FALSE;
	$config['wm_font_path'] = getcwd() . '/assets/font.ttf';
	$config['wm_font_size'] = 14;
	$config['wm_shadow_color'] = '000000';
	$config['wm_font_color'] = 'ffffff';
	$config['wm_padding'] = '0';
	$this->image_lib->initialize($config);
	if (!$this->image_lib->watermark()) {
		echo $this->image_lib->display_errors();
	}else{
		echo $this->image_lib->display_errors();;
		// return TRUE;
	}
	}
	public function ImageWatermark($sources){
	  if ($this->load->library('image_lib')) {
			$config['image_library'] = 'gd2';
			$config['wm_type'] = 'overlay';
			$config['wm_overlay_path'] = './assets/watermark3.png';//the overlay image
			$config['source_image'] = $sources;
			$config['wm_x_transp'] = 4;
			$config['wm_y_transp'] = 4;
			$config['width'] = 50;
			$config['height'] = 50;
			$config['padding'] = 50;
			$config['create_thumb'] = FALSE;
			$config['wm_opacity'] = 100;
			$config['wm_vrt_alignment'] = 'bottom';
			$config['wm_hor_alignment'] = 'center';
		 $this->image_lib->initialize($config);
		 if (!$this->image_lib->watermark()) {
			 echo $this->image_lib->display_errors();
		 }else{
			 return TRUE;
		 }
	  }
	}
	public function viewpost(){
		$this->load->model('checks');
		$this->load->helper('number');
		$this->load->library('encryption');
		$slug = $this->uri->segment(2);
		$data['post'] = $this->checks->Fetch('posts',array('slug' => $slug),'ID');
		$data['recent'] = $this->checks->Fetch('posts','recents','ID');
		if ($data['post']->num_rows() > 0) {
			$cat = $data['post']->result()[0]->category;
			$png = $data['post']->result()[0]->dlink_image;
			$zip = $data['post']->result()[0]->dlink_zip;
			$ID = $data['post']->result()[0]->ID;
			$title	= $data['post']->result()[0]->mTitle;  
			$tags	= $data['post']->result()[0]->mTags;;  
			$desc	= $data['post']->result()[0]->mDesc;
			$data['pngcode'] = $this->encryption->encrypt($png);
			$data['zipcode'] = $this->encryption->encrypt($zip);
			$views['views'] = $data['post']->result()[0]->views + 1;
			$this->checks->Update('posts',$views,array('ID'=> $ID));
			$data['Related'] = $this->checks->Fetch('posts','search',$cat);
			$data['cats'] = $cat;
		}else{
			show_404();
		}
		$data['isEditable'] = TRUE;
		$data['index'] = 'index';
		$data['title']	= $title;  
		$data['keywords']	= $tags;  
		$data['description']	= $desc;
		$this->load->view('front/header',$data);
		$this->load->view('front/viewpost',$data);
		$this->load->view('front/footer',$data);
	}
	public function install(){
	  $this->load->view('install');
	}
	public function admin(){
		$this->load->view("admin/header");
	  $this->load->view('admin/index');
		$this->load->view('admin/footer');
	}
	public function allposts(){
		$this->load->view("admin/header");
	  $this->load->view('admin/allposts');
		$this->load->view('admin/footer');
	}
	public function uploadZip(){
    $config['upload_path'] = './uploads/xcon/';
    $config['allowed_types'] = 'zip';
		$config['overwrite'] = FALSE;
		$config['encrypt_name'] = TRUE;
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
	    if ($this->upload->do_upload('img')) {
				$data= $this->upload->data();
				$img['d_link'] = 'uploads/xcon/'.$data['file_name'];
				$img['d_date'] = date('Y-m-d');
				$img['orig_name'] = $data['orig_name'];
				$img['d_data'] = json_encode( $data , JSON_PRETTY_PRINT );
				$this->load->model('checks');
				if ($this->checks->Upload($img,'zip_urls') == true) {
					echo json_encode(array('action' => true,'path' => $img['d_link']));
					exit();
				}
			}else{
				echo json_encode(array('action' => false,'msg' => 'file not uploaded try again'));exit();
			}
	}
	public function changezip(){
		$zip = $_GET['zip'];
		$ID = $_GET['id'];
		$Pinfo = pathinfo($zip);
		$config['upload_path'] = './uploads/xcon/';
    $config['allowed_types'] = 'zip';
		$new = FALSE;
		if ($zip !='') {
			$config['file_name'] = $Pinfo['basename'];
		}else{
			$config['encrypt_name'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$new = TRUE;
		}
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
	    if ($this->upload->do_upload('filename')) {
				$data= $this->upload->data();
				$img['d_link'] = 'uploads/xcon/'.$data['file_name'];
				$img['d_date'] = date('Y-m-d');
				$img['orig_name'] = $data['orig_name'];
				$img['d_data'] = json_encode( $data , JSON_PRETTY_PRINT );
				$post['dlink_zip'] = $img['d_link'];
				$this->load->model('checks');
				if ($new) {
					if ($this->checks->Upload($img,'zip_urls') == true && $this->checks->Update('posts',$post,array('ID'=> $ID)) == true) {
						echo json_encode(array('action' => true,'path' => $img['d_link']));
						exit();
					}
				}else{
					if ($this->checks->Update('zip_urls',$img,array('d_link'=> $zip)) == true) {
						echo json_encode(array('action' => true,'path' => $img['d_link']));
						exit();
					}
				}
			}else{
				echo json_encode(array('msg' => 'file not uploaded try again'));exit();
			}
	}
	// All Admin Views
	public function adminViews(){
	  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url = explode('admin-panel',$actual_link)[1];
		$this->load->model('checks');
		switch ($url) {
			case '/posts':
					$data['posts'] = $this->checks->Fetch('posts','allwa','ID');
					$this->load->view("anew/header");
				  $this->load->view('anew/posts',$data);
					$this->load->view('anew/footer');
				break;
			case '/add/post':
					$data['cats'] = $this->checks->Fetch('categories','all','CID');
					$this->load->view("anew/header");
					$this->load->view('anew/addpost',$data);
					$this->load->view('anew/footer');
				break;
			case '/quickpost':
					$data['cats'] = $this->checks->Fetch('categories','all','CID');
					$this->load->view("anew/header");
					$this->load->view('anew/pngtree',$data);
					$this->load->view('anew/footer');
				break;
				case '/users':
						$data['users'] = $this->checks->Fetch('sigma','all','UID');
						$this->load->view("anew/header");
						$this->load->view('anew/users', $data);
						$this->load->view('anew/footer');
					break;
			default:
					$this->load->view("anew/header");
				  $this->load->view('anew/index');
					$this->load->view('anew/footer');
				break;
		}
	}
	public function categories(){
		$this->load->model('checks');
		$data['cats'] = $this->checks->Fetch('categories','all','CID');
		if (isset($_GET['edit'])) {
			$id = $_GET['edit'];
			$data['category'] = $this->checks->Fetch('categories',array('CID' => $id),'CID');
			$data['edit'] = TRUE;
		}else {
			$data['edit'] = FALSE;
		}
		$this->load->view("anew/header");
		$this->load->view('anew/categories', $data);
		$this->load->view('anew/footer');
	}
	public function ecat(){
		$id = $_POST['id'];
		$this->load->model('checks');
		if ($_POST['cname'] != '') {
			$slug = strtolower($_POST['cslug']);
			$replaced = str_replace(' ', '-', $slug);
			$data['cslug'] = $replaced;
			$data['cname'] = $_POST['cname'];
			$data['desce']  = $_POST['desc'];
			$data['m_title']  = $_POST['ctitle'];
			if ($this->checks->Update('categories',$data,array('CID' => $id))) {
				redirect(base_url('admin-panel/add/category?msg=success'));
			}
		}else{
				redirect(base_url('admin-panel/add/category?msg=error'));
		}
		$this->load->view("anew/header");
		$this->load->view('anew/categories', $data);
		$this->load->view('anew/footer');
	}
	// Publish Data
	public function publish(){
	  $action = $_POST['action'];
		switch ($action) {
			case 'post':
				if($_POST['title'] == ''){
						echo json_encode(array('action' => false,'msg' => 'title not be empty'));exit();
				}
				if (!empty($this->getCurrentUser())) {
					$post['post_author'] = $this->getCurrentUser()[0]->UID;
				}else{
					echo json_encode(array('action' => false,'msg' => "Your'e Logged out "));exit();
				}
				if (isset($_FILES['file'])) {
					date_default_timezone_set('Asia/Karachi');
					$date = date('Y').'/'.date('m');
					if (!is_dir('uploads/fxcon')) {
						mkdir('./uploads/fxcon/', 0777, TRUE);
					}
			    $config['upload_path'] = './uploads/fxcon/';
			    $config['allowed_types'] = 'png|jpg|jpeg';
					$config['overwrite'] = FALSE;
					$config['encrypt_name'] = FALSE;
					$config['remove_spaces'] = TRUE;
					$this->load->library('upload', $config);
				    if ($this->upload->do_upload('file')) {
							$this->load->helper('string');
							$data= $this->upload->data();
							$slug = strtolower($_POST['title']);
							$replaced = str_replace(' ', '_', $slug) .'_'.  rand(1111,999999) . '.html';
							$post['dlink_image'] = 'uploads/fxcon/'.$data['file_name'];
							$post['title'] = $_POST['title'];
							$post['slug'] = $replaced;
							$post['date'] = date('d-M-Y');
							$post['category'] = $_POST['cats'];
							$post['tags'] = $_POST['tags'];
							$post['workWith'] = $_POST['workWith'];
							$post['dlink_zip'] = $_POST['ziplink'];
							$post['mTitle'] = $this->ChangeMeta($_POST['mTitle'],$_POST['title']);
							$post['mTags'] = $this->ChangeMeta($_POST['mTags'],$_POST['title'],$_POST['tags']);
							$post['mDesc'] = $this->ChangeMeta($_POST['mDesc'],$_POST['title']);
							$post['image_size'] = $_FILES['file']['size'];
							$post['image_alt'] = $_POST['title'];
							$post['image_title'] = 'Image of pnghill.com';
							$post['workWith'] = $_POST['workWith'];
							$post['fdata'] = json_encode( $data );
							$ext = pathinfo($post['dlink_image'])['extension'];
							$post['image_path'] = $this->createThumbnail($post['dlink_image'],$ext, $data['image_width']);
							$this->textWatermark($post['image_path']);
							$returnedData = base_url('freepng/' . $replaced);
							$this->load->model('checks');
							if ($this->checks->Upload($post,'posts') == true) {
								echo json_encode(array('action' => true,'link' => $returnedData));
								exit();
							}
						}else{
							echo json_encode(array('action' => false,'msg' => strip_tags($this->upload->display_errors())));exit();
						}
				}else{
					echo json_encode(array('action' => false,'msg' => 'Featured image is empty'));exit();
				}
				break;
			case 'category':
				if ($_POST['cname'] != '') {
					$slug = strtolower($_POST['cslug']);
					$replaced = str_replace(' ', '-', $slug);
					$this->load->model('checks');
					if ($this->checks->Fetch('categories',array('cslug' => $replaced),'CID')->num_rows() > 0) {
						redirect(base_url('admin-panel/add/category?msg=change slug link'));
					}
					$this->load->model('checks');
					$data['cslug'] = $replaced;
					$data['cname'] = $_POST['cname'];
					$data['desce']  = $_POST['desc'];
					$data['m_title']  = $_POST['ctitle'];
					if ($this->checks->Upload($data,'categories')) {
						redirect(base_url('admin-panel/add/category'));
					}
				}else{
						redirect(base_url('admin-panel/add/category'));
				}
				break;
		}
	}

	public function Edit(){
	  $action = $_GET['action'];
		switch ($action) {
				case 'category':
					if($_GET['task'] == 'delete'){
						$this->load->model('checks');
						$ID = $_GET['id'];
						if ($this->checks->Delete('categories',array('CID'=>$ID))) {
							redirect(base_url('admin-panel/add/category'));
						}
					}
				break;
				case 'post':
					if ($_GET['task']=='delete') {
						$key = $_POST['id'];
						$this->load->model('checks');
						if ($post = $this->checks->Fetch('posts',array('ID' => $key),'')) {
							if ($post->result()[0]->image_path != '') {
								unlink($post->result()[0]->image_path);
							}
							if ($post->result()[0]->dlink_zip != '') {
								unlink($post->result()[0]->dlink_zip);
							}
							if ($post->result()[0]->dlink_image != '') {
								unlink($post->result()[0]->dlink_image);
							}
							if ($this->checks->Delete('posts',array('ID' => $key))) {
								echo json_encode(array('action' => true,'msg' => 'Post Deleted'));exit();
							}else{
								echo json_encode(array('action' => false,'msg' => 'record not delete'));exit();
							}
						}
					}elseif($_GET['task']=='edit'){
						$this->load->model('checks');
						$ID = $_GET['id'];
						$data['cats'] = $this->checks->Fetch('categories','all','CID');
						$data['post'] = $this->checks->Fetch('posts',array('ID'=> $ID),'ID');
						$this->load->view("anew/header");
						$this->load->view('anew/editpost', $data);
						$this->load->view('anew/footer');
					}elseif($_GET['task']=='update'){
						$this->load->model('checks');
						$ID = $_POST['id'];
						$post['title'] = $_POST['title'];
						$cats = (isset($_POST['cats']))?$_POST['cats']:'';
						if ($cats != '') {
							$post['category'] = implode(',',$cats);
						}
						if (!empty($_POST['ziplink'])) {
							$zpath = pathinfo($_POST['ziplink'])['dirname'];
							if ($zpath == 'uploads/xcon') {
									$post['zip_status'] = 'pnghill';
							}else{
									$post['zip_status'] = 'gdrive';
							}
						}
						$post['tags'] = $_POST['hash'];
						$post['workWith'] = ($_POST['workWith']=='')?'':implode(',',$_POST['workWith']);
						$post['mTitle'] = $_POST['mTitle'];
						$post['mTags'] = $_POST['mTags'];
						$post['mDesc'] = $_POST['mDesc'];
						$post['dlink_zip'] = $_POST['ziplink'];
						$flug = $this->checks->Fetch('posts',array('ID'=> $ID),'ID');
						$returnedData = base_url('freepng/'.$flug->result()[0]->slug);
						if ($this->checks->Update('posts',$post,array('ID'=> $ID)) == true) {
							echo json_encode(array('action' => true,'link' => $returnedData));
							exit();
						}else{
							echo json_encode(array('action' => false,'msg' => 'post not updated try again'));
							exit();
						}
					}
					break;
		}
	}
	public function editfe(){
		$ID = $_POST['id'];
		$x24 = $_POST['x24'];
		$orginal = $_POST['orginal'];
		$Pinfo = pathinfo($orginal);
		$config['upload_path'] = $Pinfo['dirname'];
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['file_name'] = $Pinfo['basename'];
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);
			if ($this->upload->do_upload('file')) {
				$data= $this->upload->data();
				$dee['fdata'] = json_encode( $data );
				$dee['image_size'] = $_FILES['file']['size'];
				$thumb = $this->createThumbnail($orginal,$Pinfo['extension'], $data['image_width'],TRUE,$x24);
				$this->textWatermark($thumb);
				$this->load->model('checks');
				if ($this->checks->Update('posts',$dee,array('ID'=> $ID)) == true) {
					echo json_encode(array('action' => true));
					exit();
				}
			}else{
				echo json_encode(array('action' => false,'msg' => strip_tags($this->upload->display_errors())));exit();
			}
	}
	// View category
	public function category(){
	  	$slug = $this->uri->segment(2);
			$this->load->model('checks');
			$ct = $this->checks->Fetch('categories',array('cslug'=> $slug),'CID');
			if ($ct->num_rows() > 0) {
				$CID = $ct->result()[0]->CID;
				if (isset($_GET['page'])) {
					$segmet = $_GET['page'];
					$data['posts'] = $this->checks->cats($segmet,20,$CID);
				}else{
					$data['posts'] = $this->checks->cats('',20,$CID);
				}
				$data['pg'] = $this->checks->allcats($CID);
				$data['pagination'] = $this->pagination($data['pg']->num_rows(),20,'search?q='.$slug);
				$data['index'] = 'index';
				$data['title']	= $ct->result()[0]->cname . " Images | Vector and PSD Files | Free Download from PNGhill";  
				$data['keywords']	= $ct->result()[0]->cname . ", png, illustrations, Backgrounds, Wallpapers, vectors, psd, png images";  
				$data['description']	= "Are you looking for ".$ct->result()[0]->cname." png images or vector? Choose from Millions of ".$ct->result()[0]->cname." graphic resources and download in the form of PNG, EPS, AI or PSD. - PNGhill";
				$this->load->view('front/header',$data);
				$this->load->view('front/category',$data);
				$this->load->view('front/footer');
			}
	}
	// View Pages 
	public function about(){
		$data['index'] = 'index';
		$data['title']	= 'About us - PNGhill';  
		$data['keywords']	= 'free, illustrations, Wallpapers, graphics, png images, backgrounds, vector, clipart, psd, icons, free images, free download';  
		$data['description']	= 'pnghill provides Millions of  free download of ,Wallpapers, illustrations, png images, backgrounds and vector. Millions of high quality free png images, PSD, AI and EPS Files are available';  
		$this->load->view('front/header',$data);
		$this->load->view('front/about');
		$this->load->view('front/footer');
	}
	public function pp(){
		$data['index'] = 'index';
		$data['title']	= 'Privacy Policy - PNGhill';  
		$data['keywords']	= 'free, illustrations, Wallpapers, graphics, png images, backgrounds, vector, clipart, psd, icons, free images, free download';  
		$data['description']	= 'pnghill provides Millions of  free download of ,Wallpapers, illustrations, png images, backgrounds and vector. Millions of high quality free png images, PSD, AI and EPS Files are available';  
		$this->load->view('front/header',$data);
		$this->load->view('front/pp');
		$this->load->view('front/footer');
	}
	public function contact(){
		$this->load->view('front/header');
		$this->load->view('front/contact');
		$this->load->view('front/footer');
	}
	public function dmca(){
		$this->load->view('front/header');
		$this->load->view('front/dmca');
		$this->load->view('front/footer');
	}
	// Quick Posts
	public function qp(){
		$this->load->model('checks');
	  $url = $_GET['link'];
		if ($url == '') {
			echo json_encode(array('action' => false,'msg' => "url required"));exit();
		}
		$da=$this->checks->Fetch('posts',array('post_clink'=> $url),'');
		if ($this->check_internet() ) {
			if ($da->num_rows() > 0) {
				echo json_encode(array('action' => false,'msg' => 'Already Posted'));exit();
			}else{
				$data = file_get_contents('https://fectodigital.com/scrapper?id='.$url);
				echo $data;
			}
		}else{
			echo json_encode(array('action' => false,'msg' => "Your'e Not Connected to internet"));exit();
		}
	}
	// Savefromurl
	public function save_image($inPath,$outPath){
		$in=    fopen($inPath, "rb");
		$out=   fopen($outPath, "wb");
		while ($chunk = fread($in,8192)){
				fwrite($out, $chunk, 8192);
		}
		fclose($in);
		fclose($out);
	}
	public function save_image2($inPath,$outPath){
	    if(@file_get_contents($inPath)){
	        $file = file_get_contents($inPath);
	        file_put_contents($outPath,$file);
             return true;
        }else{
            return false;
        }
      
	}
	// Publish quickPost
	public function qpublish(){
		if($_POST['title'] == ''){
				echo json_encode(array('action' => false,'msg' => 'title not be empty'));exit();
		} if ($_POST['featuredImage'] == '') {
			echo json_encode(array('action' => false,'msg' => 'featured cannpt be empty'));exit();
		}
        if (!empty($this->getCurrentUser())) {
		    $post['post_author'] = $this->getCurrentUser()[0]->UID;
		}else{
			echo json_encode(array('action' => false,'msg' => "Your'e Logged out "));exit();
		}
		$slug = strtolower($_POST['title']);
		$replaced = str_replace(' ', '_', $slug) .'_'.  rand(1111,999999) . '.html';
		$image = str_replace(' ', '_', $slug).'_'.  rand(1111,999999).'.'.pathinfo($_POST['featuredImage'])['extension'];
		$img = $this->save_image($_POST['featuredImage'],'uploads/fxcon/'.$image);
		list($width, $height, $type, $attr) = getimagesize('uploads/fxcon/'.$image);
		$pathinfo = pathinfo('uploads/fxcon/'.$image); 
		$post['dlink_image'] = 'uploads/fxcon/' . $image;
		$post['title'] = $_POST['title'];
		$post['slug'] = $replaced;
		$post['date'] = date('d-M-Y');
		$post['category'] = ($_POST['cats']=='')?'':implode(',',$_POST['cats']);
		$post['tags'] = $_POST['tags'];
		$post['workWith'] = $_POST['workWith'];
		$post['dlink_zip'] = $_POST['ziplink'];
		$post['mTitle'] = $this->ChangeMeta($_POST['mTitle'],$_POST['title']);
		$post['mTags'] = $this->ChangeMeta($_POST['mTags'],$_POST['title'],$_POST['tags']);
		$post['mDesc'] = $this->ChangeMeta($_POST['mDesc'],$_POST['title']);
		$post['image_size'] = filesize($post['dlink_image']);
		$post['image_alt'] = $_POST['title'];
		$post['image_title'] = 'Image of pnghill.com';
		$post['post_clink'] = $_POST['post_clink'];
		$post['workWith'] = ($_POST['workWith']=='')?'':implode(',',$_POST['workWith']);
		$data = array (
		  'file_name' => $image,
		  'file_type' => getimagesize('uploads/fxcon/'.$image)['mime'],
		  'file_path' => $pathinfo['dirname'],
		  'full_path' => $pathinfo['dirname'] .'/'. $pathinfo['basename'],
		  'file_ext' => $pathinfo['extension'],
		  'file_size' => filesize($post['dlink_image']),
		  'is_image' => true,
		  'image_width' => $width,
		  'image_height' => $height,
		  'image_type' => $pathinfo['extension'],
		  'image_size_str' => $width.'x'.$height,
		);
		$post['fdata'] = json_encode( $data );
		$ext = pathinfo($_POST['featuredImage'])['extension'];
		$post['image_path'] = $this->createThumbnail($post['dlink_image'],$ext, $width);
		$this->textWatermark($post['image_path']);
		$returnedData = base_url('freepng/' . $replaced);
		$this->load->model('checks');
		if ($this->checks->Upload($post,'posts') == true) {
			echo json_encode(array('action' => true,'link' => $returnedData));
			exit();
		}
	}
    public function pythonpost(){
		$slug = strtolower($_POST['title']);
		$replaced = str_replace(' ', '_', $slug) .'_'.  rand(1111,999999) . '.html';
		$image = str_replace(' ', '_', $slug).'_'.  rand(1111,999999).'.'.pathinfo($_POST['featuredImage'])['extension'];
		$img = $this->save_image2($_POST['featuredImage'],'uploads/fxcon/'.$image);
	    if($img == false){
		    echo json_encode(array('action' => false,'msg' => 'image not uploaded'));exit();
		}
		list($width, $height, $type, $attr) = getimagesize('uploads/fxcon/'.$image);
		$pathinfo = pathinfo('uploads/fxcon/'.$image); 
		$post['dlink_image'] = 'uploads/fxcon/' . $image;
		$post['title'] = $_POST['title'];
		$post['slug'] = $replaced;
		$post['date'] = date('d-M-Y');
		$post['category'] = ($_POST['cats']=='')?'':implode(',',$_POST['cats']);
		$post['tags'] = $_POST['tags'];
		$post['workWith'] = $_POST['workWith'];
		$post['post_author'] = 1;
		$post['dlink_zip'] = $_POST['ziplink'];
		$post['mTitle'] = $this->ChangeMeta($_POST['mTitle'],$_POST['title']);
		$post['mTags'] = $this->ChangeMeta($_POST['mTags'],$_POST['title'],$_POST['tags']);
		$post['mDesc'] = $this->ChangeMeta($_POST['mDesc'],$_POST['title']);
		$post['image_size'] = filesize($post['dlink_image']);
		$post['image_alt'] = $_POST['title'];
		$post['image_title'] = 'Image of pnghill.com';
		$post['post_clink'] = $_POST['post_clink'];
		$post['workWith'] = '';
		$data = array (
		  'file_name' => $image,
		  'file_type' => getimagesize('uploads/fxcon/'.$image)['mime'],
		  'file_path' => $pathinfo['dirname'],
		  'full_path' => $pathinfo['dirname'] .'/'. $pathinfo['basename'],
		  'file_ext' => $pathinfo['extension'],
		  'file_size' => filesize($post['dlink_image']),
		  'is_image' => true,
		  'image_width' => $width,
		  'image_height' => $height,
		  'image_type' => $pathinfo['extension'],
		  'image_size_str' => $width.'x'.$height,
		);
		$post['fdata'] = json_encode( $data );
		$ext = pathinfo($_POST['featuredImage'])['extension'];
		$post['image_path'] = $this->createThumbnail($post['dlink_image'],$ext, $width);
		$this->textWatermark($post['image_path']);
		$returnedData = base_url('freepng/' . $replaced);
		$this->load->model('checks');
		if ($this->checks->Upload($post,'posts') == true) {
			echo json_encode(array('action' => true,'link' => $returnedData));
			exit();
		}
	}
}




















