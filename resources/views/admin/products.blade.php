@extends('admin.layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="productApp" ng-controller="productController">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Products</li>
        </ol>
    </section>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
            <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                <a style="margin-top: 5px; padding: 10px 17px; float: right;margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Products</button></a>
            </div>
        </div>
    </div>
    <div class="row">
    </div>
    <!-- view list of agents -->
    <!-- Main content -->
    <section class="content">
        <table id="categories" datatable="ng" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sub category</th>
                    <th>Products</th>
                    <th>Days</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody ng-repeat="product in ProductData | filter:search">
                <tr>
                    <td>@{{$index+1}}</td>
                    <td>@{{product.sub_cat_products.sub_cat_name}}</td>
                    <td>@{{product.products}}</td>
                    <td>@{{product.days}}</td>
                    <td>@{{product.created_at|limitTo:10}}</td>
                    <td>@{{product.updated_at|limitTo:10}}</td>
                    <td>
                        <button type=" button" class="btn btn-success"><a href="" ng-click="updateModal(product)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-danger"><a href="" ng-click="deleteModal(product)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    <!-- /.content -->
    <!-- add product modal -->
    <div class="modal fade" id="AddProduct" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="product_content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Do you want add product</h4>
                </div>
                <div class="modal-body">
                    <!-- row strat -->
                    <div class="row">
                        <!-- column 6 -->
                        <div class="col-sm-6">
                            <!-- category id -->
                            <div class="form-group">
                                <label for="sub_category">Select Sub Category</label>
                                <select ng-model="subcatId" class="form-control">
                                    <option value="" label="Please Select Sub Category"></option>
                                    <option ng-repeat="subcategory in subcategoryData" value="@{{subcategory.id}}">
                                        @{{subcategory.sub_cat_name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!--/column 6  -->
                        <!--column 6  -->
                        <div class="col-sm-6">
                            <!-- select Day -->
                            <div class="form-group">
                                <label for="day">Select Day</label>
                                <select ng-model="day" class="form-control">
                                    <option value="" label="Please Select Day"></option>
                                    <option ng-repeat="day in dayData" value="@{{day.days}}">
                                        @{{day.days}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!--/column 6  -->
                    
                        <div class="col-sm-12">
                            <!-- Product name  -->
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control" ng-model="product" placeholder="Enter Product Name">
                            </div>
                        </div>
                    </div>
                    <!--/ row end -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" ng-click="addproduct()">Submit</button>
                    {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- update product modal -->
    <div class="modal fade" id="UpdateProduct" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" id="product_content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Do you want update product</h4>
                </div>
                <div class="modal-body">
                    <!-- row strat -->
                    <div class="row">
                        <!-- column 6 -->
                        <div class="col-sm-6">
                            <!-- category id -->
                            <div class="form-group">
                                <label for="sub_category">Select Sub Category</label>
                                <select ng-model="subcatId" class="form-control">
                                    <option value="" label="Please Select Sub Category"></option>
                                    <option ng-repeat="subcategory in subcategoryData" value="@{{subcategory.id}}">
                                        @{{subcategory.sub_cat_name}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!--/column 6  -->
                        <!--column 6  -->
                        <div class="col-sm-6">
                            <!-- select Day -->
                            <div class="form-group">
                                <label for="day">Select Day</label>
                                <select ng-model="day" class="form-control">
                                    <option value="" label="Please Select Day"></option>
                                    <option ng-repeat="day in dayData" value="@{{day.days}}">
                                        @{{day.days}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!--/column 6  -->
                       
                        <div class="col-sm-12">
                            <!-- Product name  -->
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control" ng-model="product" placeholder="Enter Product Name">
                            </div>
                        </div>
                    </div>
                    <!--/ row end -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" ng-click="updateproduct()">update</button>
                    {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!--/ update Modal  -->
    <!--delete Modal  -->
    <div class="modal fade" id="deteteProduct" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Do you want to Delete</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" ng-click="deleteProduct()">Delete</button>
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
    var productApp = angular.module("productApp", []);
    productApp.controller("productController", function ($scope, $http) {
        //products Listing
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);

        // .directive('stringToNumber', function() {
        //     return {
        //         require: 'ngModel',
        //         link: function($scope, $element, $attrs, $ngModel) {
        //         $ngModel.$parsers.push(function(value) {
        //             return '' + value;
        //         });
        //         $ngModel.$formatters.push(function(value) {
        //             return parseFloat(value);
        //         });
        //         }
        //     };
        // });
        //all products
        $scope.ProductData = [];
        $scope.getProducts = function () {
            $http.get("{{url('/')}}/get-products").then(response => {
                $scope.ProductData = response.data.data.products;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getProducts();

        // get sub cat for dropdown
        $scope.subcategoryData = [];
        $scope.getsubcat = function() {
            $http.get("{{url('/')}}/get-subcategory").then(response =>{
                $scope.subcategoryData = response.data.data.subcategory;
                $scope.imageUrl = response.data.base_url;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getsubcat();
        //get days for dropdown
        $scope.dayData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-days").then(response =>{
                $scope.dayData = response.data.data.days;
                
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();

        
        // open add product modal
        $scope.addOpen = function () {
            
            $scope.subcatId = "";
            $scope.day = "";
            $scope.product = "";
            $('#AddProduct').modal('show');
        }
        // add product
        $scope.addproduct = function () {
            var reqData = {
                subcat_id: $scope.subcatId,
                days: $scope.day,
                products: $scope.product,
            }
            $http.post("{{url('/')}}/add-update-product", reqData).then(response => {
                $scope.getProducts();
                $('#AddProduct').modal('hide');

            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // Open update modal
        $scope.updateModal = function (data) {
            $scope.updateData = data;
            $scope.subcatId = $scope.updateData.subcat_id;
            $scope.day = $scope.updateData.days;
            $scope.product = $scope.updateData.products;
            $('#UpdateProduct').modal('show');
        }
        //update data
        $scope.updateproduct = function () {
            var reqData = {
                id: $scope.updateData.id,
                subcat_id: $scope.subcatId,
                days: $scope.day,
                products: $scope.product,  
            }
            $http.post("{{url('/')}}/add-update-product", reqData).then(response => {
                $scope.getProducts();
                $('#UpdateProduct').modal('hide');
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // delete modal
        $scope.deleteModal = function (data) {
            $scope.DeleteData = data;
            $('#deteteProduct').modal('show');
        }
        // delete data
        $scope.deleteProduct = function () {
            var reqData = {
                id: $scope.DeleteData.id.toString(),
            }
            console.log(reqData);
            $http.post("{{url('/')}}/delete-product", reqData).then(response => {
                $scope.getProducts();
                $('#deteteProduct').modal('hide');
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
    });        
</script>
@endsection