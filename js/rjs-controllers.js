/**
 * Controller for Trucks
 */
app.controller('TruckController', function ($scope, $routeParams, $location, truckService, $modal, $log, $filter, $timeout, rjsUtility) {

    /**
     * empty variable declarations
     * always represent the collection object
     */
    $scope.truck = {};
    $scope.quicktruck = {};
    $scope.bulkDeleteSelected = [];

    $scope.trucks = [];
    $scope.rowCollection = [];
    $scope.deletedTrucks = [];

    /**
     * global variables
     */
    $scope.activePath = null;
    $scope.loading = true;
    $scope.usStates = angular.fromJson(wfcLocalized.us_states);
    $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
    $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
    $scope.disableBulk = true;

    /**
     * helper methods
     */

        //active state for nav menu
    $scope.$on('$routeChangeSuccess', function () {
        $scope.activePath = $location.url();
    });

    //toggle all delete checkboxes
    $scope.checkAll = function () {
        if ($scope.selectedAll) {
            for (var i = 0; i < $scope.trucks.length; i++) {
                var item = $scope.trucks[i];
                $scope.bulkDeleteSelected.push(item);
            }
        } else {
            $scope.bulkDeleteSelected = [];
        }
        $scope.disableBulk = !$scope.isDisabled();
    };

    //toggle single bulk delete checkbox
    $scope.toggleBulk = function (truck) {
        var idx = $scope.bulkDeleteSelected.indexOf(truck);
        if (idx > -1) {
            $scope.bulkDeleteSelected.splice(idx, 1);
        } else {
            $scope.bulkDeleteSelected.push(truck);
        }
        $scope.disableBulk = !$scope.isDisabled();
    };

    $scope.isDisabled = function () {
        return $scope.bulkDeleteSelected.length;
    };

    /**
     * condition to set active post type
     */
    if ($routeParams.type == "rjs_loads") {
        $scope.rjsposttype = "loads";
    } else {
        $scope.rjsposttype = "trucks";
    }

    /**
     * init method gets initial data
     */
    if ($location.url() == '/favorite-posts/?type=rjs_' + $scope.rjsposttype) {
        loadFavRemoteData();
    } else if($location.url() != '/search-posts/?type=rjs_' + $scope.rjsposttype){
        loadRemoteData();
    } else{
        $scope.loading = false;
    }

    /**
     * search all posts
     */
    $scope.searchPost = function (isValid) {
        if (isValid) {
            $scope.loading = true;
            truckService.searchRequest(this.search)
                .then(function (p) {
                    $timeout(function () {
                        $scope.loading = false;
                        applyRemoteData(p);
                    }, 1000);
                });
        }
    };

    /**
     * create post form methods
     */
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
            controller: function ($window, $scope, $modalInstance) {

                /**
                 * closes modal if user clicks backspace
                 * and input is not in focus
                 */
                $scope.$on('$locationChangeStart', function (e) {
                    if ($scope.truckForm.$pristine) {
                        $modalInstance.close();
                    } else if ($scope.truckForm.$dirty) {
                        var fakeBackspace = $window.confirm('You have unsaved changes. Leave the page?');
                        if (!fakeBackspace) {
                            e.preventDefault();
                        } else {
                            $modalInstance.close();
                        }
                    }
                });

                /**
                 * arrays of data for select fields
                 *
                 */
                $scope.usStates = angular.fromJson(wfcLocalized.us_states);
                $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
                $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);

                /**
                 * submit the form
                 * @param isValid boolean
                 */
                $scope.submitEditTruck = function (isValid) {
                    if (isValid) {
                        $scope.loading = true;
                        truckService.createTruck($scope.truck)
                            .then(loadRemoteData);
                        $modalInstance.dismiss($scope.loading);
                    }
                };

                /**
                 * close the modal and cancel the form
                 */
                $scope.cancel = function () {
                    $modalInstance.close();
                };
            },
            resolve: {
                loading: function () {
                    /**
                     * send to truckController
                     */
                    return $scope.loading;
                }
            }
        });
        /**
         * update $scope.loading from modal.open.resolve
         */
        modalInstance.result.then(function (n) {
            console.log(n);
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
            controller: function ($scope, $modalInstance, $window) {

                /**
                 * closes modal if user clicks backspace
                 * and input is not in focus
                 */
                $scope.$on('$locationChangeStart', function (e) {
                    if ($scope.truckForm.$pristine) {
                        $modalInstance.close();
                    } else if ($scope.truckForm.$dirty) {
                        var fakeBackspace = $window.confirm('You have unsaved changes. Leave the page?');
                        if (!fakeBackspace) {
                            e.preventDefault();
                        } else {
                            $modalInstance.close();
                        }
                    }
                });
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
            controller: function ($scope, $modalInstance, $window) {
                /**
                 * closes modal if user clicks backspace
                 * and input is not in focus
                 */
                $scope.$on('$locationChangeStart', function (e) {
                    if ($scope.bulk.$pristine) {
                        $modalInstance.close();
                    } else if ($scope.bulk.$dirty) {
                        var fakeBackspace = $window.confirm('You have unsaved changes. Leave the page?');
                        if (!fakeBackspace) {
                            e.preventDefault();
                        } else {
                            $modalInstance.close();
                        }
                    }
                });
                $scope.usStates = angular.fromJson(wfcLocalized.us_states);
                $scope.trailerTypes = angular.fromJson(wfcLocalized.trailer_type);
                $scope.trailerSizes = angular.fromJson(wfcLocalized.trailer_size);
                $scope.loading = true;
                $scope.bulkTrucks = [];
                $scope.addSingletruck = function (isValid) {
                    if (isValid) {
                        singleTruckObj = angular.copy($scope.bulksingletruckformdata);
                        $scope.bulkTrucks.push(singleTruckObj);
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
    };

    /**
     * delete multiple posts at the same time
     *
     */
    $scope.bulkDeleteTrucks = function () {
        $scope.loading = true;
        angular.forEach($scope.bulkDeleteSelected, function (value, key) {
            $scope.deletePost(value.ID);
        });

        /**
         * reset bulk checkbox, button and array
         *
         */
        $scope.bulkDeleteSelected = [];
        $scope.selectedAll = false;
        $scope.disableBulk = true;
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
        $scope.rowCollection = p;
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

    function loadFavRemoteData() {
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

/**
 * Controller for Search Form
 */
app.controller('SearchController', function ($scope, $routeParams, $location, truckService) {

});