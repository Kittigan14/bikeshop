@extends('layouts.master')
@section('title') BikeShop | อุปกรณ์จักรยาน, อะไหล่, ชุดเเข่ง และอุปกรณ์ตกเเต่ง @endsection
@section('content')

<div class="row" ng-app="app" ng-controller="ctrl">
    <div class="col-md-3">
        <h1 style="margin: 0 0 30px 0;">สินค้าในร้าน</h1>
        <div class="list-group">
            <a href="#" class="list-group-item" ng-click="getProductList(null)"
                ng-class="{'active': category == null}">ทั้งหมด</a>

            <a href="#" class="list-group-item" ng-repeat="c in categories" ng-click="getProductList(c.id)"
                ng-class="{'active': category == c.id}">@{c.name}</a>
        </div>
    </div>

    <div class="col-md-9">
        <div class="pull-center" style="margin: 0 0 36px 0;">
            <input type="text" class="form-control" ng-model="query"
                ng-keyup="searchProduct($event)" placeholder="ค้นหา">
            <center>
                <h3 ng-if="!products.length" style="margin-top: 50px">ไม่พบข้อมูลสินค้า</h3>
            </center>
        </div>

        <div class="row">
            <div class="col-md-3" ng-repeat="p in products">
                {{-- Product Card --}}
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img ng-src="@{p.image_url}" class="img-responsive">
                        <h4><a href="#">@{ p.name }</a></h4>

                        <div class="form-group">
                            <div>คงเหลือ: @{p.stock_qty}</div>
                            <div>ราคา <strong>@{p.price}</strong> บาท</div>
                        </div>

                        <a href="#" class="btn btn-success btn-block">
                            <i class="fa fa-shopping-cart"></i> หยิบใส่ตะกร้า
                        </a>
                    </div>
                </div>
                {{-- End Product Card --}}
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    var app = angular.module('app', []).config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('@{').endSymbol('}');
    });

    app.service('productService', function ($http) {

        this.getProductList = function (category_id = null) {
            if (category_id) return $http.get('/api/product/' + category_id);
            return $http.get('/api/product');
        };

        this.getCategoryList = function () {
            return $http.get('/api/category');
        };

        this.searchProduct = function (query) {
            return $http.post('/api/product/search', {
                query: query
            });
        };

    });

    app.controller('ctrl', function ($scope, productService) {
        $scope.products = [];
        $scope.categories = [];
        $scope.category = null;

        $scope.getProductList = function (category_id = null) {
            $scope.category = category_id;
            productService.getProductList(category_id).then(function (res) {
                if (!res.data.ok) return;
                $scope.products = res.data.products;
            });
        };

        $scope.getCategoryList = function () {
            productService.getCategoryList().then(function (res) {
                if (!res.data.ok) return;
                $scope.categories = res.data.categories;
            });
        };

        $scope.searchProduct = function (e) {
            if (!$scope.query || $scope.query.trim() === "") {
                $scope.getProductList();
                return;
            }

            productService.searchProduct($scope.query).then(function (res) {
                if (!res.data.ok) return;
                $scope.products = res.data.products;
            });
        };


        $scope.getProductList();
        $scope.getCategoryList();
    });

</script>

@endsection
