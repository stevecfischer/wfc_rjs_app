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
app.config(function ($routeProvider, $locationProvider, datepickerConfig, datepickerPopupConfig) {
    datepickerConfig.showWeeks = false;
    datepickerPopupConfig.toggleWeeksText = null;
    datepickerPopupConfig.showButtonBar = false;

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
                if ($routeParams.type == "rjs_loads") {
                    return wfcLocalized.template_directory.favorite_loads_posts;
                }else{
                    return wfcLocalized.template_directory.favorite_trucks_posts;
                }
            },
            controller: 'FavoriteCtrl'
        });
    $locationProvider.html5Mode(true);
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
        console.log(input);
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
            if (input.wfc_rjs_loads_to_hazmat == "Yes") {
                result.push("Hazmat");
            }
            if (input.wfc_rjs_loads_to_team == "Yes") {
                result.push("Team");
            }
            if (input.wfc_rjs_loads_to_expedited == "Yes") {
                result.push("Expedited");
            }
            if (input.wfc_rjs_loads_to_tarp == "Yes") {
                result.push("Tarp");
            }
            if (input.wfc_rjs_loads_to_pallet_exchange == "Yes") {
                result.push("Pallet Exchange");
            }
            input = result.join(', ');
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
