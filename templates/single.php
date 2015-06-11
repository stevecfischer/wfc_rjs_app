<?php
    /**
     *
     * @package scf-framework
     * @author Steve
     * @date 6/10/2015
     */

    get_header(); ?>

<div>
    <h1>
        Using The $http Service In AngularJS To Make AJAX Requests
    </h1>
    <!-- Show existing friends. -->
    <ul>
        <li ng-repeat="post in posts">
        {{ post.title }}
        (
        <a ng-click="removeFriend( post )">delete</a>
        )
        </li>
    </ul>
    <!-- Add a new friend to the list. -->
    <form ng-submit="addFriend()">
        <input type="text" ng-model="form.name" size="20"/>
        <input type="submit" value="Add Friend"/>
    </form>
    <!-- Initialize scripts. -->
    <script type="text/javascript">
        // Define the module for our AngularJS application.
        var app = angular.module("Demo", []);
        // -------------------------------------------------- //
        // -------------------------------------------------- //
        // I control the main demo.
        app.controller(
            "DemoController",
            function ($scope, friendService) {

                // I contain the list of friends to be rendered.
                $scope.posts = [];
                // I contain the ngModel values for form interaction.
                $scope.form = {
                    name: ""
                };
                loadRemoteData();
                // ---
                // PUBLIC METHODS.
                // ---
                // I process the add-friend form.
                $scope.addFriend = function () {

                    // If the data we provide is invalid, the promise will be rejected,
                    // at which point we can tell the user that something went wrong. In
                    // this case, I'm just logging to the console to keep things very
                    // simple for the demo.
                    friendService.addFriend($scope.form.name)
                        .then(
                        loadRemoteData,
                        function (errorMessage) {
                            console.warn(errorMessage);
                        }
                    )
                    ;
                    // Reset the form once values have been consumed.
                    $scope.form.name = "";
                };
                // I remove the given friend from the current collection.
                $scope.removeFriend = function (post) {

                    // Rather than doing anything clever on the client-side, I'm just
                    // going to reload the remote data.
                    friendService.removeFriend(post.id)
                        .then(loadRemoteData)
                    ;
                };
                // ---
                // PRIVATE METHODS.
                // ---
                // I apply the remote data to the local scope.
                function applyRemoteData(newFriends) {
                    $scope.posts = newFriends;
                }

                // I load the remote data from the server.
                function loadRemoteData() {

                    // The friendService returns a promise.
                    friendService.getFriends()
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
        // I act a repository for the remote friend collection.
        app.service(
            "friendService",
            function ($http, $q) {

                // Return public API.
                return ({
                    addFriend   : addFriend,
                    getFriends  : getFriends,
                    removeFriend: removeFriend
                });
                // ---
                // PUBLIC METHODS.
                // ---
                // I add a friend with the given name to the remote collection.
                function addFriend(name) {
                    var request = $http({
                        method: "post",
                        url   : "api/index.cfm",
                        params: {
                            action: "add"
                        },
                        data  : {
                            name: name
                        }
                    });
                    return ( request.then(handleSuccess, handleError) );
                }

                // I get all of the friends in the remote collection.
                function getFriends() {
                    var request = $http({
                        method: "get",
                        url   : "/wp-json/posts/?type=wfc_loads",
                        params: {
                            action: "get"
                        }
                    });
                    return ( request.then(handleSuccess, handleError) );
                }

                // I remove the friend with the given ID from the remote collection.
                function removeFriend(id) {
                    var request = $http({
                        method: "delete",
                        url   : "api/index.cfm",
                        params: {
                            action: "delete"
                        },
                        data  : {
                            id: id
                        }
                    });
                    return ( request.then(handleSuccess, handleError) );
                }

                // ---
                // PRIVATE METHODS.
                // ---
                // I transform the error response, unwrapping the application dta from
                // the API response payload.
                function handleError(response) {

                    // The API response from the server should be returned in a
                    // nomralized format. However, if the request was not handled by the
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

<?php get_footer(); ?>
