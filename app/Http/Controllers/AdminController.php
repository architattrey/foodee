<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\models\User;
use App\models\Appusers;
use DateTime;
use HTML,Form,Auth,Validator,Mail,Response,Session,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,Input,URL;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index','categoryActions','subCategoryActions','getProdects','promoCode','appUsers','deliveries','days']);
    }
    public function index()
    {
        //return view('home');
        $data = [];
        return view('admin.dashboard',$data);   
    }
    #login admin
    public function login(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'email'              => 'required|Email',
                'password'           => 'required',
            ]);
            if($validator->fails()) {
                Session::flash('flash_message', $validator->messages());    
                return back();
            }
            $userdata = array(
                'email'     =>  $request['email'],
                'password'  =>  $request['password'],
            );
            //check in auth for login
            $user = User::where('email',$request->email)->first();
           
            if(Auth::attempt($userdata)){
               
                $user_role = User::where('email',$request['email'])->value('role');
                if($user_role == "1"){
                    $admin = User::where('email',$request['email'])->first();
                    // $request->session()->put('data', $admin);
                    return redirect('/dashboard');
                }else{
                    Session::flash('flash_message','User is not exist.');
                    return back();
                }
            }else{
                Session::flash('flash_message','User is not exist.');    
                return back();
            }    
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        } 
    }
    public function categoryActions(Request $request){
        return view('admin.categories_actions');
    }
    public function subCategoryActions(Request $request){
        return view('admin.sub_categories_actions');
    }
    public function getProdects(Request $request){
        return view('admin.products');
    }
    public function promoCode(Request $request){
        return view('admin.promocodes');
    } 
    public function appUsers(Request $request){
        return view('admin.app_users');
    } 
    public function deliveries(Request $request){
        return view('admin.deliveries');
    }
    public function days(Request $request){
        return view('admin.days');
    }
    public function plans(Request $request){
        return view('admin.plans');
    }
}