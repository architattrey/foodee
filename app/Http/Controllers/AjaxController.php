<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\models\Cart;
use App\models\Days;
use App\models\Cities;
use App\models\States;
use App\models\Products;
use App\models\Appusers;
use App\models\Category;
use App\models\PromoCodes;
use App\models\SubCategory;
use App\models\Plan;
use App\models\ReferalCode;
use App\models\UsersFeedbacks;
use App\models\UserTransactions;
use App\models\UsersDeliveryAddress;
use DB;

class AjaxController extends Controller
{
    #get all category
    public function getCategories(Request $request){
        try{
            $response['categories'] = Category::where('delete_status','1')->get();
            if(!empty($response['categories'])){
                #send response
                $base_url = url('/')."/storage/app/public/";
                return response()->json([
                    'message'=>'All Categories',
                    'code'=>200,
                    'base_url' => $base_url,
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
    #Category image upload
    public function imageUpload(Request $request){
        try{
           
            if($request->category_image){
                
                $file_data = $request->category_image;
                $file_name = 'cat_images/' . time() . '.' . explode('/', explode(':', substr($file_data, 0, strpos($file_data, ';')))[1])[1];
                @list($type, $file_data) = explode(';', $file_data);
                @list(, $file_data) = explode(',', $file_data);
                if ($file_data != "") {
                    //dd($request->file_data);
                    \Storage::disk('public')->put($file_name, base64_decode($file_data));
                }
                // $finalPath = $file_name ? url('/')."/storage/app/public/".$file_name : url('/')."/public/dist/img/user-dummy-pic.png";
                $finalPath = $file_name;
                $base_url = url('/')."/storage/app/public/";
                if($finalPath){
                    return response()->json([
                        'message'=>' uploaded successfully.',
                        'image_url'=> $finalPath,
                        'base_url' => $base_url,
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Category not uploaded yet.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Please prvide the image.",
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
    # update add category
    public function addOrUpdate(Request $request){
        try{
            #check if id
            if($request->id){
                $categoryData = Category::where('id',$request->id)->first();
                if($categoryData){
                    $returnData = Category::where('id',$request->id)->update([
                        'categories'=> $request->categories,
                        'price_fake'=>$request->price_fake,
                        'price_org'=>$request->price_org,
                        'description'=>$request->description,
                        'image'=> $request->image,
                        'updated_at'=> date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                        
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Category not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add category
                $category = new Category();
                $category->categories     = $request->categories;
                $category->price_fake     = $request->price_fake;
                $category->price_org      = $request->price_org;
                $category->description    = $request->description;
                $category->image          = $request->image;
                $category->delete_status  = "1";
                $category->created_at     = date("Y-m-d");
                $category->save();
                if($category->id){
                    return response()->json([
                        'message'=>'Category added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
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
    # delete category
    public function deleteCategory(Request $request){
        try{
            if($request->id){
                $categoryData = Category::where('id',$request->id)->first();
                if($categoryData){
                    $returnData = Category::where('id',$request->id)->update([
                        'delete_status'=> "0",
                        'updated_at'=> date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Category not found with our database",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    # get Sub category
    public function getSubcategory(Request $request){
        try{
            $response['subcategory'] = SubCategory::where('delete_status','1')->get();
            if(!empty($response['subcategory'])){
                #send response
                $base_url = url('/')."/storage/app/public/";
                return response()->json([
                    'message'=>'All Sub Category',
                    'code'=>200,
                    'base_url' => $base_url,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no sub category found",
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
    #add Update Subcategory
    public function addUpdateSubcategory(Request $request){
        try{
            #check if Subcategory id 
            if($request->id){
                $subCategoryData = SubCategory::where('id',$request->id)->first();
                if($subCategoryData){
                    $returnData = SubCategory::where('id',$request->id)->update([
                        'cat_id'      => $request->cat_id,
                        'sub_cat_name'=> $request->sub_cat_name,
                        // 'mrp'         => $request->mrp,
                        // 'foodee_price'=> $request->foodee_price,
                        'description' => $request->description,
                        'image'       => $request->image,
                        'updated_at'  => date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                        
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Sub Category not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add Sub category
                $model = new SubCategory();
                $model->cat_id       = $request->cat_id;
                $model->sub_cat_name = $request->sub_cat_name;
                $model->image        = $request->image;
                // $model->mrp          = $request->mrp;
                // $model->foodee_price = $request->foodee_price;
                $model->description  = $request->description;
                $model->delete_status= "1";
                $model->created_at   = date("Y-m-d");
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Sub Category added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
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
    # Sub Category image upload
    public function SubCatImageUpload(Request $request){
        try{
           
            if($request->subcategory_image){
                
                $file_data = $request->subcategory_image;
                $file_name = 'subcat_images/' . time() . '.' . explode('/', explode(':', substr($file_data, 0, strpos($file_data, ';')))[1])[1];
                @list($type, $file_data) = explode(';', $file_data);
                @list(, $file_data) = explode(',', $file_data);
                if ($file_data != "") {
                    //dd($request->file_data);
                    \Storage::disk('public')->put($file_name, base64_decode($file_data));
                }
                // $finalPath = $file_name ? url('/')."/storage/app/public/".$file_name : url('/')."/public/dist/img/user-dummy-pic.png";
                $finalPath = $file_name;
                $base_url = url('/')."/storage/app/public/";
                if($finalPath){
                    return response()->json([
                        'message'=>' uploaded successfully.',
                        'image_url'=> $finalPath,
                        'base_url' => $base_url,
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Sub Category not uploaded yet.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Please prvide the image.",
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
    # delete Sub ctategory
    public function deleteSubcategory(Request $request){
        try{
            if($request->id){
                $subCategoryData = SubCategory::where('id',$request->id)->first();
                if($subCategoryData){
                    $returnData = SubCategory::where('id',$request->id)->update([
                        'delete_status'=> "0",
                        'updated_at'=> date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Sub Category Deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Sub Category not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    # get plans
    public function getPlan(Request $request){
        try{
            $response['plan'] = Plan::with(['getSubCat'])->where('delete_status','1')->get();
            if(!empty($response['plan'])){
                #send response
                return response()->json([
                    'message'=>'All Plan',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no plan found",
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
    #add Update Plan
    public function addUpdatePlan(Request $request){
        try{
            $foodeePrice="";
            #check if plan id 
            if($request->id){
                $planData = Plan::where('id',$request->id)->first();
                if($planData){
                    if($request->discount_unit =="%"){
                        $discountPrice = ($request->mrp * $request->discount / 100);
                        $foodeePrice = round($request->mrp - $discountPrice);
    
                    }elseif($request->discount_unit =="Rs"){
                        $foodeePrice = ($request->mrp - $request->discount); 
                    }
                    $returnData = Plan::where('id',$request->id)->update([
                        'subcat_id' => $request->subcat_id,
                        'plans'=> $request->plans,
                        'mrp'  => $request->mrp,
                        'discount' => $request->discount,
                        'discount_unit' =>$request->discount_unit,
                        'foodee_price'=> $foodeePrice,
                        'updated_at'  => date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry plan not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                if($request->discount_unit =="%"){
                    $discountPrice = ($request->mrp * $request->discount / 100);
                    $foodeePrice = round($request->mrp - $discountPrice);

                }elseif($request->discount_unit =="Rs"){
                    $foodeePrice = ($request->mrp - $request->discount); 
                }
                #add Plan
                $model = new Plan();
                $model->subcat_id       = $request->subcat_id;
                $model->plans = $request->plans;
                $model->mrp          = $request->mrp;
                $model->discount = $request->discount;
                $model->discount_unit = $request->discount_unit;
                $model->foodee_price = $foodeePrice;
                $model->delete_status= "1";
                $model->created_at   = date("Y-m-d");
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Plan added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
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
    # delete Sub ctategory
    public function deletePlan(Request $request){
        try{
            if($request->id){
                $planData = Plan::where('id',$request->id)->first();
                if($planData){
                    $returnData = Plan::where('id',$request->id)->update([
                        'delete_status'=> "0",
                        'updated_at'=> date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Plan Deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Plan not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    public function getProducts(Request $request){
        try{
            $response['products'] = Products::with(['subCatProducts'])->where('delete_status','1')->get();
            $response['baseUrl'] =  url('/')."/storage/app/public/";
            if(!empty($response['products'])){
                #send response
                return response()->json([
                    'message'=>'All Products',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no Products found",
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
    #add Update Product
    public function addUpdateProduct(Request $request){
        try{
            #check if id 
            if($request->id){
                $productData = Products::where('id',$request->id)->first();
                if($productData){
                    $returnData = Products::where('id',$request->id)->update([
                       
                        'subcat_id'  => $request->subcat_id,
                        'days'=>$request->days,
                        'products'=>$request->products,
                        'updated_at'   => date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                        
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Data not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add products
                $model = new Products();
                $model->subcat_id     = $request->subcat_id;
                $model->days   = $request->days;
                $model->products   = $request->products;
                $model->delete_status  = '1';
                $model->created_at     = date("Y-m-d");
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Product added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
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
    # delete Trending Product
    public function deleteProduct(Request $request){
        try{
            if($request->id){
                $brandData = Products::where('id',$request->id)->first();
                if($brandData){
                    $returnData = Products::where('id',$request->id)->update([
                       
                        'delete_status'  => "0",
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Product Deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Product  not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    # get Sub category
    public function getDays(Request $request){
        try{
            $response['days'] = Days::all();
            if(!empty($response['days'])){
                #send response
                return response()->json([
                    'message'=>'All Days',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no daysfound",
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
    #add Update Subcategory
    public function addUpdateDay(Request $request){
        try{
            #check if day id 
            if($request->id){
                $DayData = Days::where('id',$request->id)->first();
                if($DayData){
                    $returnData = Days::where('id',$request->id)->update([
                        'days'      => $request->days,
                        'updated_at'  => date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry days not fond",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add day
                //dd($request->all());
                $model = new Days();
                $model->days         = $request->days;
                $model->created_at   = date("Y-m-d");
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Day added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
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
    # delete Sub ctategory
    public function deleteDay(Request $request){
        try{
            if($request->id){
                $dayData = Days::where('id',$request->id)->first();
                if($dayData){
                    $returnData = DB::table('days')->where('id', '=', $request->id)->delete();
                    if($returnData){
                        return response()->json([
                            'message'=>'Deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry day not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    #get all promocodes
    public function getAllPromocodes(Request $request){
        try{
            $response['promocodes'] = PromoCodes::all();
            $response['baseUrl'] =  url('/')."/storage/app/public/";
            if(!empty($response['promocodes'])){
                #send response
                return response()->json([
                    'message'=>'All Promocode',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"No Promocode found",
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
    #add Update PromoCode
    public function addUpdatePromocode(Request $request){
        try{
            #check if id 
            if($request->id){
                $promoCodes = PromoCodes::where('id',$request->id)->first();
                if($promoCodes){
                    $returnData = PromoCodes::where('id',$request->id)->update([
                        'promocode'      => $request->promocode,
                        'desciption'     => $request->desciption,
                        'image'          => $request->image,
                        'discount_amount'=> $request->discount_amount,
                        'discount_in'    => $request->discount_in,
                        'updated_at'     => date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                        
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Data not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add promocode
                $model = new PromoCodes();
                $model->promocode     = $request->promocode;
                $model->desciption    = $request->desciption;
                $model->image         = $request->image;
                $model->discount_amount = $request->discount_amount;
                $model->discount_in     = $request->discount_in;
                $model->created_at      = date("Y-m-d");
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Promo Code Successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
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
    # delete Promocode
    public function deletePromocode(Request $request){
        try{
            if($request->id){
                $promoData = PromoCodes::where('id',$request->id)->first();
                if($promoData){
                    $returnData = DB::table('promo_codes')->where('id',$request->id)->delete();
                    
                    if($returnData){
                        return response()->json([
                            'message'=>'Promocode Deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Promo code not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    #Product image upload
    public function promocodeImageUpload(Request $request){
        try{
            if($request->promocode_image){
                $file_data = $request->promocode_image;
                $file_name = 'promocode_images/' . time() . '.' . explode('/', explode(':', substr($file_data, 0, strpos($file_data, ';')))[1])[1];
                @list($type, $file_data) = explode(';', $file_data);
                @list(, $file_data) = explode(',', $file_data);
                if ($file_data != "") {
                    \Storage::disk('public')->put($file_name, base64_decode($file_data));
                }
                
                $finalPath = $file_name;
                $base_url = url('/')."/storage/app/public/";
				 
                if($finalPath){
                    return response()->json([
                        'message'=>'Promocode uploaded successfully.',
                        'image_url'=> $finalPath,
                        'base_url'=> $base_url,
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Promocode not uploaded yet.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Please prvide the image.",
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
    #get all User
    public function getUserData(Request $request){
        try{
            $response['userdata'] = Appusers::where('delete_status','1')->get();
            $response['image_base_url'] =  url('/')."/storage/app/";
            if(!empty($response['userdata'])){
                #send response
                return response()->json([
                    'message'=>'All Usres',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no Users found",
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
    # delete User
    public function deleteUser(Request $request){
        try{
            if($request->id){
                $userData = Appusers::where('id',$request->id)->first();
                if($userData){
                    $returnData = Appusers::where('id',$request->id)->update([
                        'delete_status' =>'0'
                    ]);
                    
                    if($returnData){
                        return response()->json([
                            'message'=>'User disabled successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Promo code not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    #get User delivery address
    public function getuserDeliveryAddress(Request $request){
        try{
            if($request->user_id){
                $response['userdeliveryaddress'] = UsersDeliveryAddress::where('user_id',$request->user_id)->get();
                if(!empty($response['userdeliveryaddress'])){
                    #send response
                    return response()->json([
                        'message'=>'All Usres Delivery Addresses',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"no Address found",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request",
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
    #get User transaction
    public function getUserTransaction(Request $request){
        try{
            if($request->user_id){
                $response['usertransactions'] = UserTransactions::where('user_id',$request->user_id)->orderBy('created_at', 'DESC')->get();
                if(!empty($response['usertransactions'])){
                    #send response
                    return response()->json([
                        'message'=>'All Users transaction',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"no Transactions found",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request",
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
    #get User feedbacks
    public function getUserFeedbacks(Request $request){
        try{
            $feedbacks = [];
            if($request->user_id){
                $feedbacks = UsersFeedbacks::where('user_id',$request->user_id)->get();
                // foreach($feedbacks as $feedback){
                //     $feedbacksWithProducts = UsersFeedbacks::with('feedbackProducts')->where('product_id',$feedback->product_id)->get()->toArray();
                    
                //     print_r(count($feedbacksWithProducts));
                //     // if(count($feedbacksWithProducts) > 0 ){
                //     //     array_push($feedbacks,$feedbacksWithProducts);
                //     // } 
                // }

                $response['userfeedbacks'] = $feedbacks;
                if(!empty($response['userfeedbacks'])){
                    #send response
                    return response()->json([
                        'message'=>'All Users Feedbacks with product',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"feedbacks not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request",
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
    #get deliveries
    public function getDeliveries(Request $request){
        try{
            $response['alltransactions'] = UserTransactions::orderBy('created_at','asc')->get();
            if(!empty($response['alltransactions'])){
                #send response
                return response()->json([
                    'message'=>'All transaction',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"No transactions found",
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
     #change dlvry status
     public function changeDeliveryStatus(Request $request){
        try{
            if(!empty($request->id) && !empty($request->dlvry_status)){
                $response['transaction'] = UserTransactions::where('id',$request->id)
                                                        
                                                        ->first();
                if(!empty($response['transaction'])){
                    $returnData = UserTransactions::where('id',$request->id)->update([
                        'dlvry_status'=>$request->dlvry_status,
                        'updated_at'=> date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]); 
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"No transactions found",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"please provide the id and delivesry status",
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
    #invoice data
    public function getInvoiceData(Request $request){
        try{
            $productData = [];
           
            if(!empty($request->user_id) && !empty($request->product_id)){
                $product_ids = json_decode($request->product_id);
                for($i=0; $i<count($product_ids); $i++){
                    $product_id = $product_ids[$i];
                    $data = SubCategory::where('id',$product_id)->first();
                    array_push($productData,$data);
                }
                $response['productData'] = $productData;
                if(!empty($response['productData'])){
                    $data = Appusers::where('id',$request->user_id)->first();
                    $response['userData'] = $data;
                    if(!empty($response['userData'])){
                        return response()->json([
                            'message'=>'All transaction',
                            'code'=>200,
                            'data'=>$response,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong.",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Something went wrong.",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"please provide the ids",
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
}
