/**
 * Controller for Trucks
 */
app.controller('TruckController', function ($scope, $routeParams, $location, truckService, $modal, $log, $filter, $timeout) {
    $scope.activePath = null;
    $scope.$on('$routeChangeSuccess', function () {
        $scope.activePath = $location.url();
        console.log($location.url());
    });
    $scope.loading = true;
    $scope.deletedTrucks = [];
    $scope.quicktruck = {};
    $scope.bulkDeleteSelection = [];
    $scope.usStates = angular.fromJson(wfcLocalized.us_states);
    $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
    $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
    if ($routeParams.type == "rjs_loads") {
        $scope.rjsposttype = "loads";
    } else {
        $scope.rjsposttype = "trucks";
    }
    // always represent the collection object
    $scope.trucks = [];
    $scope.rowCollection = [];
    $scope.truck = {};
    loadRemoteData();
    $scope.bulkDeleteSelected = {};
    $scope.checkAll = function () {
        if ($scope.selectedAll) {
            for (var i = 0; i < $scope.trucks.length; i++) {
                var item = $scope.trucks[i];
                $scope.bulkDeleteSelected[item.ID] = true;
            }
        } else {
            for (var i = 0; i < $scope.trucks.length; i++) {
                var item = $scope.trucks[i];
                $scope.bulkDeleteSelected[item.ID] = false;
            }
            console.log('false');
        }
    }
    $scope.createPost = function () {
        if ($scope.rjsposttype == "loads") {
            var dynamicTemplate = 'rjsLoadForm.html';
        } else {
            var dynamicTemplate = 'rjsTruckForm.html';
        }
        var modalInstance = $modal.open({
            templateUrl: dynamicTemplate,
            backdrop: 'static',
            size: 'lg wfc-modal-lg',
            windowClass: 'modal',
            controller: function ($scope, $modalInstance, $log, $http, loading) {
                $scope.usStates = angular.fromJson(wfcLocalized.us_states);
                $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
                $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
                $scope.submitEditTruck = function (isValid) {
                    if (isValid) {
                        $scope.loading = true;
                        //console.log($scope.truck);
                        truckService.createTruck($scope.truck)
                            .then(loadRemoteData);
                        $modalInstance.dismiss($scope.loading);
                    }
                }
                $scope.cancel = function () {
                    $modalInstance.close();
                };
            },
            resolve: {
                loading: function () {
                    return $scope.loading;
                }
            }
        });
        modalInstance.result.then(function (n) {
            $scope.loading = n;
        }, function (n) {
            $scope.loading = n;
        });
    };
    $scope.quickTruckPost = function (isValid) {
        if (isValid) {
            $scope.loading = true;
            truckService.quickCreateTruck($scope.quicktruck)
                .then(loadRemoteData);
        }
    };
    $scope.editPost = function (postObj) {
        if ($scope.rjsposttype == "loads") {
            var dynamicTemplate = 'rjsLoadForm.html';
        } else {
            var dynamicTemplate = 'rjsTruckForm.html';
        }
        var modalInstance = $modal.open({
                    templateUrl: dynamicTemplate,
                    backdrop: 'static',
                    size: 'lg wfc-modal-lg',
                    windowClass: 'modal',
                    controller: function ($scope, $modalInstance, $log, $http, $filter, loading) {
                        $scope.usStates = angular.fromJson(wfcLocalized.us_states);
                        $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
                        $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
                        $scope.loading = true;
                        $scope.truck = postObj;
                        $scope.truck.rjsmeta.wfc_rjs_trucks_pickup_date = new Date($scope.truck.rjsmeta.wfc_rjs_trucks_pickup_date);
                        $scope.selection = $scope.truck.rjsmeta.wfc_rjs_trucks_trailer_options;
                        $scope.submitEditTruck = function () {
                            truckService.editTruck($scope.truck)
                                .then(loadRemoteData);
                            $modalInstance.dismiss($scope.loading);
                        };
                        $scope.cancel = function () {
                            $modalInstance.close();
                        };
                    },
                    resolve: {
                        loading: function () {
                            return $scope.loading;
                        }
                    }
                }
            )
            ;
        modalInstance.result.then(function (n) {
            $scope.loading = n;
        }, function (n) {
            $scope.loading = n;
        });
    };
    $scope.deletePost = function (ID) {
        $scope.loading = true;
        truckService.deleteTruck(ID)
            .then(loadRemoteData);
    };
    ///////////////////////
    //// BULK POSTINGS SECTION
    ////
    ///////
    $scope.openBulkModal = function () {
        if ($scope.rjsposttype == "loads") {
            var dynamicTemplate = 'rjsBulkLoadForm.html';
        } else {
            var dynamicTemplate = 'rjsBulkForm.html';
        }
        var modalInstance = $modal.open({
            templateUrl: dynamicTemplate,
            backdrop: 'static',
            windowClass: 'modal',
            size: 'lg wfc-modal-lg',
            resolve: {
                loading: function () {
                    return $scope.loading;
                }
            },
            controller: function ($scope, $modalInstance, $log, $http, $filter, loading) {
                $scope.usStates = angular.fromJson(wfcLocalized.us_states);
                $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
                $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
                $scope.loading = true;
                $scope.bulkTrucks = [];
                //$scope.bulksingletruckformdata = {
                //    wfc_rjs_trucks_pickup_date: new Date(Date.now())
                //};
                $scope.addSingletruck = function (isValid) {
                    if (isValid) {
                        singleTruckObj = angular.copy($scope.bulksingletruckformdata);
                        $scope.bulkTrucks.push(singleTruckObj);
                        //$scope.bulksingletruckformdata = '';
                    }
                };
                $scope.removeSingletruck = function (index) {
                    $scope.bulkTrucks.splice(index, 1);
                };
                $scope.submitBulkTruck = function () {
                    truckService.createTrucks($scope.bulkTrucks)
                        .then(loadRemoteData);
                    $modalInstance.dismiss($scope.loading);
                }
                $scope.cancel = function () {
                    $modalInstance.close();
                };
            }
        });
        //@sftodo: what does this do?
        modalInstance.result.then(function (n) {
            $scope.loading = n;
        }, function (n) {
            $scope.loading = n;
        });
    };
    $scope.bulkDeleteTrucks = function () {
        $scope.loading = true;
        angular.forEach($scope.bulkDeleteSelected, function (value, key) {
            if (value) {
                $scope.deletePost(key);
            }
        });
        $scope.selectedAll = false;
    };
    // ---
    // PRIVATE METHODS.
    // ---
    // I apply the remote data to the local scope.
    // basically this refreshes the model object after changes are made e.g. update, delete, create
    function applyRemoteData(p) {
        angular.forEach(p, function (value, key) {
            ///HAAAAAACK TO HELL
            // @sftodo fix this shit its embarrassing
            var result = [];
            if (value.rjsmeta.wfc_rjs_trucks_to_hazmat == "Yes") {
                result.push("Hazmat");
            }
            if (value.rjsmeta.wfc_rjs_trucks_to_team == "Yes") {
                result.push("Team");
            }
            if (value.rjsmeta.wfc_rjs_trucks_to_expedited == "Yes") {
                result.push("Expedited");
            }
            if (value.rjsmeta.wfc_rjs_trucks_to_tarp == "Yes") {
                result.push("Tarp");
            }
            if (value.rjsmeta.wfc_rjs_trucks_to_pallet_exchange == "Yes") {
                result.push("Pallet Exchange");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_hazmat == "Yes") {
                result.push("Hazmat");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_team == "Yes") {
                result.push("Team");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_expedited == "Yes") {
                result.push("Expedited");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_tarp == "Yes") {
                result.push("Tarp");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_pallet_exchange == "Yes") {
                result.push("Pallet Exchange");
            }
            value.rjsmeta.trailerOptions = result;
        });
        //$scope.trucks = p;
        $scope.rowCollection = p;
//        $scope.trucks = [].concat($scope.rowCollection);
    }

    function loadRemoteData() {
        // returns a promise.
        truckService.getTrucks()
            .then(
            function (p) {
                $timeout(function () {
                    $scope.loading = false;
                    applyRemoteData(p);
                }, 1000);
            }
        );
    }
});
/**
 * Controller for Favorite posts (loads or trucks)
 */
