app.service('truckService', function ($http, $q, $routeParams, $filter) {
    // Return public API.
    return ({
        getTrucks: getTrucks,
        deleteTruck: deleteTruck,
        editTruck: editTruck,
        createTruck: createTruck,
        quickCreateTruck: quickCreateTruck,
        createTrucks: createTrucks,
        getFavTrucks: getFavTrucks
    });
    function createTrucks(bulkTrucksObj) {
        angular.forEach(bulkTrucksObj, function (value, key) {
            value.wfc_rjs_trucks_pickup_date = $filter('date')(value.wfc_rjs_trucks_pickup_date, "yyyy-MM-dd");
        });
        var data = {
            action: 'rjs_bulk_new_post',
            postdata: bulkTrucksObj,
            posttype: $routeParams.type
        };
        var request = $http({
            method: 'POST',
            url: wfcLocalized.ajax_url + "?_wp_json_nonce=" + wfcLocalized.nonce,
            data: data,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
        return ( request.then(handleSuccess, handleError) );
    }

    function createTruck(postObj) {
        postObj.rjsmeta.wfc_rjs_trucks_pickup_date = $filter('date')(postObj.rjsmeta.wfc_rjs_trucks_pickup_date, "yyyy-MM-dd");
        var data = {
            action: 'rjs_new_post',
            postdata: postObj.rjsmeta,
            posttype: $routeParams.type
        };
        var request = $http({
            method: 'POST',
            url: wfcLocalized.ajax_url + "?_wp_json_nonce=" + wfcLocalized.nonce,
            data: data,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
        return ( request.then(handleSuccess, handleError) );
    }

    function quickCreateTruck(postObj) {
        postObj.wfc_rjs_trucks_pickup_date = $filter('date')(postObj.wfc_rjs_trucks_pickup_date, "yyyy-MM-dd");
        var data = {
            action: 'rjs_new_post',
            postdata: postObj,
            posttype: $routeParams.type
        };
        var request = $http({
            method: 'POST',
            url: wfcLocalized.ajax_url + "?_wp_json_nonce=" + wfcLocalized.nonce,
            data: data,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
        return ( request.then(handleSuccess, handleError) );
    }

    function editTruck(postObj) {
        postObj.rjsmeta.wfc_rjs_trucks_pickup_date = $filter('date')(postObj.rjsmeta.wfc_rjs_trucks_pickup_date, "yyyy-MM-dd");
        var data = {
            action: 'rjs_edit_post',
            postid: postObj.ID,
            postdata: postObj.rjsmeta
        };
        var request = $http({
            method: 'POST',
            url: wfcLocalized.ajax_url + "?_wp_json_nonce=" + wfcLocalized.nonce,
            data: data,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
        return ( request.then(handleSuccess, handleError) );
    }

    function deleteTruck(ID) {
        var request = $http({
            method: 'DELETE',
            url: "/cms-wfc/wp-json/posts/" + ID + "?_wp_json_nonce=" + wfcLocalized.nonce
        });
        return ( request.then(handleSuccess, handleError) );
    }

    // I get all of the trucks in the remote collection.
    function getTrucks() {
        //console.log($routeParams);
        if ($routeParams.status == "archive") {
            $routeParams.statusquery = "<=";
        } else {
            $routeParams.statusquery = ">=";
        }
        var request = $http({
            method: 'GET',
            url: "/cms-wfc/wp-json/posts/?type=" +
            $routeParams.type + "&filter[meta_query][key]=wfc_" +
            $routeParams.type + "_pickup_date&filter[meta_query][value]=" +
            wfcLocalized.today_date + "&filter[meta_query][compare]=" + $routeParams.statusquery + ""
        });
        return ( request.then(handleSuccess, handleError) );
    }

    function getFavTrucks() {
        /*
         http://rjs.wfcdemo.com/cms-wfc/wp-json/posts/?type=rjs_trucks&filter[meta_query][key]=wfc_rjs_trucks_add_to_favorite_posts&filter[meta_query][value]=Yes&filter[meta_query][compare]===
         get favorite trucks query

         */
        var request = $http({
            method: 'GET',
            url: "/cms-wfc/wp-json/posts/?type=" +
            $routeParams.type + "&filter[meta_query][key]=wfc_" +
            $routeParams.type + "_add_to_favorite_posts&filter[meta_query][value]=Yes&filter[meta_query][compare]==="
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
});