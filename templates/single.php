<?php acf_form_head(); ?>
<?php get_header(); ?>
    <div ng-controller="LoadController">
    <?php if (have_posts()){
        while (have_posts()) :
        the_post(); ?>

    <?php if( is_front_page() ){ ?>
        <div id="page-title"><h3><?php the_title(); ?></h3></div>
    <?php } else{ ?>
        <div id="page-title"><h3><?php the_title(); ?></h3></div>
    <?php } ?>
    <div class="row">
    <div id="indexwrapper">
    <div id="index-content">
    <div>
    <div id="wfc-rjs-container">
        <div ng-view></div>
    </div>
    <?php
        /*    acf_form(
                array(
                    'post_id' => 308
                ) );*/

    ?>
    <form ng-submit="addLoad()">
        <input type="text" ng-model="form.name" size="20" placeholder="title"/>
        <input type="text" ng-model="form.origin_state" size="20" placeholder="origin state"/>
        <input type="submit" value="Add Load"/>
    </form>
    <!-- Initialize scripts. -->
    <script type="text/javascript">
    // Define the module for our AngularJS application.
    var app = angular.module("Rjs", ['ngRoute', 'ui.bootstrap', 'smart-table']);
    // -------------------------------------------------- //
    // setup routes
    app.config(function ($routeProvider, $locationProvider) {
        $routeProvider
            .when('/manage-loads/', {
                templateUrl: wfcLocalized.template_directory.post_load,
                controller: 'GetPage'
            })
        $locationProvider.html5Mode(true);
    });
    app.controller('GetPage', function ($scope, $rootScope) {
        $rootScope.message = 'Manage Load Postings';
    });
    // -------------------------------------------------- //
    // I control the main demo.
    app.controller(
        "LoadController",
        function ($scope, postService) {
            $scope.loads = [];
            // I contain the ngModel values for form interaction.
            $scope.form = {
                name: ""
            };
            loadRemoteData();
            // ---
            // PUBLIC METHODS.
            // ---
            $scope.addLoad = function () {
                postService.addLoad($scope.form.name)
                    .then(
                    loadRemoteData,
                    function (errorMessage) {
                        console.warn(errorMessage);
                    }
                )
                ;
                $scope.form.name = "";
            };
            $scope.addMetaLoad = function () {
                postService.addMetaLoad($scope.form.namemeta)
                    .then(
                    loadRemoteData,
                    function (errorMessage) {
                        console.warn(errorMessage);
                    }
                )
                ;
                $scope.form.namemeta = "";
            };
            $scope.removeLoad = function (load) {
                postService.removeLoad(load.ID)
                    .then(loadRemoteData);
            };
            // ---
            // PRIVATE METHODS.
            // ---
            // I apply the remote data to the local scope.
            function applyRemoteData(newLoads) {
                console.log(newLoads);
                $scope.loads = newLoads;
                $scope.displayedCollection = [].concat($scope.loads);
            }

            // I load the remote data from the server.
            function loadRemoteData() {

                // The postService returns a promise.
                postService.getLoads()
                    .then(
                    function (posts) {
                        applyRemoteData(posts);
                    });
            }

            $scope.filterSecId = function (items) {
                var result = {};
                angular.forEach(items, function (value, key) {
                    angular.forEach(value, function (v, k) {
//                        console.log(k + " : " + v);
                        if (k == "meta") {
                            console.log(v);
                        }
                    });
                    result[key] = value;
                });
                return result;
            };
        });
    // -------------------------------------------------- //
    app.filter('scfDateFormatter', function () {
        return function (input) {
            if (angular.isDefined(input)) {
                if (input.length >= 8) {
                    input = input.slice(0, 8);
                    input = input.slice(4, 6) + '/' + input.slice(6, 8) + '/' + input.slice(0, 4);
                }
            }
            return input;
        };
    });
    // -------------------------------------------------- //
    app.service(
        "postService",
        function ($http, $q, $filter) {

            // Return public API.
            return ({
                addLoad: addLoad,
                addMetaLoad: addMetaLoad,
                getLoads: getLoads,
                removeLoad: removeLoad
            });
            // ---
            // PUBLIC METHODS.
            // ---
            function addLoad(form) {
                console.log(form);
                var request = $http({
                    method: "post",
                    url: wfcLocalized.base + "/posts/?_wp_json_nonce=" + wfcLocalized.nonce,
                    data: {
                        title: form.name,
                        type: 'wfc_loads',
                        status: 'publish',
                        post_meta: [
                            {
                                key: "origin_city",
                                value: form.origin_city
                            },
                            {
                                key: "_origin_city",
                                value: "field_5579b36cc6b22"
                            }
                        ]
                    }
                });
                request.success(function (d) {
                    //addMetaLoad(d);
                });
                return ( request.then(handleSuccess, handleError) );
            }

            function addMetaLoad(namemeta) {
                var metaArray = [];
                var request = $http({
                    method: "post",
                    url: wfcLocalized.base + "/posts/308/meta?_wp_json_nonce=" + wfcLocalized.nonce,
                    data: {
                        key: "dfdsfsd",
                        value: "dfdfd"
                    }
                });
                request.success(function (d) {
                    console.log(d);
                });
                return ( request.then(handleSuccess, handleError) );
            }

            function editLoadMeta(d) {
                var request = $http({
                    method: "get",
                    url: wfcLocalized.base + "/posts/308/meta/441?_wp_json_nonce=" + wfcLocalized.nonce,
                    data: {
                        handle: "ffffffffffffffffffffffffff"
                    }
                });
                request.success(function (d) {
                    console.log(d);
                });
                return ( request.then(handleSuccess, handleError) );
            }

            function getLoads() {
                var request = $http({
                    method: "get",
                    url: wfcLocalized.base + "/posts/?type=wfc_loads"
                });
                return ( request.then(handleSuccess, handleError) );
            }

            function removeLoad(ID) {
                var request = $http({
                    method: "delete",
                    url: wfcLocalized.base + "/posts/" + ID + "?_wp_json_nonce=" + wfcLocalized.nonce
                });
                return ( request.then(handleSuccess, handleError) );
            }

            // ---
            // PRIVATE METHODS.
            // ---
            // I transform the error response, unwrapping the application data from
            // the API response payload.
            function handleError(response) {
                // The API response from the server should be returned in a
                // normalized format. However, if the request was not handled by the
                // server (or what not handles properly - ex. server error), then we
                // may have to normalize it on our end, as best we can.
                if (
                    !angular.isObject(response.data) || !response.data.message
                ) {
                    return ( $q.reject("An unknown error occurred.") );
                }
                // Otherwise, use expected error message.
                return ( $q.reject(response.data.message) );
            }

            // I transform the successful response, unwrapping the application data
            // from the API response payload.
            function handleSuccess(response) {
                return ( response.data );
            }
        }
    );
    </script>
    </div>
    <?php wp_link_pages( array('before' => ''.__( 'Pages:', 'twentyten' ), 'after' => '') ); ?>
    <?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>



    <?php endwhile;
        } ?>
    </div>
    <!-- //#index-content -->
    <div id="sidebar">
        <?php get_sidebar(); ?>
        <div id="image-box">
            <a href="/?page_id=19">
                <img src="<?php bloginfo( 'template_url' ); ?>/images/location-contact-sm.png" width="251" height="123" border="0"/>
            </a>
        </div>
        <br style="clear:both"/>
        <div id="image-box">
            <a href="/?page_id=4">
                <img src="<?php bloginfo( 'template_url' ); ?>/images/customer-carrier-page.png" width="251" height="123" border="0"/>
            </a>
        </div>
    </div>
    <!-- //#sidebar -->
    </div>
    </div>
    <div class="row">
        <!-- //#indexwrapper --><!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Launch demo modal
        </button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <?php acf_form(); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php get_footer(); ?>