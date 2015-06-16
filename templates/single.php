<?php get_header(); ?>

<?php if( have_posts() ){
    while( have_posts() ) :
        the_post(); ?>

        <?php if( is_front_page() ){ ?>
        <div id="page-title"><h3><?php the_title(); ?></h3></div>
    <?php } else{ ?>
        <div id="page-title"><h3><?php the_title(); ?></h3></div>
    <?php } ?>
        <div id="indexwrapper">
        <div id="index-content">
        <div>
            <h1>
                Using The $http Service In AngularJS To Make AJAX Requests
            </h1>
            <ul>
                <li ng-repeat="load in loads">
                {{load.ID}} - {{ load.title }} (
                <a ng-click="removeLoad( load )">delete</a>
                )
                </li>
            </ul>
            <form ng-submit="addLoad()">
                <input type="text" ng-model="form.name" size="20"/> <input type="submit" value="Add Load"/>
            </form>
            <!-- Initialize scripts. -->
            <script type="text/javascript">
                // Define the module for our AngularJS application.
                var app = angular.module("Rjs", []);
                // -------------------------------------------------- //
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
                        $scope.removeLoad = function (load) {
                            postService.removeLoad(load.ID)
                                .then(loadRemoteData)
                            ;
                        };
                        // ---
                        // PRIVATE METHODS.
                        // ---
                        // I apply the remote data to the local scope.
                        function applyRemoteData(newLoads) {
                            $scope.loads = newLoads;
                        }

                        // I load the remote data from the server.
                        function loadRemoteData() {

                            // The postService returns a promise.
                            postService.getLoads()
                                .then(
                                function (posts) {
                                    applyRemoteData(posts);
                                }
                            )
                            ;
                        }
                    }
                );
                // -------------------------------------------------- //
                // -------------------------------------------------- //
                app.service(
                    "postService",
                    function ($http, $q) {

                        // Return public API.
                        return ({
                            addLoad: addLoad,
                            getLoads: getLoads,
                            removeLoad: removeLoad
                        });
                        // ---
                        // PUBLIC METHODS.
                        // ---
                        function addLoad(name) {
                            var request = $http({
                                method: "post",
                                url: "/wp-json/posts/?_wp_json_nonce=" + wfcLocalized.nonce,
                                params: {
                                    action: "add"
                                },
                                data: {
                                    title: name,
                                    type: 'wfc_loads',
                                    status: 'publish'
                                }
                            });
                            request.success(function (d) {
                                addPostMeta(d);
                            });
                            return ( request.then(handleSuccess, handleError) );
                        }

                        function addPostMeta(d) {
                            var request = $http({
                                method: "post",
                                url: "/wp-json/posts/" + d.ID + "/meta/?_wp_json_nonce=" + wfcLocalized.nonce,
                                data: {
                                    "wfc_width": "name",
                                    "wfc_height": "1.5"
                                }
                            });
                            request.success(function (d) {
                                console.log(d);
                            });
                            return ( request.then(handleSuccess, handleError) );
                        }

                        function getPostMeta(d) {
                            var request = $http({
                                method: "get",
                                url: "/wp-json/posts/298/meta/?_wp_json_nonce=" + wfcLocalized.nonce,
                                params: {
                                    action: "get"
                                },
                                data: {
                                    "wfc_width": "name",
                                    "wfc_height": "1.5"
                                }
                            });
                            console.log(d[1].meta);
                            return ( request.then(handleSuccess, handleError) );
                        }

                        function getLoads() {
                            var request = $http({
                                method: "get",
                                url: "/wp-json/posts/?type=wfc_loads",
                                params: {
                                    action: "get"
                                }
                            });
                            request.success(function (d) {
                                getPostMeta(d);
                            });
                            return ( request.then(handleSuccess, handleError) );
                        }

                        function removeLoad(ID) {
                            var request = $http({
                                method: "delete",
                                url: "/wp-json/posts/" + ID + "?force=0&_wp_json_nonce=" + wfcLocalized.nonce,
                                params: {
                                    action: "delete"
                                }
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
</div> <!-- //#indexwrapper -->
<?php get_footer(); ?>