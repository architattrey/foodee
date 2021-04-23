@extends('admin.layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="planApp" ng-controller="planController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Plan Section</li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                <a style="margin-top: 5px; padding: 10px 17px; float: right;b margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Plans</button></a>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
        <!-- Plans-->
        <!-- Main content -->
        <section class="content" >
            <table id="categories"  datatable="ng" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th  width="2%">#</th>
                        <th  width="10%">Sub Category</th>
                        <th  width="10%">Plans</th>
                        <th  width="5%">MRP</th>
                        <th  width="5%">Discount</th>
                        <th  width="10%">Discount Unit</th>
                        <th  width="10%">Foodee Price</th>
                        <th  width="10%">Created At</th>
                        <th  width="10%">Updated At</th>
                        <th  width="10%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="plan in planData | filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{plan.get_sub_cat.sub_cat_name}}</td>
                        <td>@{{plan.plans}}</td>
                        <td>@{{plan.mrp}}</td>
                        <td>@{{plan.discount}}</td>
                        <td>@{{plan.discount_unit}}</td>
                        <td>@{{plan.foodee_price}}</td>
                        <td>@{{plan.created_at|limitTo:10}}</td>
                        <td>@{{plan.updated_at|limitTo:10}}</td>
                        <td>
                            <button type="button" class="btn btn-success"><a href="" ng-click="update(plan)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger"><a href=""  ng-click="deleteModel(plan)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- add plan modal -->
        <div class="modal fade" id="Addplan" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Add Plan</h4>
                    </div>
                    <div class="modal-body">
                        <!-- row start -->
                        <div class="row">
                            <!-- col start -->
                            <div class= "col-sm-6">
                                <!-- add Sub cateegory  -->
                                <div class="form-group">
                                    <label for="">Select Sub Category</label>
                                    <select ng-model = "subCategoryId" class="form-control">
                                        <option value = "" label = "Please Select Sub Category"></option>
                                        <option ng-repeat ="subcategory in subcategoryData" value="@{{subcategory.id}}">
                                            @{{subcategory.sub_cat_name}}
                                        </option>
                                    </select>
                                </div>    
                                <!-- add mrp -->
                                <div class="form-group">
                                    <label for="">Add MRP</label>    
                                    <input type="number" ng-model="Mrp" class="form-control">
                                </div>
                                 <!-- add discount  -->
                                 <div class="form-group">
                                    <label for="">Select Discount Unit</label>
                                    <select ng-model = "discountUnit" class="form-control">
                                        <option value = "" label = "Please Select Unit"></option>
                                        <option value="%">%</option>
                                        <option value="Rs">Rs</option>
                                    </select>
                                </div>   
                            </div>
                            <!-- col start -->
                            <div class= "col-sm-6">
                                <!-- add Plan  -->
                                <div class="form-group">
                                    <label for="">Select Plan</label>
                                    <select ng-model  = "plan" class="form-control">
                                        <option value = "" label = "Please Select Plan"></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Half Yearly">Half Yearly</option>
                                    </select>
                                </div>    
                                 
                                <!-- add discount -->
                                <div class="form-group">
                                    <label for="">Add Discount</label>    
                                    <input type="text" ng-model="Discount" class="form-control">
                                </div>
                            </div>
                            <!--/ col end -->
                        </div>
                        <!--/ row end -->     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addplan()">Submit</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!--/add plan modal -->
        <!-- update Modal -->
        <div class="modal fade" id="updateModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Update</h4>
                    </div>
                    <div class="modal-body">
                        <!-- row start -->
                        <div class="row">
                            <!-- col start -->
                            <div class= "col-sm-6">
                                <!-- add Sub cateegory  -->
                                <div class="form-group">
                                    <label for="">Select Sub Category</label>
                                    <select ng-model = "subCategoryId" class="form-control">
                                        <option value = "" label = "Please Select Sub Category"></option>
                                        <option ng-repeat ="subcategory in subcategoryData" value="@{{subcategory.id}}">
                                            @{{subcategory.sub_cat_name}}
                                        </option>
                                    </select>
                                </div>    
                                <!-- add mrp -->
                                <div class="form-group">
                                    <label for="">Add MRP</label>    
                                    <input type="text" ng-model="Mrp" class="form-control">
                                </div>
                                <!-- add discount  -->
                                <div class="form-group">
                                    <label for="">Select Discount Unit</label>
                                    <select ng-model = "discountUnit" class="form-control">
                                        <option value = "" label = "Please Select Unit"></option>
                                        <option value="%">%</option>
                                        <option value="Rs">Rs</option>
                                    </select>
                                </div>    
                            </div>
                            <!-- col-sm-6 -->
                            <div class= "col-sm-6">
                                <!-- add Plan  -->
                                <div class="form-group">
                                    <label for="">Select Plan</label>
                                    <select ng-model = "plan" class="form-control">
                                        <option value = "" label = "Please Select Plan"></option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Quaterly">Quaterly</option>
                                        <option value="Half Yearly">Half Yearly</option>
                                    </select>
                                </div>    
                                <!-- add discount -->
                                <div class="form-group">
                                    <label for="">Add Discount</label>    
                                    <input type="text" ng-model="Discount" class="form-control">
                                </div>
                            </div>
                            <!--/ col end -->
                        </div>
                        <!--/ row end -->     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updateplan()">Update</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!--/ update Modal  -->
        <!--delete Modal  -->
        <div class="modal fade" id="deteteplan" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Delete</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deleteplan()">Delete</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!--/delete Modal -->
    </div>
