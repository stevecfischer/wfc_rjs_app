app.controller('TruckController', function ($scope, $routeParams, $location, truckService, $modal, $log, $filter, $timeout) {
    $scope.loading = true;
    $scope.deletedTrucks = [];
    $scope.quicktruck = {};
    $scope.bulkDeleteSelection = [];
    $scope.quicktruck = {
        wfc_rjs_trucks_pickup_date: new Date(Date.now())
    };

    $scope.toggleBulkDelete = function toggleSelection(truckPostId) {
        var idx = $scope.bulkDeleteSelection.indexOf(truckPostId);
        // is currently selected
        if (idx > -1) {
            $scope.bulkDeleteSelection.splice(idx, 1);
        }

        // is newly selected
        else {
            $scope.bulkDeleteSelection.push(truckPostId);
        }
    };
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
    $scope.createPost = function () {
        var modalInstance = $modal.open({
            templateUrl: 'rjsTruckForm.html',
            backdrop: true,
            windowClass: 'modal',
            controller: function ($scope, $modalInstance, $log, $http, loading) {
                $scope.truck = {
                    rjsmeta: {
                        wfc_rjs_trucks_pickup_date: new Date(Date.now())
                    }
                };
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
                    $modalInstance.dismiss();
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
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
    $scope.quickTruckPost = function (isValid) {
        if (isValid) {
            console.log($scope.quicktruck);
            console.log($scope.quickNewTruck);
            $scope.loading = true;
            truckService.quickCreateTruck($scope.quicktruck)
                .then(loadRemoteData);
            $scope.quicktruck = '';
        }
    };
    $scope.editPost = function (postObj) {
        var modalInstance = $modal.open({
                    templateUrl: 'rjsTruckForm.html',
                    backdrop: 'static',
                    windowClass: 'modal',
                    controller: function ($scope, $modalInstance, $log, $http, $filter, loading) {
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
                            $modalInstance.dismiss();
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
            $log.info('Modal dismissed at: ' + new Date());
        });
    }
    $scope.deletePost = function (ID) {
        //$scope.loading = true;
        truckService.deleteTruck(ID)
            .then(loadRemoteData);
    }
    $scope.bulkDeleteTrucks = function () {
        $scope.loading = true;
        angular.forEach($scope.bulkDeleteSelection, function (value, key) {
            $scope.deletePost(value);
        });
    }
    ///////////////////////
//// FAVORITE POSTINGS SECTION
////
///////
    $scope.openFavModal = function () {
        var modalInstance = $modal.open({
            templateUrl: 'rjsFavorite.html',
            backdrop: 'static',
            windowClass: 'modal',
            size: 'lg',
            resolve: {
                loading: function () {
                    return $scope.loading;
                }
            },
            controller: 'FavoriteCtrl'
        });
        modalInstance.result.then(function (n) {
            $scope.loading = n;
        }, function (n) {
            $scope.loading = n;
            $log.info('Modal dismissed at: ' + new Date());
        });
    };
    ///////////////////////
    //// BULK POSTINGS SECTION
    ////
    ///////
    $scope.openBulkModal = function () {
        var modalInstance = $modal.open({
            templateUrl: 'rjsBulkForm.html',
            backdrop: true,
            windowClass: 'modal',
            size: 'wfc-lg',
            resolve: {
                loading: function () {
                    return $scope.loading;
                }
            },
            controller: function ($scope, $modalInstance, $log, $http, $filter, loading) {
                $scope.scfStash = "";
                $scope.loading = true;
                $scope.bulkTrucks = [];
                $scope.bulksingletruckformdata = {
                    wfc_rjs_trucks_pickup_date: new Date(Date.now())
                };
                $scope.addSingletruck = function (isValid) {
                    if (isValid) {
                        console.log($scope.bulksingletruckformdata);
                        var singleTruck = $scope.bulksingletruckformdata;
                        $scope.bulkTrucks.push($scope.bulksingletruckformdata);
                        $scope.bulksingletruckformdata = '';
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
            }
        });
        modalInstance.result.then(function (n) {
            $scope.loading = n;
        }, function (n) {
            $scope.loading = n;
            $log.info('Modal dismissed at: ' + new Date());
        });
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
app.controller('FavoriteCtrl', function ($scope, $modalInstance, $log, $http, $filter, loading, truckService, $timeout) {
    $scope.loading = true;
    $scope.rowFavCollection = [];
    $scope.quicktruck = {
        rjsmeta: {
            wfc_rjs_trucks_pickup_date: new Date(Date.now())
        }
    };
    $scope.editFavoriteTruck = function (postObj) {
        console.log(postObj);
        $scope.loading = true;
        console.log($scope.quicktruck.rjsmeta);
        console.log($scope.editFavTruck);
        $scope.loading = true;
        truckService.editTruck($scope.quicktruck)
            .then(loadRemoteData);
        $scope.quicktruck = '';
        /*        $scope.truck = postObj;
         $scope.truck.rjsmeta.wfc_rjs_trucks_pickup_date = new Date($scope.truck.rjsmeta.wfc_rjs_trucks_pickup_date);
         $scope.selection = $scope.truck.rjsmeta.wfc_rjs_trucks_trailer_options;
         $scope.submitEditTruck = function () {
         truckService.editTruck($scope.truck)
         .then(loadRemoteData);
         $modalInstance.dismiss($scope.loading);
         };
         $scope.cancel = function () {
         $modalInstance.dismiss();
         };*/
    }
    //request favorite posts
    loadRemoteData();
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

    function applyRemoteData(p) {
        //$scope.trucks = p;
        console.log(p);
        $scope.rowFavCollection = p;
//        $scope.trucks = [].concat($scope.rowCollection);
    }
});