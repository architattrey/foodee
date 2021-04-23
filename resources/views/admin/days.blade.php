@extends('admin.layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="daysApp" ng-controller="daysController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Days Section</li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                <a style="margin-top: 5px; padding: 10px 17px; float: right;b margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Days</button></a>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
        <!-- view list of agents -->
        <!-- Main content -->
        <section class="content" >
            <table id="categories" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th width="10%">Days</th>
                        <th width="10%">Created At</th>
                        <th width="10%">Created At</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="day in dayData |filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{day.days}}</td>
                        <td>@{{day.created_at|limitTo:10}}</td>
                        <td>@{{day.updated_at|limitTo:10}}</td>
                        <td>
                            <button type="button" class="btn btn-success"><a href="" ng-click="update(day)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger"><a href=""  ng-click="deleteModal(day)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button> 
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- add model -->
        <div class="modal fade" id="AddDay" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Add Day</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- add day -->
                                <div class="form-group">
                                    <label for="">Add Day</label>
                                    <input type="text" class="form-control" ng-model="Day" placeholder ="Add Day"><br>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addday()">Success</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
        <!-- update model -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Update</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- add day -->
                                <div class="form-group">
                                    <label for="">Add Day</label>
                                    <input type="text" class="form-control" ng-model="Day" placeholder ="Add Day"><br>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updateday()">Update</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
        <!-- delete model -->
        <div class="modal fade" id="deteteDay" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Delete</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deleteday()">Delete</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
    </div>
@endsection
@section('script')
 

<script>
    var daysApp = angular.module("daysApp",[]);
    
    daysApp.controller("daysController",function($scope, $http) {
        // categories listing   
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);
        $scope.dayData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-days").then(response =>{
                $scope.dayData = response.data.data.days;
                
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();

        // add Day
        $scope.addOpen = function() {
            $scope.Day="";
            $('#AddDay').modal('show');
        }
        $scope.addday = function() {
            var reqData={
                days:$scope.Day,
            }
            $http.post("{{url('/')}}/add-update-day",reqData).then(response =>{
                $scope.getRequest();
                $('#AddDay').modal('hide');
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // update day
        $scope.update = function(data){
            $scope.updateData = data;
            $scope.Day  = $scope.updateData.days;
            $('#myModal').modal('show');
        }
        $scope.updateday = function() {
            var reqData={
                id:$scope.updateData.id,
                days:$scope.Day,  
            }
            $http.post("{{url('/')}}/add-update-day",reqData).then(response =>{
            $('#myModal').modal('hide');
            $scope.getRequest();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // delete category
        $scope.deleteModal = function(data){
			  $scope.updateData = data;
			 $('#deteteDay').modal('show');
		}
        $scope.deleteday = function() {
            var reqData={
                id:$scope.updateData.id.toString(),
            }
            $http.post("{{url('/')}}/delete-day",reqData).then(response =>{
                $scope.getRequest();
                $('#deteteDay').modal('hide');
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
    });
</script>
@endsection	
 
