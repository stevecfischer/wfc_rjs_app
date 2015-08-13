<?php require_once('../includes/rjs_utilities.php'); ?>
<div class="row post-truck-partial">
    <span class="col-md-1">
    </span>
    <span class="col-md-3">
        <a ng-click="createPost()">New Post</a>
        |
        <a href="{{wfcLocalized.site}}archive-posts/?type=rjs_{{rjsposttype}}&status=archive">Historical Posts</a>
        |
        <a ng-click="openFavModal()">Favorite Postings</a>
    </span>
    <span class="col-md-4">
        <a href="{{wfcLocalized.site}}manage-posts/?type=rjs_loads&status=current">Manage Loads</a>
        |
        <a href="{{wfcLocalized.site}}manage-posts/?type=rjs_trucks&status=current">Manage Trucks</a>
    </span>
    <span class="col-md-4">
        <a ng-click="openBulkModal()">Create Bulk Posts</a>
    </span>
</div>
<div class="row">
    <span class="col-md-1">
    </span>
    <span class="col-md-10">
        <span class="wfc-table-loader col-md-offset-6 col-md-1 glyphicon glyphicon-refresh glyphicon-refresh-animate" ng-show="loading"></span>
        <table st-table="trucks" st-safe-src="rowCollection" class="table table-striped table-bordered" ng-show="!loading">
            <thead>
            <tr>
                <th>**DEBUG Origin City</th>
                <th>Equipment</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_special_information">Description</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_rate_per_mile">$/Mile</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="truck in trucks">
                <td>{{truck.rjsmeta.wfc_rjs_trucks_origin_city}}</td>
                <td>{{truck.rjsmeta.trailerOptions.join(', ')}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_special_information}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_rate_per_mile}}</td>
                <td>
                    <a ng-click="editPost( truck )"><i class="glyphicon glyphicon-pencil"></i></a>
                    |
                    <a ng-click="deletePost( truck.ID )"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="13" class="text-center">
                    <div st-items-by-page="10" st-displayed-pages="7" st-pagination=""></div>
                    <div>Total number of Trucks: {{rowCollection.length}}</div>
                </td>
            </tr>
            </tfoot>
        </table>
        <span class="col-md-2">
            <button ng-click="bulkDeleteTrucks()" class="btn btn-success btn-sm">Bulk Delete</button>
        </span>
    </span>
    <span class="col-md-1">
    </span>
</div>