/*
 app.directive('animateOnChange', ['$animate', '$timeout', function($animate, $timeout) {
 return function(scope, elem, attr) {
 scope.$watchCollection(attr.animateOnChange, function() {
 console.log('items changed');
 $animate.addClass(elem, 'on').then(function() {
 $timeout(function(){
 $animate.removeClass(elem, 'on');
 }, 0);
 });
 });
 };
 }]);*/
//app.directive('div', function () {
//    var directive = {};
//    directive.restrict = 'E';
//    /* restrict this directive to elements */
//    directive.template = "My first directive: {{textToInsert}}";
//    return directive;
//});

app.directive('searchForm', function () {
    return {
        restrict: 'EA',
        templateUrl: wfcLocalized.template_directory.rjs_search_form,
        controller: function ($scope, $http) {
            $scope.formData = {};

            $scope.searchPost = function (isValid) {
                console.log(this.formData);
                if (isValid) {

                    $scope.searchData = {};

                    var request = $http({
                        method: 'GET',
                        templateUrl: wfcLocalized.template_directory.rjs_search_form,
                        url: "/cms-wfc/wp-json/posts/?type=rjs_trucks&filter[meta_query][key1]=wfc_rjs_trucks_pickup_date&filter[meta_query][value1]=2015-08-24&filter[meta_query][compare1]=%3E=&filter[meta_query][key2]=wfc_rjs_trucks_special_information&filter[meta_query][value2]=findme&filter[meta_query][compare2]==="
                    });
                    //url: "/cms-wfc/wp-json/posts/?filter[s]=" + $scope.filter.s

                    request.success(function (res) {
                        $scope.posts = res;
                    });
                    console.log(request);
                }
            };
        }
    };
});

/**
 * common navigation menu section
 */
app.directive('rjsNavSection', function () {
    return {
        restrict: 'E',
        templateUrl: wfcLocalized.template_directory.rjs_nav_section
    };
});