@endsection 
@section('script')
<script>
    var planApp = angular.module("planApp",[]);
    planApp.controller("planController",function($scope, $http){
       
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);
        //plan listing
        $scope.planData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-plan").then(response =>{
                $scope.planData = response.data.data.plan;
         
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();

        //subcats for dropdown
        $scope.subcategoryData = [];
        $scope.getsubcat = function() {
            $http.get("{{url('/')}}/get-subcategory").then(response =>{
                $scope.subcategoryData = response.data.data.subcategory;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getsubcat();

        // open add plan modal
        $scope.addOpen = function() {
          
            $scope.subCategoryId ="";
            $scope.plan="";
            $scope.Mrp ="";
            $scope.Discount ="";
            $scope.discountUnit ="";
            $('#Addplan').modal('show');
        } 
        // add plan
        $scope.addplan = function() {
            if($scope.Discount==""){
                swal("Required!", "Please Fill Discount!", "error");
               
            }else{
                var reqData = {
                    subcat_id:$scope.subCategoryId,
                    plans:$scope.plan,
                    mrp:$scope.Mrp,
                    discount:$scope.Discount,
                    discount_unit : $scope.discountUnit
                }
                $http.post("{{url('/')}}/add-update-plan",reqData).then(response =>{
                    $scope.getRequest();
                    $('#Addplan').modal('hide');
                }).catch(error => {
                    swal("Something went wrong!", "Contact to administrator!", "error");
                });
            }
            
        };
        // Open update modal
        $scope.update = function(data){
            $scope.updateData = data;
            $scope.subCategoryId = $scope.updateData.subcat_id;
            $scope.plan          = $scope.updateData.plans;
            $scope.Mrp           = $scope.updateData.mrp;
            $scope.Discount      = $scope.updateData.discount;
            $scope.discountUnit      = $scope.updateData.discount_unit;
            $('#updateModal').modal('show');
        }
        //update data
        $scope.updateplan = function() {
            if($scope.Discount==""){
                swal("Required!", "Please Fill Discount!", "error");
               
            }else{
                var reqData={
                    id:$scope.updateData.id,
                    subcat_id:$scope.subCategoryId,
                    plans:$scope.plan,
                    mrp:$scope.Mrp,
                    discount:$scope.Discount,
                    discount_unit:$scope.discountUnit,
                    foodee_price:$scope.FoodeePrice,
                }
                //console.log(reqData);
                $http.post("{{url('/')}}/add-update-plan",reqData).then(response =>{
                $scope.getRequest();
                $('#updateModal').modal('hide');
                }).catch(error => {
                    swal("Something went wrong!", "Contact to administrator!", "error");
                });
            }
        };
        // delete modal
        $scope.deleteModel = function(data){
			$scope.DeleteData = data;
			$('#deteteplan').modal('show');
		}
        // delete data
        $scope.deleteplan = function() {
            var reqData={
                id:$scope.DeleteData.id.toString(),
            }
            //console.log(reqData);
            $http.post("{{url('/')}}/delete-plan",reqData).then(response =>{
                $scope.getRequest();
                $('#deteteplan').modal('hide');
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
    });
</script>
@endsection