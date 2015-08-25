<div class="row post-truck-partial wfc-row">
    <span class="col-md-1">
    </span>
    <span class="col-md-10">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <li>
                        <a ng-click="createPost()">Add {{rjsposttype | capitalize}}</a>
                        </li>
                        <li ng-class="{ active: activePath=='/archive-posts/?type=rjs_{{rjsposttype}}&status=archive' }">
                        <a href="{{wfcLocalized.site}}archive-posts/?type=rjs_{{rjsposttype}}&status=archive">Historical {{rjsposttype | capitalize}}</a>
                        </li>
                        <li ng-class="{ active: activePath=='/favorite-posts/?type=rjs_{{rjsposttype}}' }">
                        <a href="{{wfcLocalized.site}}favorite-posts/?type=rjs_{{rjsposttype}}">Favorite {{rjsposttype | capitalize}}</a>
                        </li>
                        <li ng-class="{ active: activePath=='/manage-posts/?type=rjs_loads&status=current' }">
                        <a href="{{wfcLocalized.site}}manage-posts/?type=rjs_loads&status=current">Manage Loads</a>
                        </li>
                        <li ng-class="{ active: activePath=='/manage-posts/?type=rjs_trucks&status=current' }">
                        <a href="{{wfcLocalized.site}}manage-posts/?type=rjs_trucks&status=current">Manage Trucks</a>
                        </li>
                        <li>
                        <a ng-click="openBulkModal()">Bulk Create {{rjsposttype | capitalize}}</a>
                        </li>
                        <li ng-class="{ active: activePath=='/search-posts/' }">
                        <a href="{{wfcLocalized.site}}search-posts/">Search Posts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </span>
    <span class="col-md-1">
    </span>
</div>
<div class="row wfc-form-row">
    <span class="col-md-1">
    </span>

</div>
<div class="row wfc-table-row">
    <span class="col-md-1">
    </span>
    <span class="col-md-10">
        <span class="wfc-table-loader col-md-offset-6 col-md-1 glyphicon glyphicon-refresh glyphicon-refresh-animate"
              ng-show="loading"></span>
searchForm
        <search-form></search-form>
    </span>
    <span class="col-md-1">
    </span>
</div>