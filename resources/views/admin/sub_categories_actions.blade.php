@extends('admin.layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="subcategoryApp" ng-controller="subcategoryController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sub Category Section</li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                <a style="margin-top: 5px; padding: 10px 17px; float: right;b margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Sub Category</button></a>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
        <!-- view list of agents -->
        <!-- Main content -->
        <section class="content" >
            <table id="categories"  datatable="ng" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th  width="2%">#</th>
                        <th  width="10%">Sub Category</th>
                        <th  width="10%">Image</th>
                        <!-- <th  width="10%">MRP</th>
                        <th  width="10%">Foodee Price</th> -->
                        <th  width="30%">Description</th>
                        <th  width="10%">Created At</th>
                        <th  width="10%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="subcategory in subcategoryData |filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{subcategory.sub_cat_name}}</td>
                        <td><img src ="@{{baseUrl}}@{{subcategory.image}}" style="width:100%;"></td>
                        <!-- <td>@{{subcategory.mrp}}</td>
                        <td>@{{subcategory.foodee_price}}</td> -->
                        <td><textarea class="form-control" rows="3" disabled>@{{subcategory.description}}</textarea></td>
                        <td>@{{subcategory.created_at|limitTo:10}}</td>
                        <td>
                            <button type="button" class="btn btn-success"><a href="" ng-click="update(subcategory)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger"><a href=""  ng-click="deleteModel(subcategory)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button> 
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- add subcategory modal -->
        <div class="modal fade" id="Addsubcategory" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Add Sub Category</h4>
                    </div>
                    <div class="modal-body">
                        <!-- row start -->
                        <div class="row">
                            <!-- col start -->
                            <div class= "col-sm-6">
                                <!-- add cateegory  -->
                                <div class="form-group">
                                    <label for="">Select Category</label>
                                    <select ng-model = "CategoryId" class="form-control">
                                        <option value = "" label = "Please Select Category"></option>
                                        <option ng-repeat ="category in categoryData" value="@{{category.id}}">
                                            @{{category.categories}}
                                        </option>
                                    </select>
                                </div>    
                                <!-- add mrp -->
                                <!-- <div class="form-group">
                                    <label for="">Add MRP</label>    
                                    <input type="number" ng-model="Mrp" class="form-control"><br>
                                </div> -->
                                <!-- image -->
                                <div class="form-group">
                                    <label for="">Sub Category Image</label>
                                    <input type="file" class="form-control" id="subcategory_image" accept="image/*"onchange="angular.element(this).scope().uploadedFile(this)"placeholder="Select  Sub Category Image" /><br>
                                </div>
                                <!-- show image -->
                                <img ng-src="@{{baseUrl}}@{{subcategoryImage}}" style="width:164px; height:146px;"/>
                            </div>
                            <!-- col start -->
                            <div class= "col-sm-6">
                                <!-- add sub category -->
                                <div class="form-group">
                                    <label for="">Add  Sub Category</label>    
                                    <input type="text" ng-model="subcategory" class="form-control"> 
                                </div>
                                <!-- add mrp -->
                                <!-- <div class="form-group">
                                    <label for="">Add Foodee Price</label>    
                                    <input type="number" ng-model="FoodeePrice" class="form-control">
                                </div> -->
                                <!-- description-->
                                <div class="form-group">
                                    <label for="">Add Description</label>
                                    <textarea class="form-control" rows="5" ng-model="Description" placeholder="Add Description"></textarea>
                                </div>
                            </div>
                            <!--/ col end -->
                        </div>
                        <!--/ row end -->     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addsubcategory()">Submit</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!--/add subcategory modal -->
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
                                <!-- add cateegory  -->
                                <div class="form-group">
                                    <label for="">Select Category</label>
                                    <select ng-model = "CategoryId" class="form-control">
                                        <option value = "" label = "Please Select Category"></option>
                                        <option ng-repeat ="category in categoryData" value="@{{category.id}}">
                                            @{{category.categories}}
                                        </option>
                                    </select>
                                </div>    
                                <!-- add mrp -->
                                <!-- <div class="form-group">
                                    <label for="">Add MRP</label>    
                                    <input type="text" ng-model="Mrp" class="form-control"><br>
                                </div> -->
                                <!-- image -->
                                <div class="form-group">
                                    <label for="">Sub Category Image</label>
                                    <input type="file" class="form-control" id="subcategory_image" accept="image/*"onchange="angular.element(this).scope().uploadedFile(this)"placeholder="Select  Sub Category Image" /><br>
                                </div>
                                <!-- show image -->
                                <img ng-src="@{{baseUrl}}@{{subcategoryImage}}" style="width:164px; height:146px;"/>
                            </div>
                            <!-- col start -->
                            <div class= "col-sm-6">
                                <!-- add sub category -->
                                <div class="form-group">
                                    <label for="">Add  Sub Category</label>    
                                    <input type="text" ng-model="subcategory" class="form-control">
                                </div>
                                <!-- add mrp -->
                                <!-- <div class="form-group">
                                    <label for="">Add Foodee Price</label>    
                                    <input type="text" ng-model="FoodeePrice" class="form-control">
                                </div> -->
                                <!-- description-->
                                <div class="form-group">
                                    <label for="">Add Description</label>
                                    <textarea class="form-control" rows="5" ng-model="Description" placeholder="Add Description"></textarea>
                                </div>
                            </div>
                            <!--/ col end -->
                        </div>
                        <!--/ row end -->     
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updatesubcategory()">Update</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!--/ update Modal  -->
        <!--delete Modal  -->
        <div class="modal fade" id="detetesubcategory" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Delete</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deletesubcategory()">Delete</button>
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
    var subcategoryApp = angular.module("subcategoryApp",[]);
    subcategoryApp.controller("subcategoryController",function($scope, $http){
        //subcategory Listing
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);
        $scope.subcategoryData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-subcategory").then(response =>{
                $scope.subcategoryData = response.data.data.subcategory;
                $scope.baseUrl = response.data.base_url;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();

        // all categories for dropdown
        $scope.categoryData = [];
        $scope.getCategory = function() {
            $http.post("{{url('/')}}/get-categories").then(response =>{
                $scope.categoryData = response.data.data.categories;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getCategory();
        // open add subcategory modal
        $scope.addOpen = function() {
          
            $scope.CategoryId ="";
            $scope.subcategory="";
            // $scope.Mrp ="";
            // $scope.FoodeePrice ="";
            $scope.Description ="";
            $scope.subcategoryImage ="";
            $('#Addsubcategory').modal('show');
        } 
        // add subcategory
        $scope.addsubcategory = function() {
            var reqData = {
                cat_id:$scope.CategoryId,
                sub_cat_name:$scope.subcategory,
                image:$scope.subcategoryImage,
                // mrp:$scope.Mrp,
                // foodee_price:$scope.FoodeePrice,
                description:$scope.Description,
            }
            $http.post("{{url('/')}}/add-update-subcategory",reqData).then(response =>{
                $scope.getRequest();
                $('#Addsubcategory').modal('hide');

            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // Open update modal
        $scope.update = function(data){
            $scope.updateData = data;
            $scope.CategoryId = $scope.updateData.cat_id;
            $scope.subcategoryImage = $scope.updateData.image;
            $scope.subcategory = $scope.updateData.sub_cat_name;
            // $scope.Mrp         = $scope.updateData.mrp;
            // $scope.FoodeePrice = $scope.updateData.foodee_price;
            $scope.Description = $scope.updateData.description;
            $('#updateModal').modal('show');
        }
        //update data
        $scope.updatesubcategory = function() {
            var reqData={
                id:$scope.updateData.id,
                cat_id:$scope.CategoryId,
                sub_cat_name:$scope.subcategory,
                image:$scope.subcategoryImage,
                // mrp:$scope.Mrp,
                // foodee_price:$scope.FoodeePrice,
                description:$scope.Description,
            }
            //console.log(reqData);
            $http.post("{{url('/')}}/add-update-subcategory",reqData).then(response =>{
            $scope.getRequest();
            $('#updateModal').modal('hide');
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // delete modal
        $scope.deleteModel = function(data){
			$scope.DeleteData = data;
			$('#detetesubcategory').modal('show');
		}
        // delete data
        $scope.deletesubcategory = function() {
            var reqData={
                id:$scope.DeleteData.id.toString(),
            }
            //console.log(reqData);
            $http.post("{{url('/')}}/delete-subcategory",reqData).then(response =>{
                $scope.getRequest();
                $('#detetesubcategory').modal('hide');
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // upload image
        $scope.uploadFile = function (files) {
           //debugger;
            var file = files;
            var uploadUrl = "{{url('/')}}/subcategory-image-upload";
            var fd = new FormData();
            fd.append('subcategory_image', file);
            $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                headers: { 'Content-Type': undefined }
            })
            .then(res => {
                $scope.subcategoryImage = res.data.image_url;
                $scope.baseUrl = res.data.base_url;
            })
            .catch(err => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.uploadedFile = function(element) {
            $scope.currentFile = element.files[0];
            var reader = new FileReader();
            reader.onload = function(event) {
                $scope.subcategoryImage = event.target.result
                $scope.$apply(function($scope) {
                    $scope.files = event.target.result;
                    $scope.uploadFile(event.target.result);
                });
            }
            reader.readAsDataURL(element.files[0]);
        }
    });
</script>
@endsection