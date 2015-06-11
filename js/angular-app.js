var app = angular.module('myApp', ['ngRoute']);
app.factory('Posts', function($resource){
	return $resource(wpAngularVars.base +'/posts/:id?_wp_json_nonce=' + wpAngularVars.nonce, {id: '@id'}, {
		update: {method: 'PUT'}
	});
});
/*app.factory("services", ['$http', function ($http) {
    var serviceBase = '/hello-world/';
    var obj = {};
    obj.getCustomers = function () {
        console.log(wpAngularVars.base);
        return $http.get(wpAngularVars.base + '/posts');
    }
    obj.getCustomer = function (customerID) {
        return $http.get(serviceBase + 'customer?id=' + customerID);
    }
    obj.insertCustomer = function (customer) {
        return $http.post(serviceBase + 'insertCustomer', customer).then(function (results) {
            return results;
        });
    };
    obj.updateCustomer = function (id, customer) {
        return $http.post(serviceBase + 'updateCustomer', {id: id, customer: customer}).then(function (status) {
            return status.data;
        });
    };
    obj.deleteCustomer = function (id) {
        return $http.delete(serviceBase + 'deleteCustomer?id=' + id).then(function (status) {
            return status.data;
        });
    };
    return obj;
}]);*/
app.controller('listCtrl', function ($scope, services) {
     $scope.message = 'This is Add new order screen';
    //services.getCustomers().then(function (data) {
    //    $scope.customers = data.data;
    //});
});
app.controller('editCtrl', function ($scope, $rootScope, $location, $routeParams, services, customer) {
    var customerID = ($routeParams.customerID) ? parseInt($routeParams.customerID) : 0;
    $rootScope.title = (customerID > 0) ? 'Edit Customer' : 'Add Customer';
    $scope.buttonText = (customerID > 0) ? 'Update Customer' : 'Add New Customer';
    var original = customer.data;
    original._id = customerID;
    $scope.customer = angular.copy(original);
    $scope.customer._id = customerID;
    $scope.isClean = function () {
        return angular.equals(original, $scope.customer);
    }
    $scope.deleteCustomer = function (customer) {
        $location.path('/');
        if (confirm("Are you sure to delete customer number: " + $scope.customer._id) == true) {
            services.deleteCustomer(customer.customerNumber);
        }
    };
    $scope.saveCustomer = function (customer) {
        $location.path('/');
        if (customerID <= 0) {
            services.insertCustomer(customer);
        }
        else {
            services.updateCustomer(customerID, customer);
        }
    };
});
app.config(['$routeProvider',
    function ($routeProvider, $locationProvider) {
        $routeProvider.
            when('/hello-world/', {
                title: 'Customers',
                templateUrl: '/wp-content/plugins/wfc-rjs-loads/templates/customers.html',
                controller: 'listCtrl'
            })
            .when('/edit-customer/:customerID', {
                title: 'Edit Customers',
                templateUrl: '/wp-content/plugins/wfc-rjs-loads/templates/edit-customer.html',
                controller: 'editCtrl',
                resolve: {
                    customer: function (services, $route) {
                        var customerID = $route.current.params.customerID;
                        return services.getCustomer(customerID);
                    }
                }
            });
        $locationProvider.html5Mode(true);
            /*.otherwise({
                redirectTo: '/'
            });*/
    }]);
app.run(['$location', '$rootScope', function ($location, $rootScope) {
    $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
        $rootScope.title = current.$$route.title;
    });
}]);