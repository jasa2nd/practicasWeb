@extends('layouts.master')
@section('title', 'New Professor')

@section('content')
<script type="text/javascript">
    var app = angular.module('ProfessorAddModule', []);
    app.controller('ProfessorAddController', ($scope, $http) => {
        $scope.professor = {};

        $scope.addProfessor = () => {
            $http.post('/ajaxprofessors', $scope.professor).then((result) => {
                console.log(result);
            })
        }
    })
</script>
<div class="container pl-5 pr-5" ng-app="ProfessorAddModule" ng-controller="ProfessorAddController">
    <h2>{{ $pagetitle }}</h2>
    <p>
        @{{ professor.firstName }}
    </p>
    <form action="/professors" method="POST">
        @csrf
        <div class="form-group">
            <label for="txtFirstName">First name</label>
            <input type="text" class="form-control" id="txtFirstName" name="firstName" ng-model="professor.firstName" />
        </div>
        <div class="form-group">
            <label for="txtLastName">Last name</label>
            <input type="text" class="form-control" id="txtLastName" name="lastName" ng-model="professor.lastName" />
        </div>
        <div class="form-group">
            <label for="txtCity">City</label>
            <input type="text" class="form-control" id="txtCity" name="city" ng-model="professor.city" />
        </div>
        <div class="form-group">
            <label for="txtAddress">City</label>
            <input type="text" class="form-control" id="txtAddress" name="address" ng-model="professor.address" />
        </div>
        <div class="form-group">
            <label for="txtSalary">Salary</label>
            <input type="text" class="form-control" id="txtSalary" name="salary" ng-model="professor.salary" />
        </div>
        <input type="button" value="Send" class="btn btn-dark" ng-click="addProfessor()" />
        <a href="/professors" class="btn btn-dark">Back</a>
    </form>
</div>
@stop