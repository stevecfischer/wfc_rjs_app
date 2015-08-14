// Define the module for our AngularJS application.
var app = angular.module("Rjs", ['ngRoute', 'ui.bootstrap', 'smart-table', 'ngResource'], function ($httpProvider) {
    // Use x-www-form-urlencoded Content-Type
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    /**
     * The workhorse; converts an object to x-www-form-urlencoded serialization.
     * @param {Object} obj
     * @return {String}
     */
    var param = function (obj) {
        var query = '', name, value, fullSubName, subName, subValue, innerObj, i;
        for (name in obj) {
            value = obj[name];
            if (value instanceof Array) {
                for (i = 0; i < value.length; ++i) {
                    subValue = value[i];
                    fullSubName = name + '[' + i + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if (value instanceof Object) {
                for (subName in value) {
                    subValue = value[subName];
                    fullSubName = name + '[' + subName + ']';
                    innerObj = {};
                    innerObj[fullSubName] = subValue;
                    query += param(innerObj) + '&';
                }
            }
            else if (value !== undefined && value !== null) {
                query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
            }
        }
        return query.length ? query.substr(0, query.length - 1) : query;
    };
    // Override $http service's default transformRequest
    $httpProvider.defaults.transformRequest = [function (data) {
        return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
    }];
});
// -------------------------------------------------- //
// Clear browser cache (in development mode)
//
// http://stackoverflow.com/questions/14718826/angularjs-disable-partial-caching-on-dev-machine
// -------------------------------------------------- //
//app.run(function ($rootScope, $templateCache) {
//    $rootScope.$on('$viewContentLoaded', function () {
//        $templateCache.removeAll();
//    });
//});
// -------------------------------------------------- //
// setup routes
// -------------------------------------------------- //
app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
        .when('/manage-posts/', {
            templateUrl: function ($routeParams) {
                if ($routeParams.type == "rjs_loads") {
                    return wfcLocalized.template_directory.rjs_loads;
                } else {
                    return wfcLocalized.template_directory.rjs_trucks;
                }
            },
            controller: 'TruckController'
        })
        .when('/archive-posts/', {
            templateUrl: function ($routeParams) {
                if ($routeParams.type == "rjs_loads") {
                    return wfcLocalized.template_directory.rjs_loads;
                } else {
                    return wfcLocalized.template_directory.rjs_trucks;
                }
            },
            controller: 'TruckController'
        })
        .when('/favorite-posts/', {
            templateUrl: function ($routeParams) {
                return wfcLocalized.template_directory.favorite_posts;
            },
            controller: 'FavoriteCtrl'
        });
    $locationProvider.html5Mode(true);
});
// -------------------------------------------------- //
//  setup controllers
// -------------------------------------------------- //
app.controller('PostList', function ($scope, $routeParams, $location, postsFactory, postFactory, $modal, $log) {
    ////////////////////////////////////////////
    ////////////////////////////////////////////
    ////////////////////////////////////////////
    /* callback for ng-click 'deletePost': */
    $scope.deletePost = function (ID) {
    }
    /* callback for ng-click 'editTruck': */
    $scope.editTruck = function (ID) {
        var editTruckID = ID;
        var truck = postFactory.get({id: ID}, function () {
            //console.log($scope.truck);
        });
        $scope.truck = truck;
        $modal.open({
            templateUrl: 'rjsTruckForm.html',
            backdrop: true,
            windowClass: 'modal',
            controller: function ($scope, $modalInstance, $log, truck, $http) {
                $scope.truck = truck;
                $scope.submitEditTruck = function () {
                    var data = {
                        action: 'rjs_edit_post',
                        postid: editTruckID,
                        postdata: $scope.truck.rjsmeta
                    };
                    $http({
                        method: 'POST',
                        url: wfcLocalized.ajax_url + "?_wp_json_nonce=" + wfcLocalized.nonce,
                        data: data,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    });
                    $log.log('Submitting user info.');
                    $modalInstance.dismiss('cancel');
                }
                $scope.cancel = function () {
                    $modalInstance.dismiss('cancel');
                };
            },
            resolve: {
                truck: function () {
                    return $scope.truck;
                }
            }
        });
    };
    $scope.newTruck = function () {
        $modal.open({
            templateUrl: 'rjsTruckForm.html',
            backdrop: true,
            windowClass: 'modal',
            controller: function ($scope, $modalInstance, truck, $log, $http) {
                $scope.truck = {};
                $scope.submitEditTruck = function () {
                    var data = {
                        action: 'rjs_new_post',
                        postdata: $scope.truck.rjsmeta,
                        posttype: $routeParams.type
                    };
                    $http({
                        method: 'POST',
                        url: wfcLocalized.ajax_url + "?_wp_json_nonce=" + wfcLocalized.nonce,
                        data: data,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    });
                    $log.log('Creating a new truck');
                    $modalInstance.dismiss('cancel');
                }
                $scope.cancel = function () {
                    $modalInstance.dismiss('cancel');
                };
            },
            resolve: {
                truck: function () {
                    return $scope.truck;
                }
            }
        });
    };
    //////////////////////////////////////////////
    //////////////////////////////////////////////
    //////////////////////////////////////////////
    //////////////////////////////////////////////
    // ---------
    //   get init collection
    // ---------
    $scope.init = function () {
        if ($routeParams.status == "archive") {
            $routeParams.status = "<=";
        } else {
            $routeParams.status = ">=";
        }
        var loadss = postsFactory.query({type: $routeParams.type, status: $routeParams.status}, function () {
            //console.log(loadss);
        });
        $scope.loads = loadss;
        $scope.displayedCollection = [].concat($scope.loads);
        $scope.rjsposttype = $routeParams.type;
    }
    $scope.init();
});
// -------------------------------------------------- //
// setup factories
// -------------------------------------------------- //
app.factory('postsFactory', function ($resource) {
    //return $resource("/cms-wfc/wp-json/posts/?type=:type&filter[meta_query][key]=wfc_rjs_loads_pickup_date&filter[meta_query][value]=" + wfcLocalized.today_date + "&filter[meta_query][compare]=:status");
    return $resource("/cms-wfc/wp-json/posts/?type=:type");
});
app.factory('postFactory', function ($resource) {
    return $resource("/cms-wfc/wp-json/posts/:id?_wp_json_nonce=" + wfcLocalized.nonce);
});
// -------------------------------------------------- //
// setup filters
// -------------------------------------------------- //
app.filter('scfDateFormatter', function () {
    return function (input) {
        if (angular.isDefined(input)) {
            if (input.length >= 10) {
                input = input.slice(5, 6) + input.slice(6, 10) + "-" + input.slice(0, 4);
            }
        }
        return input;
    }
});
app.filter('scfTrailerOptionsConcat', function () {
    return function (input) {
        if (angular.isDefined(input)) {
            var result = [];
            if (input.wfc_rjs_trucks_to_hazmat == "Yes") {
                result.push("Hazmat");
            }
            if (input.wfc_rjs_trucks_to_team == "Yes") {
                result.push("Team");
            }
            if (input.wfc_rjs_trucks_to_expedited == "Yes") {
                result.push("Expedited");
            }
            if (input.wfc_rjs_trucks_to_tarp == "Yes") {
                result.push("Tarp");
            }
            if (input.wfc_rjs_trucks_to_pallet_exchange == "Yes") {
                result.push("Pallet Exchange");
            }
            input = result;
        }
        return input;
    }
});
// -------------------------------------------------- //
// -------------------------------------------------- //
app.filter('scfArrToStr', function () {
    return function (input) {
        if (angular.isDefined(input)) {
            var _str = '';
            for (var key in input[0]) {
                if (input.hasOwnProperty(key)) {
                    _str += input[key];
                }
            }
        }
        return input;
    }
});
// -------------------------------------------------- //
// setup directives
// -------------------------------------------------- //
app.directive('pageSelect', function () {
    return {
        restrict: 'E',
        template: '<input type="text" class="select-page" ng-model="inputPage" ng-change="selectPage(inputPage)">',
        link: function (scope, element, attrs) {
            scope.$watch('currentPage', function (c) {
                scope.inputPage = c;
            });
        }
    }
});
/*
 app.controller('ModalDemoCtrl', function ($scope, $modal, $log) {
 $scope.user = {
 user: 'name',
 password: 'null'
 };
 $scope.open = function () {
 $modal.open({
 templateUrl: 'myModalContent.html',
 backdrop: true,
 windowClass: 'modal',
 controller: function ($scope, $modalInstance, $log, user) {
 $scope.user = user;
 $scope.submit = function () {
 $log.log('Submiting user info.');
 $log.log(user);
 $modalInstance.dismiss('cancel');
 }
 $scope.cancel = function () {
 $modalInstance.dismiss('cancel');
 };
 },
 resolve: {
 user: function () {
 return $scope.user;
 }
 }
 });
 };
 });
 */
//test
//app.factory('bulktrucks', function () {
//    var bulktrucks = {};
//    bulktrucks.list = [];
//    bulktrucks.add = function (singletruck) {
//        bulktrucks.list.push({singletruck});
//    };
//    return bulktrucks;
//});
//app.controller('ListCtrl', function (bulktrucks) {
//    var self = this;
//    self.bulktrucks = bulktrucks.list;
//});
//app.controller('PostCtrl', function (bulktrucks) {
//    var self = this;
//
//    self.addSingletruck = function (singletruck) {
//        bulktrucks.add(singletruck);
//        singletruck.wfc_rjs_loads_origin_state = "";
//    };
//});
