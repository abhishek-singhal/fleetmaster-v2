<?php

namespace App\Http\Controllers;

use Invisnik\LaravelSteamAuth\SteamAuth;
use App\User;
use Auth;

class AuthController extends Controller
{
    /**
     * The SteamAuth instance.
     *
     * @var SteamAuth
     */
    protected $steam;

    /**
     * The redirect URL.
     *
     * @var string
     */
    protected $redirectURL = '/';

    /**
     * AuthController constructor.
     * 
     * @param SteamAuth $steam
     */
    public function __construct(SteamAuth $steam)
    {
    	$this->steam = $steam;
    }

    /**
     * Redirect the user to the authentication page
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToSteam()
    {
    	return $this->steam->redirect();
    }

    /**
     * Get user info and log in
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle()
    {
    	if ($this->steam->validate()) {
    		$info = $this->steam->getUserInfo();

    		if (!is_null($info)) {
    			list($user, $tmp) = $this->findOrNewUser($info);

    			if($tmp && $user->rank >= 3){
    				Auth::login($user, true);
                    return redirect('/dashboard');
    			}else if(!$tmp){
    				$message = "tmp";
    			}else{
    				$message = "rank";
    			}
                return redirect($this->redirectURL)->with('message',$message); // redirect to site
            }
        }
        return $this->redirectToSteam();
    }

    /**
     * Getting user by info or created if not exists
     *
     * @param $info
     * @return User
     */
    protected function findOrNewUser($info)
    {
    	$user = User::where('steam_id', $info->steamID64)->first();

    	$tmp_data = $this->fetchTMP($info);

    	$country = $this->findCountry();
    	
    	if (!is_null($user)) {
    		User::where('steam_id', $info->steamID64)->update([
    			'steam_name' => $info->personaname,
    			'avatar' => $info->avatarfull,
    			//'steam_id' => $info->steamID64,
    			//'tmp_id' => $tmp->response->id,
    			'tmp_name' => $tmp_data->response->name,
    			//'tmp_date' => $tmp->response->joinDate,
    			'tmp_iga' => $tmp_data->response->permissions->isGameAdmin,
    			'country' => $country
    		]);
    		$user = User::where('steam_id', $info->steamID64)->first();
    		return array($user,true);
    	}
    	//check if TMP account exists
    	if(!$tmp->error){
    		User::create([
    			'steam_name' => $info->personaname,
    			'avatar' => $info->avatarfull,
    			'steam_id' => $info->steamID64,
    			'tmp_id' => $tmp_data->response->id,
    			'tmp_name' => $tmp_data->response->name,
    			'tmp_date' => $tmp_data->response->joinDate,
    			'tmp_iga' => $tmp_data->response->permissions->isGameAdmin,
    			'country' => $country
    		]);

    		$user = User::where('steam_id', $info->steamID64);
    		return array($user,true);
    	}else{
    		return array(NULL,false);
    	}
    }
    protected function findCountry(){
    	$url = "https://ipinfo.io/"."103.85.119.13"."/json"; // put ip address here $request()->ip()
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$response = curl_exec($ch);
    	curl_close($ch);
    	$data = json_decode($response);
    	return $data->country;
    }

    protected function fetchTMP($info){
    	$url = "https://api.truckersmp.com/v2/player/".$info->steamID64;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$response = curl_exec($ch);
    	curl_close($ch);
    	$data = json_decode($response);
    	return $data;
    }
}