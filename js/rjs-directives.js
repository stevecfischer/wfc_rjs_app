/**
 * search form
 */
app.directive('searchForm', function () {
    return {
        restrict: 'EA',
        templateUrl: wfcLocalized.template_directory.rjs_search_form,
        controller: 'TruckController'
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

/**
 * common footer
 */
app.directive('rjsFooter', function () {
    return {
        restrict: 'E',
        templateUrl: wfcLocalized.template_directory.rjs_footer
    };
});