app.controller('FavoriteCtrl', function ($scope, $routeParams, $location, truckService, $modal, $log, $filter, $timeout) {
    $scope.activePath = null;
    $scope.$on('$routeChangeSuccess', function () {
        $scope.activePath = $location.url();
        console.log($location.url());
    });
    $scope.loading = true;
    $scope.deletedTrucks = [];
    $scope.quicktruck = {};
    $scope.bulkDeleteSelection = [];
    $scope.usStates = angular.fromJson(wfcLocalized.us_states);
    $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
    $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
    if ($routeParams.type == "rjs_loads") {
        $scope.rjsposttype = "loads";
    } else {
        $scope.rjsposttype = "trucks";
    }
    // always represent the collection object
    $scope.trucks = [];
    $scope.rowCollection = [];
    $scope.truck = {};
    loadRemoteData();
    $scope.bulkDeleteSelected = {};
    $scope.checkAll = function () {
        if ($scope.selectedAll) {
            for (var i = 0; i < $scope.trucks.length; i++) {
                var item = $scope.trucks[i];
                $scope.bulkDeleteSelected[item.ID] = true;
            }
        } else {
            for (var i = 0; i < $scope.trucks.length; i++) {
                var item = $scope.trucks[i];
                $scope.bulkDeleteSelected[item.ID] = false;
            }
            console.log('false');
        }
    }
    $scope.createPost = function () {
        if ($scope.rjsposttype == "loads") {
            var dynamicTemplate = 'rjsLoadForm.html';
        } else {
            var dynamicTemplate = 'rjsTruckForm.html';
        }
        var modalInstance = $modal.open({
            templateUrl: dynamicTemplate,
            backdrop: 'static',
            size: 'lg wfc-modal-lg',
            windowClass: 'modal',
            controller: function ($scope, $modalInstance, $log, $http, loading) {
                $scope.usStates = angular.fromJson(wfcLocalized.us_states);
                $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
                $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
                $scope.submitEditTruck = function (isValid) {
                    if (isValid) {
                        $scope.loading = true;
                        //console.log($scope.truck);
                        truckService.createTruck($scope.truck)
                            .then(loadRemoteData);
                        $modalInstance.dismiss($scope.loading);
                    }
                }
                $scope.cancel = function () {
                    $modalInstance.close();
                };
            },
            resolve: {
                loading: function () {
                    return $scope.loading;
                }
            }
        });
        modalInstance.result.then(function (n) {
            $scope.loading = n;
        }, function (n) {
            $scope.loading = n;
        });
    };
    $scope.quickTruckPost = function (isValid) {
        if (isValid) {
            $scope.loading = true;
            truckService.quickCreateTruck($scope.quicktruck)
                .then(loadRemoteData);
        }
    };
    $scope.editPost = function (postObj) {
        if ($scope.rjsposttype == "loads") {
            var dynamicTemplate = 'rjsLoadForm.html';
        } else {
            var dynamicTemplate = 'rjsTruckForm.html';
        }
        var modalInstance = $modal.open({
                    templateUrl: dynamicTemplate,
                    backdrop: 'static',
                    size: 'lg wfc-modal-lg',
                    windowClass: 'modal',
                    controller: function ($scope, $modalInstance, $log, $http, $filter, loading) {
                        $scope.usStates = angular.fromJson(wfcLocalized.us_states);
                        $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
                        $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
                        $scope.loading = true;
                        $scope.truck = postObj;
                        $scope.truck.rjsmeta.wfc_rjs_trucks_pickup_date = new Date($scope.truck.rjsmeta.wfc_rjs_trucks_pickup_date);
                        $scope.selection = $scope.truck.rjsmeta.wfc_rjs_trucks_trailer_options;
                        $scope.submitEditTruck = function () {
                            truckService.editTruck($scope.truck)
                                .then(loadRemoteData);
                            $modalInstance.dismiss($scope.loading);
                        };
                        $scope.cancel = function () {
                            $modalInstance.close();
                        };
                    },
                    resolve: {
                        loading: function () {
                            return $scope.loading;
                        }
                    }
                }
            )
            ;
        modalInstance.result.then(function (n) {
            $scope.loading = n;
        }, function (n) {
            $scope.loading = n;
        });
    };
    $scope.deletePost = function (ID) {
        $scope.loading = true;
        truckService.deleteTruck(ID)
            .then(loadRemoteData);
    };
    ///////////////////////
    //// BULK POSTINGS SECTION
    ////
    ///////
    $scope.openBulkModal = function () {
        if ($scope.rjsposttype == "loads") {
            var dynamicTemplate = 'rjsBulkLoadForm.html';
        } else {
            var dynamicTemplate = 'rjsBulkForm.html';
        }
        var modalInstance = $modal.open({
            templateUrl: dynamicTemplate,
            backdrop: 'static',
            windowClass: 'modal',
            size: 'lg wfc-modal-lg',
            resolve: {
                loading: function () {
                    return $scope.loading;
                }
            },
            controller: function ($scope, $modalInstance, $log, $http, $filter, loading) {
                $scope.usStates = angular.fromJson(wfcLocalized.us_states);
                $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
                $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
                $scope.loading = true;
                $scope.bulkTrucks = [];
                //$scope.bulksingletruckformdata = {
                //    wfc_rjs_trucks_pickup_date: new Date(Date.now())
                //};
                $scope.addSingletruck = function (isValid) {
                    if (isValid) {
                        singleTruckObj = angular.copy($scope.bulksingletruckformdata);
                        $scope.bulkTrucks.push(singleTruckObj);
                        //$scope.bulksingletruckformdata = '';
                    }
                };
                $scope.removeSingletruck = function (index) {
                    $scope.bulkTrucks.splice(index, 1);
                };
                $scope.submitBulkTruck = function () {
                    truckService.createTrucks($scope.bulkTrucks)
                        .then(loadRemoteData);
                    $modalInstance.dismiss($scope.loading);
                }
                $scope.cancel = function () {
                    $modalInstance.close();
                };
            }
        });
        //@sftodo: what does this do?
        modalInstance.result.then(function (n) {
            $scope.loading = n;
        }, function (n) {
            $scope.loading = n;
        });
    };
    $scope.bulkDeleteTrucks = function () {
        $scope.loading = true;
        angular.forEach($scope.bulkDeleteSelected, function (value, key) {
            if (value) {
                $scope.deletePost(key);
            }
        });
        $scope.selectedAll = false;
    };
    // ---
    // PRIVATE METHODS.
    // ---
    // I apply the remote data to the local scope.
    // basically this refreshes the model object after changes are made e.g. update, delete, create
    function applyRemoteData(p) {
        angular.forEach(p, function (value, key) {
            ///HAAAAAACK TO HELL
            // @sftodo fix this shit its embarrassing
            var result = [];
            if (value.rjsmeta.wfc_rjs_trucks_to_hazmat == "Yes") {
                result.push("Hazmat");
            }
            if (value.rjsmeta.wfc_rjs_trucks_to_team == "Yes") {
                result.push("Team");
            }
            if (value.rjsmeta.wfc_rjs_trucks_to_expedited == "Yes") {
                result.push("Expedited");
            }
            if (value.rjsmeta.wfc_rjs_trucks_to_tarp == "Yes") {
                result.push("Tarp");
            }
            if (value.rjsmeta.wfc_rjs_trucks_to_pallet_exchange == "Yes") {
                result.push("Pallet Exchange");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_hazmat == "Yes") {
                result.push("Hazmat");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_team == "Yes") {
                result.push("Team");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_expedited == "Yes") {
                result.push("Expedited");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_tarp == "Yes") {
                result.push("Tarp");
            }
            if (value.rjsmeta.wfc_rjs_loads_to_pallet_exchange == "Yes") {
                result.push("Pallet Exchange");
            }
            value.rjsmeta.trailerOptions = result;
        });
        //$scope.trucks = p;
        $scope.rowCollection = p;
//        $scope.trucks = [].concat($scope.rowCollection);
    }

    function loadRemoteData() {
        // returns a promise.
        truckService.getFavTrucks()
            .then(
            function (p) {
                $timeout(function () {
                    $scope.loading = false;
                    applyRemoteData(p);
                }, 1000);
            }
        );
    }
});
//
app.filter('capitalize', function () {
    return function (input, all) {
        return (!!input) ? input.replace(/([^\W_]+[^\s-]*) */g, function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }) : '';
    }
});