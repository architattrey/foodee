<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\User;
use App\models\Cart;
use App\models\Cities;
use App\models\States;
use App\models\Products;
use App\models\Appusers;
use App\models\Category;
use App\models\Wallet;
use App\models\Plan;
use App\models\PromoCodes;
use App\models\SubCategory;
use App\models\ReferalCode;
use App\models\UsersFeedbacks;
use App\models\UserTransactions;
use App\models\UsersDeliveryAddress;
use DB;

class ApiController extends Controller
{
    #user login or register
    public function login(Request $request){
        try{
            $appUsers = new Appusers();
            #login with email
            if(!empty($request->email_id)){
                #get data of user if email will match
                $response['appusers'] = $userStatus = Appusers::where('email_id',$request->email_id)->first();
                
                // if($userStatus->delete_status =='0'){
                //     #send response
                //     return response()->json([
                //         'message'=>'You are disabled user. So you can not login with us. Please contact to administrator',
                //         'status'=>'error'
                //     ]);
                // }
                if(!empty($response['appusers']) && isset($response['appusers'])) {
                    #send response
                    return response()->json([
                        'message'=>'login successfully.',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    #register if user not found in database
                    $appUsers->name           = $request->name;
                    $appUsers->email_id       = $request->email_id;
                    $appUsers->phone_number   = " ";
                    $appUsers->login_method   = $request->login_method;
                    $appUsers->firebase_token = $request->firebase_token;
                    $appUsers->gender         = " ";
                    $appUsers->state          = " ";
                    $appUsers->city           = " ";                   
                    $appUsers->dob            = " ";
                    $appUsers->image            = " ";
                    $appUsers->delete_status  = "1";
                    $appUsers->created_at     = date("Y-m-d");
                    $appUsers->save();
                    if($appUsers->id){
                        $response['appusers'] = $appUsers;
                        #add data in wallet
                        $model = new Wallet();
                        $model->user_id = $appUsers->id;
                        $model->redmeed_id = $appUsers->id;
                        $model->amount  = 500;
                        $model->method  = "by registration";
                        $model->transaction_type = "Credit";
                        $model->created_at = date('Y-m-d');
                        $model->save();
                        if($model->id){
                            return response()->json([
                                'message'=>'Registered successfully.And 500rs has been credited in user account',
                                'code'=>200,
                                'data'=>$response,
                                'status'=>'success'
                            ]);
                        }else{
                            return response()->json([
                                'message'=>'Registered successfully.But 500rs could not be added.Please Contact to administrartor',
                                'code'=>200,
                                'data'=>$response,
                                'status'=>'success'
                            ]);  
                        }
                    }else{
                        return response()->json([
                            'message'=>"something went wrong contact with administrator.",
                            'status'=>'error'
                        ]);
                    }
                }
            #login with phone number  
            }elseif(!empty($request->phone_number)){
                #get data of user if phone_number will match
                $response['appusers'] = Appusers::where('phone_number',$request->phone_number)->first();
                // if($userStatus->delete_status =='0'){
                //     #send response
                //     return response()->json([
                //         'message'=>'You are disabled user. So you can not login with us. Please contact to administrator',
                //         'status'=>'error'
                //     ]);
                // }
                if(!empty($response['appusers']) && isset($response['appusers'])){
                    #send response
                    return response()->json([
                        'message'=>'login successfully.',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]); 
                }else{
                    #register if user not found in database
                    $appUsers->name           = $request->name;
                    $appUsers->email_id       = " ";
                    $appUsers->phone_number   = $request->phone_number;
                    $appUsers->login_method   = $request->login_method;
                    $appUsers->firebase_token = $request->firebase_token;
                    $appUsers->gender         = " ";
                    $appUsers->state          = " ";
                    $appUsers->city           = " ";                   
                    $appUsers->dob            = " ";
                    $appUsers->image          = " ";
                    $appUsers->delete_status  = "1";
                    $appUsers->created_at     = date("Y-m-d");
                    $appUsers->save();
                    if($appUsers->id){
                        $response['appusers'] = $appUsers;
                        #add data in wallet
                        $model = new Wallet();
                        $model->user_id    = $appUsers->id;
                        $model->redmeed_id = $appUsers->id;
                        $model->amount     = 500;
                        $model->method     = "by registration";
                        $model->transaction_type = "Credit";
                        $model->created_at = date('Y-m-d');
                        $model->save();
                        if($model->id){
                            #send response
                            $appUser = Appusers::where('id',$appUsers->id)->first();
                            #send notification for update wallet balance
                            //Your authentication key
                            $authKey = "782a3998b8c705c6f6a650897f4f3403";
                            //Multiple mobiles numbers separated by comma
                            $mobileNumber = $appUser->phone_number;
                            //Sender ID,While using route4 sender id should be 6 characters long.
                            $senderId = "FOODEE";
                            //Your message to send, Add URL encoding here.
                            $message = "Congratulation! 500Rs credited in your wallet check now: http://bit.ly/2H86Ksv";
                            //Define route 
                            $route = "4";
                            //Prepare you post parameters
                            $postData = array(
                                'authkey' => $authKey,
                                'mobiles' => $mobileNumber,
                                'message' => $message,
                                'sender'  => $senderId,
                                'route'   => $route
                            );
                            //API URL
                            $url = "http://sms.bulksmsserviceproviders.com/api/send_http.php";
                            // init the resource
                            $ch = curl_init();
                            curl_setopt_array($ch, array(
                                CURLOPT_URL => $url,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_POST => true,
                                CURLOPT_POSTFIELDS => $postData
                                //,CURLOPT_FOLLOWLOCATION => true
                            ));
                            //Ignore SSL certificate verification
                            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            //get response
                            $output = curl_exec($ch);
                            //Print error if any
                            if (curl_errno($ch)) {
                                return response()->json([
                                    'message'=>curl_error($ch)."sms did not send but all operation has been successful",
                                    'status' =>'error'
                                ]);
                            }
                            curl_close($ch);
                            #send response
                            return response()->json([
                                'message'=>'Registered successfully.And 500rs has been credited in user account',
                                'code'=>200,
                                'data'=>$response,
                                'status'=>'success'
                            ]); 
                        }else{
                            return response()->json([
                                'message'=>'Registered successfully.But 500rs could not be added.Please Contact to administrartor',
                                'code'=>200,
                                'data'=>$response,
                                'status'=>'success'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message'=>"something went wrong contact with administrator.",
                            'status'=>'error'
                        ]);
                    }
                }
            }else{
                return response()->json([
                    'message'=>"Please provide atleast one login detail",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    # user image upload
    public function imageUpload(Request $request){
        try{
            //return  response()->json([base64_decode($request->userImage)]);
            $appUserId = $request['user_id'];
            //check request have data or not
            if(!empty($appUserId) && isset($appUserId)){
                $appUser = Appusers::where('id',$appUserId)->first();
                //check user is in database
                if (!empty($appUser) && isset($appUser)) {
                    $validator = Validator::make($request->all(), ['image' => 'required']);
                    if ($validator->fails()) {
                        return response()->json([
                            'message'=>$validator->messages(),
                            'status'=>'error'
                        ]);
                    }
                    if($request->image){
                        $file_name = 'public/user_images/_user'.time().'.png';
                        $path = Storage::put($file_name, base64_decode($request->image),'public');
                        if($path==true){
                            //update image in agent table of agent
                            $appUsers =   Appusers::where('id', $appUserId)->first();
                            $appUsers->update(['image' => $file_name]);
                            $finalPath = $file_name ? url('/').'/storage/app/'.$file_name : url('/')."/public/dist/img/user-dummy-pic.png";
                            return response()->json([
                                'message'=>'Image successfully uploaded',
                                'status'=>'success',
                                'response'=>$finalPath,
                                'code'=>200
                            ]);

                        }else{
                            return response()->json([
                                'message'=>'Something went wrong with request.Please try again later',
                                'status'=>'error'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message'=>'Please provide image for uploading',
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>'User not found',
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'You are not able to performe this task',
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "error" =>true,
            ]);
        }
    }
    #update firebase token
    public function updateFireBaseToken(Request $request){
        try{
            if($request->id  &&  $request->fireBaseToken){
                $appUsers = Appusers::where('id',$request->id)->first();
                if($appUsers){
                    $updateToken = Appusers::where('id',$request->id)->update([
                        'firebase_token'    => $request->fireBaseToken,
                    ]);
                    if($updateToken){
                        return response()->json([
                            'agent_customers'=>"token successfully updated",
                            'status' =>'success',
                            'code' =>200,
                        ]);
                    }else{
                        return  response()->json([
                            'message'=>'token is not updated yet. please try again',
                            'status' =>'error',
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>'user is not found in database',
                        'status' =>'error',
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>' userId or token not provided',
                    'status' =>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"something went wrong.Please contact administrator.".$e->getMessage(),
                'error' =>true,
            ]);
        }
    }
    #app user profile update
    public function appUserProfileUpdate(Request $request){
        try{
            $appUserId = $request['user_id'];
            //check request have data or not
            if(!empty($appUserId) && isset($appUserId)){
                $appUser = Appusers::where('id',$appUserId)->first();
                //check user is in database
                if(!empty($appUser) && isset($appUser)) {
                    Appusers::where('id',$appUserId)->update([
                        
                       'name'         => $request->name,
                       'email_id'     => $request->email_id,
                       'phone_number' => $request->phone_number,
                       'gender'       => $request->gender,
                       'state'        => ucfirst($request->state),
                       'city'         => ucfirst($request->city),
                       'dob'          => $request->dob,
                       'updated_at'   => date("Y-m-d"),
                    ]);
                    $response = [];
                    $response['appUser'] =  Appusers::where('id', $appUserId)->first();
                    return response()->json([
                        'message'=>'Profile successfully updated',
                        'status'=>'success',
                        'data'=>$response
                    ]);
                }else{
                    return response()->json([
                        'message'=>'User not found',
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'You are not able to performe this task',
                    'status'=>'error'
                ]);
            }        
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "error" =>true,
            ]);
        }

    }
    #get all categories
    public function getAllCategories(Request $request){
        try{
            $allSubcats = [];
            $categories = Category::where('delete_status','1')->get();
            foreach($categories as $category){
                $subcat = SubCategory::with(['getCat'])->where('cat_id',$category->id)->where('delete_status','1')->get();
                if(count($subcat) > 0 ){
                    array_push($allSubcats,$subcat);
                } 
            }
            $response['allPlans'] = Plan::where('delete_status','1')->get();
            $response['allSubCategories'] = $allSubcats;
            $response['base_url'] = "http://www.projects.estateahead.com/kota_tiffin/storage/app/public/";
            if(!empty($response['allSubCategories'])){
                #send response
                return response()->json([
                    'message'=>'All Categories with Sub Categories',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no Categories found",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    #get all products
    public function getAllProducts(Request $request){
        try{
            $subcat_products = [];
            if(!empty($request->subcat_id)){
                //print_r($request->brand_id);die;
                for($i=0; $i<count($request->subcat_id); $i++){
                    $subcat_id = $request->subcat_id[$i]['id'];
                    $products = Products::where('subcat_id',$request->subcat_id) 
                                         ->get();
                    if($products != NULL){
                        array_push($subcat_products,$products);
                    }
                }
                $response['products_listing'] = $subcat_products;
                $response['base_url'] = "http://www.projects.estateahead.com/kotta_tiffin/storage/app/public/";
                if(!empty($response['products_listing'])){
                    #send response
                    return response()->json([
                        'message'=>'All categories Products',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"no Products found of this Sub.",
                        'status'=>'error'
                    ]);
                }
            }else{
                $response['products'] = Products::where('delete_status','1')->get();
                if(!empty($response)){
                    return response()->json([
                        'message'=>'All categories Products',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"no Products found in the database",
                        'status'=>'error'
                    ]);
                }   
            } 
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    #add cart 
    public function addToCart(Request $request){
        try{
           // print_r($request->all());die;
            if(!empty($request->subcat_id) && !empty($request->user_id)){
                $cart =  new Cart();
                $cart->subcat_id = $request->subcat_id;
                $cart->user_id = $request->user_id;
                $cart->plan_id = $request->plan_id;
                $cart->meal_type = $request->meal_type;
                $cart->amount = $request->amount;
                $cart->expire_date = $request->expire_date;
                $cart->created_at = date('Y-m-d');
                $cart->save();
                if($cart->id){
                    return response()->json([
                        'message'=>"product has been successfully added in the cart",
                        "code"=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"Sorry we cant add product in the cart. Please try again.",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Provide category id  and brand id first",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #view cart 
    public function viewCartOfUser(Request $request){
        try{
            $userCartProducts = [];
           
            if(!empty($request->user_id)){
                $appUser = Appusers::where('id',$request->user_id)->first();
                if(!empty($appUser)){
                    $cart = Cart::with(['subCat','plan'])->where('user_id',$request->user_id)->get(); 
                    //$cart = Cart::with(['plan'])->where('user_id',$request->user_id)->get(); 
                    // for($i=0; $i<count($cart); $i++){
                    //     $product = SubCategory::where('id',$cart[$i]['subcat_id'])->with(["getCart"])->get();
                    //     //$response['cart_id'] = $cart[$i]['id'];
                    //     if($product != NULL){
                    //         array_push($userCartProducts,$product);
                    //     }
                    // }
                    
                    if(!empty($cart)){
                        #send response
                        return response()->json([
                            'message'=>'user cart items.',
                            'code'=>200,
                            'data'=>$cart,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>"Product not found in the database please provide excisting user id",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"User not found in the database please provide excisting user id",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Provide user id first",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #delete product from the cart
    public function deleteProductFromCart(Request $request){
        try{
            $carts = FALSE;
            if($request->cart_id){
                //print_r($request->cart_id);die;
                for($i=0; $i<count($request->cart_id); $i++){
                    $cart_id       = $request->cart_id[$i]['id'];
                    $cartItem = DB::table('carts')->where('id',$cart_id)->get();
                    if(count($cartItem) != 0){
                        $cart = DB::table('carts')->where('id',$cart_id)->delete();
                        $carts = $cart;
                        break;
                    } 
                } 
                if($carts==TRUE){
                    #send response
                    return response()->json([
                        'message'=>'Deleted successfully',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"cart not deleted yet.Please try again later.",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Provide Cart id first",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #add delivery address of user
    public function AddUsersDeliveryAddress(Request  $request){
        try{
            if(!empty($request->user_id) && !empty($request->dlvry_address)){
                $model = new UsersDeliveryAddress();
                $model->user_id       = $request->user_id;
                $model->dlvry_address = $request->dlvry_address;
                $model->created_at    = date("Y-m-d");
                $model->save();
                if($model->id){
                    #send response
                    return response()->json([
                        'message'=>'address successfully added',
                        'code'=>200,
                        'status'=>'success'
                    ]); 
                }else{
                    return response()->json([
                        'message'=>"address not successfully added",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Provide all ids first",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #get delivery address of user 
    public function getDeliveryAddress(Request $request){
        try{
            if(!empty($request->user_id)){
                $response['deliveryAddress'] = UsersDeliveryAddress::where('user_id',$request->user_id)->get();
                if($response['deliveryAddress']){
                    #send response
                    return response()->json([
                        'message'=>'All address of this user.',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message' => ' Delivery address not found of this user',
                        'status' => 'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'Please provide user id',
                    'status' => 'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    public function deleteDeliveryAddress(Request $request){
        try{
            if(!empty($request->dlvry_id) && !empty($request->user_id)){
                $dlvryAddress = UsersDeliveryAddress::where('id',$request->dlvry_id)
                                                      ->where('user_id',$request->user_id)
                                                      ->get();
                if(!empty($dlvryAddress)){
                    $action = DB::table('users_delivery_addresses')->where('id',$request->dlvry_id)->delete();
                    if($action==TRUE){
                        #send response
                        return response()->json([
                            'message'=>'Deleted successfully',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>"Delivery address not deleted yet.Please try again later.",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Delivery address not found in the database",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Please provide dlvry id and user id",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #Add feedbacks of user
    public function addFeedbacks(Request $request){
        try{
            if(!empty($request->user_id) && !empty($request->product_id) && !empty($request->feedbacks)){
                $model = new UsersFeedbacks();
                $model->user_id    = $request->user_id;
                $model->product_id = $request->product_id;
                $model->feedbacks   = $request->feedbacks;
                $model->created_at = date('Y-m-d');
                $model->save();
                if($model->id){
                    #send response
                    return response()->json([
                        'message'=>'Feedback successfully added.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>'feedback not saved yet. Please try again later',
                        'status' =>'error'
                    ]);  
                }
            }else{
                return response()->json([
                    'message'=>'Please provide data',
                    'status' =>'error'
                ]);   
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }  
    }
    # get users feedbacks
    public function getUsersFeedback(Request $request){
        try{
            $response = [];
            $usersFeedbacks = []; 
            $users = Appusers::all();
            for($i=0; $i<count($users); $i++){
                $feedbacks = Appusers::where('id',$users[$i]['id'])->with(["getUsersFeedbacks"])->get();
                if(count($feedbacks) != 0){
                    array_push($usersFeedbacks,$feedbacks);
                }
            }
            $response['users_feedbacks'] =  $usersFeedbacks;
            $response['base_url'] = "http://www.projects.estateahead.com/stock_inventory_mgt/storage/app/public/";
            if(!empty($response['users_feedbacks'])){
                #send response
                return response()->json([
                    'message'=>'Users Feedbacks',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"data not found",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);

        }
    }
    #list of all promocodes
    public function allPromocodes(Request $request){
        try{
            $promocodes = PromoCodes::all();
            if(!empty($promocodes)){
                #send response
                return response()->json([
                    'message'=>'There is no text of discount_in key so you have to implement 1 for rs and 2 for %.',
                    'data'=>$promocodes,
                    'code'=>200,
                    'status'=>'success'
                ]); 
            }else{
                return response()->json([
                    'message'=>"Promo Codes not found in the database",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #apply promo code
    public function applyPromoCode(Request $request){
        try{
            if(!empty($request->promo_id)){
                $promoCode = PromoCodes::where('id',$request->promo_id)->first();
                if(!empty($promoCode)){
                    $response['promoCode'] = $promoCode; 
                    return response()->json([
                        'message' => '1 for rs and 2 for %',
                        'code'=>200,
                        'data'=> $response,
                        'status' => 'success'
                    ]); 
                }else{
                    return response()->json([
                        'message' => 'Invalid Promocode',
                        'status' => 'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'Please provide amount and promocode id',
                    'status' => 'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #generate referal code
    public function addReferalCode(Request $request){
        try{
            if(!empty($request->user_id)){
                $model = new ReferalCode();
                $model->user_id      = $request->user_id;
                $model->referal_code =  "";
                $model->redmeed_id   =  $request->redmeed_id;
                $model->delete_status = '1';
                $model->created_at = date('Y-m-d');
                $model->save();
                if($model->id){
                    $referal_code = "FOODEE-ID".$request->user_id."-".rand(10000,20000);
                    $returnData = ReferalCode::where('id',$model->id)->update([
                        'referal_code' => $referal_code,
                    ]);
                    if($returnData){
                        #send response
                        return response()->json([
                            'message'=>'new referal code for this user',
                            'code'=>200,
                            'data'=>$referal_code,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>'Something went wrong.Please contact to administrator.',
                            'status' =>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>'Referal code is not inserted yet.Please contact to administrator.',
                        'status' =>'error'
                    ]);
                }  
            }else{
                return response()->json([
                    'message'=>'please provide the user id',
                    'status' =>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #insert redemed data
    public function addRedemeedData(Request $request){
        try{
            if(!empty($request->redemeed_id) && !empty($request->referal_code)){
                 
                $findReferalCode = ReferalCode::where('referal_code',$request->referal_code)->first();
                //$findRdmdId = ReferalCode::where('redmeed_id',$request->redemeed_id)->first();
               // print_r($findReferalCode['redmeed_id']);die;

				#check redmeed id is exist ot not
                if(($findReferalCode['redmeed_id'] != $request->redemeed_id) && ($findReferalCode['user_id'] != $request->redemeed_id)){
                         
                    if(empty($findReferalCode->redmeed_id)){
                        #inseert redmeed if
                        $returnData = ReferalCode::where('referal_code',$request->referal_code)->update([
                            'redmeed_id'=> $request->redemeed_id,
                            'updated_at'=> date('Y-m-d')
                        ]);
                        if($returnData){
                            #add data in wallet
                            $model = new Wallet();
                            $model->user_id = $findReferalCode->user_id;
                            $model->redmeed_id = $request->redemeed_id;
                            $model->amount  = 500;
                            $model->method  = "by referal";
                            $model->transaction_type = "Credit";
                            $model->created_at = date('Y-m-d');
                            $model->save();
                            if($model->id){
                                $appUser = Appusers::where('id',$findReferalCode->user_id)->first();
                                #send notification for update wallet balance
                                //Your authentication key
                                $authKey = "782a3998b8c705c6f6a650897f4f3403";
                                //Multiple mobiles numbers separated by comma
                                $mobileNumber = $appUser->phone_number;
                                //Sender ID,While using route4 sender id should be 6 characters long.
                                $senderId = "FOODEE";
                                //Your message to send, Add URL encoding here.
                                $message = "Congratulation! 500Rs credited in your wallet check now: http://bit.ly/2H86Ksv";
                                //Define route 
                                $route = "4";
                                //Prepare you post parameters
                                $postData = array(
                                    'authkey' => $authKey,
                                    'mobiles' => $mobileNumber,
                                    'message' => $message,
                                    'sender'  => $senderId,
                                    'route'   => $route
                                );
                                //API URL
                                $url = "http://sms.bulksmsserviceproviders.com/api/send_http.php";
                                // init the resource
                                $ch = curl_init();
                                curl_setopt_array($ch, array(
                                    CURLOPT_URL => $url,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_POST => true,
                                    CURLOPT_POSTFIELDS => $postData
                                    //,CURLOPT_FOLLOWLOCATION => true
                                ));
                                //Ignore SSL certificate verification
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                                //get response
                                $output = curl_exec($ch);
                                //Print error if any
                                if (curl_errno($ch)) {
                                    return response()->json([
                                        'message'=>curl_error($ch)."sms did not send but all operation has been successful",
                                        'status' =>'error'
                                    ]);
                                }
                                curl_close($ch);
                                #send response
                                return response()->json([
                                    'message'=>'add money in the wallet also update redmeed_id',
                                    'code'=>200,
                                    'status'=>'success'
                                ]);
                            }else{
                                return response()->json([
                                    'message'=>'updated redmeed id but not saved data in wallet.Pease Contact to administrator',
                                    'status' =>'error'
                                ]);
                            }
                        }else{
                            return response()->json([
                                'message'=>'Something went wrong.Please try again',
                                'status' =>'error'
                            ]);
                        } 
                    }else{
                        return response()->json([
                            'message'=>'Referal code already used.',
                            'status' =>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>'You cant apply more than one time and also can not apply same user',
                        'status' =>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'please provide the redemeed id and referal code.',
                    'status' =>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #get all amount of wallet for particular id
    public function getAllWalletAmount(Request $request){
        try{
            $appUsers = [];
            if(!empty($request->user_id)){
                $walletData = Wallet::where('user_id',$request->user_id)->orderBy('created_at','desc')->get();
                for($i=0; $i<count($walletData); $i++){
                    $userId = $walletData[$i]['redmeed_id'];
                    $userData = Appusers::where('id',$userId)->get();                          
                    if($userData != NULL){
                        array_push($appUsers,$userData);
                    }
                }
                $response['walletData'] = $walletData;
                $response['redmeedUsers'] = $appUsers;
                if(count($walletData)!= 0 && count($appUsers)!= 0 ){
                    #send response
                    return response()->json([
                        'message'=>'Wallet',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>'data not found.',
                        'status' =>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'Provide user id first',
                    'status' =>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #save transactions of user
    public function submitTransaction(Request $request){
        try{
            $data = [];
            $amountToBePaid ="";
            if($request->order_id){
                if(!empty($request->using_wallet) && $request->using_wallet =="YES"){
                    $amountToBePaid = ($request->amount_to_be_paid < "0") ? "0": $request->amount_to_be_paid;
                }else{
                    $amountToBePaid = $request->amount;
                }
                $model = new UserTransactions();
                $model->order_id   = $request->order_id;
                $model->user_id    = $request->user_id;
                for($i=0; $i<count($request->product_id); $i++){
                    $product_ids = $request->product_id[$i]['id'];
                    array_push($data,$product_ids);
                }
                $model->product_id = json_encode($data);
                $model->invoice_id = rand(10,1000);
                $model->amount     = $request->amount;
                $model->amount_to_be_paid  = $amountToBePaid ;
                $model->status     = ($request->status=="") ? "Cash On Delivery": $request->status;
                $model->promo_code = $request->promo_code;
                $model->dlvry_address = $request->dlvry_address;
                $model->dlvry_type    = $request->dlvry_type;
                $model->expire_date   = $request->expire_date;
                $model->plan_type     = $request->plan_type;
                if(($request->status == "Success") || ($request->status == "")){$model->dlvry_status = "0";}else{$model->dlvry_status = " ";}
                $model->created_at = date('Y-m-d |h:i');
                $model->save();
                 
                if($model->id){
                    $userData = Appusers::where('id',$request->user_id)->where('delete_status','1')->first();
                    if($request->status =="Fail"){

                        #send response
                        $authKey = "782a3998b8c705c6f6a650897f4f3403";
                        $mobileNumber = $userData->phone_number;
                        $senderId = "FOODEE";
                        $message = "Your transaction has been faild. \n Order id : ".$request->order_id."\n Amount : ".$request->amount.'Rs';
                        $route = "4";
                        //Prepare you post parameters
                        $postData = array(
                            'authkey' => $authKey,
                            'mobiles' => $mobileNumber,
                            'message' => $message,
                            'sender'  => $senderId,
                            'route'   => $route
                        );
                        //API URL
                        $url = "http://sms.bulksmsserviceproviders.com/api/send_http.php";
                        // init the resource
                        $ch = curl_init();
                        curl_setopt_array($ch, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData
                            //,CURLOPT_FOLLOWLOCATION => true
                        ));
                        //Ignore SSL certificate verification
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        //get response
                        $output = curl_exec($ch);
                        //Print error if any
                        if (curl_errno($ch)) {
                            return response()->json([
                                'message'=>curl_error($ch)."sms did not send but all operation has been successful",
                                'status' =>'error'
                            ]);
                        }
                        curl_close($ch); 
                        return response()->json([
                            'message'=>'Transaction successfully added.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }else{
                        #send response
                        $authKey = "782a3998b8c705c6f6a650897f4f3403";
                        $mobileNumber = $userData->phone_number;
                        $senderId = "FOODEE";
                        $message = "Congratulations!! your order has been Confirmed Successfully. \n Order id : ".$request->order_id."\n Amount to be paid: ".$amountToBePaid.'Rs';
                        $route = "4";
                        //Prepare you post parameters
                        $postData = array(
                            'authkey' => $authKey,
                            'mobiles' => $mobileNumber,
                            'message' => $message,
                            'sender'  => $senderId,
                            'route'   => $route
                        );
                        //API URL
                        $url = "http://sms.bulksmsserviceproviders.com/api/send_http.php";
                        // init the resource
                        $ch = curl_init();
                        curl_setopt_array($ch, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData
                            //,CURLOPT_FOLLOWLOCATION => true
                        ));
                        //Ignore SSL certificate verification
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        //get response
                        $output = curl_exec($ch);
                        //Print error if any
                        if (curl_errno($ch)) {
                            return response()->json([
                                'message'=>curl_error($ch)."sms did not send but all operation has been successful",
                                'status' =>'error'
                            ]);
                        }
                        curl_close($ch);
                        $amounts=[];

                        if(!empty($request->using_wallet) && $request->using_wallet =="YES"){
                            // $wallet = Wallet::where('user_id',$request->user_id)->where('transaction_type','credit')->get();

                            // for($i=0; $i<count($wallet); $i++){
                            //     $amount = $wallet[$i]['amount'];
                            //     array_push($amounts,$amount);
                            // }
                            // $sum_wallet_amount = array_sum($amounts);
                            // if($sum_wallet_amount > $request->wallet_amount ){
                            //     $final_amount = $sum_wallet_amount - $request->wallet_amount;
                            // }else{
                            //     $final_amount = $sum_wallet_amount;
                            // }
                            $model = new Wallet();
                            $model->user_id    = $request->user_id;
                            $model->redmeed_id = $request->user_id;
                            $model->amount     =  $request->debit_amount;
                            $model->method     = 'used_in_transaction';
                            $model->transaction_type = 'debit';
                            $model->created_at = date('Y-m-d | h:i');
                            $model->save();
                        }
                        $model = new Wallet();
                        $model->user_id    = $request->user_id;
                        $model->redmeed_id = $request->user_id;
                        $model->amount     =  $request->wallet_amount;
                        $model->method     = 'transaction_cashback';
                        $model->transaction_type = 'credit';
                        $model->created_at = date('Y-m-d | h:i');
                        $model->save();

                        return response()->json([
                            'message'=>'Transaction successfully added.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>'Transaction not saved yet. Please try again later',
                        'status' =>'error'
                    ]);  
                }
            }else{
                return response()->json([
                    'message'=>'Please provide data',
                    'status' =>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #old Transactions
    public function oldTransactions(Request $request){
        try{
            $product_ids = [];
            $response['product_data'] = [];
            if(!empty($request->user_id)){
               $response['userTransections'] = $userTransections = UserTransactions::where('user_id',$request->user_id)->orderBy('created_at', 'DESC')->get();
                for($i=0; $i<count($userTransections); $i++){
                    $product_id =  json_decode($userTransections[$i]->product_id);
                    array_push($product_ids,$product_id);
                }
                for($i=0; $i<count($product_ids); $i++){
                    for($j=0; $j<count($product_ids[$i]); $j++){
                       
                        $products = SubCategory::where('id', $product_ids[$i][$j])->where('delete_status','1')->first();
                        array_push($response['product_data'],$products);
                    }
                }
                if($response){
                    #send response
                    return response()->json([
                        'message'=>'All transections of this user.',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message' => 'Transections not found of this user',
                        'status' => 'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'Please provide user id',
                    'status' => 'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
    #get states
    public function getAllStates(Request $request){
        try{
            $response['states'] = States::all();
            if(!empty($response['states'])){
                #send response
                return response()->json([
                    'message'=>'All states',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no states found",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    #get cities based on state id
    public function getAllCities(Request $request){
        try{
            if($request->state_id){
                $response['cities'] = Cities::where('state_id',$request->state_id)->get();
                if(!empty($response['cities'])){
                    #send response
                    return response()->json([
                        'message'=>'All Cities',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"no cities found",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Please provide state id first",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    # add wallet amount by third party api
    public function addWalletAmountByUser(Request $request){ 
        try{
            if(!empty($request->user_id) && !empty($request->amount)){
                #add data in wallet
                $model = new Wallet();
                $model->user_id    = $request->user_id;
                $model->redmeed_id = $request->user_id;
                $model->amount  = $request->amount;
                $model->method  = "by_bank";
                $model->transaction_type = "Credit";
                $model->created_at = date('Y-m-d');
                $model->save();
                if($model->id){
                    #send response
                    return response()->json([
                        'message'=>'added successfully in the wallet.',
                        'code'=>200,
                        'status'=>'success'
                    ]); 
                }else{
                    return response()->json([
                        'message'=>"Data not added yet in the wallet table.",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Please provide user id first",
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    #get Plan 
    public function getPlan(Request $request){
        try{
            if(!empty($request->subcat_id) && !empty($request->plan_id)){
                $response['plan'] = Plan::where('subcat_id',$request->subcat_id)
                                         ->where('id',$request->plan_id)
                                         ->where('delete_status','1')
                                         ->first();
                if($response['plan']){
                    #send response
                    return response()->json([
                        'message'=>'Plan.',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message' => ' Plan not found with this id',
                        'status' => 'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message' => 'Please provide subcat id and plan id',
                    'status' => 'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong. Please contact administrator.'.$e->getMessage(),
                'status' =>'error'
            ]);
        }
    }
}
