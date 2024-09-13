<?php

namespace App\Controllers;
use App\Models\UserModel as UserModel;
	helper(['cookie']);
class a extends BaseController
{

	protected $modelVar;
    public function index($message="")
    {
    	$key = get_cookie('key');
		$siteConfig = config('siteConfig');
		if(!isset($key))return redirect()->to('a/login');
    	$data['siteConfig'] = $siteConfig;
    	$data['currentUrl'] = uri_string();
    	$data['key'] = $key;
    	$data['message'] = $message;
    	$this->modelVar = new UserModel();
	  	$data['currentUser'] = $this->modelVar
  			->where('password', $key)->first();
    	if($data['currentUrl']=='a/user'){
		  	$data['userData'] = $this->modelVar->find();
    	}
	   	return view('admin_landing',$data);
    }
    public function login($message="")
    {
    	$key = get_cookie('key');
		$siteConfig = config('siteConfig');
		if(isset($key))return redirect()->to('a/');
		$data['siteConfig'] = $siteConfig;
    	$data['message'] = $message;
	   	return view('admin_login',$data);
    }
    public function logout()
    {
    	
    	delete_cookie('key');
    	return redirect()->to('a/login')->withCookies();
	   	
    }
   	public function submit()
    {
		$siteConfig = config('siteConfig');
    	$data['siteConfig'] = $siteConfig;
    	$data['userName'] = $this->request->getPost("userName");
    	$data['password'] = $this->request->getPost("password");
    	$data['password'] = hash('sha256', $data['password']);
	  	$this->modelVar = new UserModel();
	  	$data['userData'] = $this->modelVar
	  		->where('name', $data['userName'])
	  		->where('password', $data['password'])->first();
  		if(!$data['userData'] )return $this->login("User Name/ Password Salah");
        $cookie = array(
		    'name'   => 'key',
		    'value'  => $data['password'],                            
		    'expire' => '0',  
                                                                             
	    );
	   	set_cookie($cookie);
    	return redirect()->to('a/')->withCookies();
    }

    public function createUser($message="")
    {
    	$key = get_cookie('key');
		$siteConfig = config('siteConfig');
		if(!isset($key))return redirect()->to('a/');
		$data['siteConfig'] = $siteConfig;
    	$data['message'] = $message;
	   	return view('user_form',$data);
    }
    public function deleteUser($id=NULL)
    {
    	$key = get_cookie('key');
		$siteConfig = config('siteConfig');
		if(!isset($key))return redirect()->to('a/');
		$this->modelVar = new UserModel();
		$data['id'] = $id;
		$data['size'] = sizeOf($this->modelVar->find());
    	
    	if($data['size']<=3){
    		//$session = service('session');
    		//$session->setFlashdata('item', 'value');
    		$_SESSION['error'] = 'Sorry, you must login first';
			$session = session();
			$session->markAsFlashdata('error');
    		return redirect()->to('a/user')->withCookies();
	  	}else if($this->modelVar->delete($data)){
	   		return redirect()->to('a/user')->withCookies();
	  	};
    }
    public function createSubmit($message="")
    {
		$siteConfig = config('siteConfig');
    	$data['siteConfig'] = $siteConfig;
    	$data['userName'] = $this->request->getPost("userName");
    	$data['password'] = $this->request->getPost("password");
    	$data['password_confirm'] = $this->request->getPost("password_confirm");
    	if ($data['password']!=$data['password_confirm']) {
    		return $this->createUser("Konfirmasi Password Salah");
    	}
    	$this->modelVar = new UserModel();
	  	$data['userData'] = $this->modelVar
	  		->where('name', $data['userName'])->first();
  		if($data['userData'] )return $this->createUser("User Name Sudah Dipakai");
    	$data['password'] = hash('sha256', $data['password']);
		$data = [
			'name'	=> $data['userName'],
			'password'	=> $data['password'],
		];
		if($this->modelVar->insert($data)){
			return redirect()->to('a/user')->withCookies();
		}
		return $this->createUser("Database Error");
    }
}
