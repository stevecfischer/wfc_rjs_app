<nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <li>
                        <a ng-click="createPost()">Add {{rjsposttype | capitalize}}</a>
                        </li>
                        <li ng-class="{ active: activePath=='/manage-posts/?type=rjs_{{rjsposttype}}&status=archive' }">
                        <a href="{{wfcLocalized.site}}manage-posts/?type=rjs_{{rjsposttype}}&status=archive">Historical {{rjsposttype | capitalize}}</a>
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
                    </ul>
                </div>
            </div>
        </nav>