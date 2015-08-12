<div class="row post-load-partial">
    <span class="col-lg-1">
    </span>
    <span class="col-lg-3">
        <a ng-click="createPost()">New Post</a>
        |
        <a href="{{wfcLocalized.site}}archive-posts/?type=rjs_{{rjsposttype}}&status=archive">Historical Posts</a>
        |
        <a href="{{wfcLocalized.site}}fav-loads?type=rjs_loads&status=current&is_fav=yes">Favorite Postings</a>
    </span>
    <span class="col-lg-4">
        <a href="{{wfcLocalized.site}}manage-posts/?type=rjs_loads&status=current">Manage Loads</a>
        |
        <a href="{{wfcLocalized.site}}manage-posts/?type=rjs_trucks&status=current">Manage Trucks</a>
    </span>
    <span class="col-lg-4">
        <a ng-click="openBulkModal()">Create Bulk Posts</a>
    </span>
</div>
<div class="row">
    <fieldset>
        <div class="row">
            <div class="col-md-2">
                <label class="control-label" for="origin_city">Origin City</label>
                <input id="origin_city" ng-model="wfc_rjs_loads_origin_city" name="wfc_rjs_loads_origin_city" type="text" class="form-control input-md">
            </div>
            <div class="col-md-2">
                <label class="control-label" for="origin_state">Origin State</label>
                <select id="origin_state" ng-model="wfc_rjs_loads_origin_state" name="wfc_rjs_loads_origin_state">
                    <?php foreach( $us_states_array as $k => $v ): ?>
                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="control-label" for="dest_city">Dest. City</label>
                <input id="dest_city" ng-model="wfc_rjs_loads_dest_city" name="wfc_rjs_loads_dest_city" type="text" class="form-control input-md">
            </div>
            <div class="col-md-2">
                <label class="control-label" for="selectbasic">Dest. State</label>
                <select id="selectbasic" ng-model="wfc_rjs_loads_dest_state" name="wfc_rjs_loads_dest_state">
                    <?php foreach( $us_states_array as $k => $v ): ?>
                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="control-label">Trailer Options</label>
                <label class="control-label">Hazmat
                    <input type="checkbox" ng-model="wfc_rjs_loads_to_hazmat" ng-true-value="'Yes'" ng-false-value="'No'">
                </label>
                <label class="control-label">Team
                    <input type="checkbox" ng-model="wfc_rjs_loads_to_team" ng-true-value="'Yes'" ng-false-value="'No'">
                </label>
                <label class="control-label">Expedited
                    <input type="checkbox" ng-model="wfc_rjs_loads_to_expedited" ng-true-value="'Yes'" ng-false-value="'No'">
                </label>
                <label class="control-label">Tarp
                    <input type="checkbox" ng-model="wfc_rjs_loads_to_tarp" ng-true-value="'Yes'" ng-false-value="'No'">
                </label>
                <label class="control-label">Pallet Exchange
                    <input type="checkbox" ng-model="wfc_rjs_loads_to_pallet_exchange" ng-true-value="'Yes'" ng-false-value="'No'">
                </label>
            </div>
            <div class="col-md-2">
                <label class="control-label" for="wfc_rjs_loads_trailer_type">Trailer Type</label>
                <select id="wfc_rjs_loads_trailer_type" ng-model="wfc_rjs_loads_trailer_type">
                    <?php foreach( $rjs_trailer_type as $k => $v ): ?>
                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type="button" ng-click="quickLoadPost()">Add Load</button>
    </fieldset>
</div>
<div class="row">
    <span class="col-lg-1">
    </span>
    <span class="col-lg-10">
        <table st-table="displayedCollection" st-safe-src="loads" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Equipment</th>
                <th>Options</th>
                <th>Full/Partial</th>
                <th>Pickup Date</th>
                <th>Delivery Date</th>
                <th>Payment</th>
                <th st-sort="meta.origin_city">Origin City</th>
                <th st-sort="meta.origin_state">ST</th>
                <th>Destination City</th>
                <th>ST</th>
                <th>Handle</th>
                <th>Handle Phone</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="load in displayedCollection">
                <td>{{load.rjsmeta.wfc_rjs_loads_trailer_type}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_trailer_options.join(", ")}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_partial}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_pickup_date | scfDateFormatter}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_deliver_date | scfDateFormatter}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_amount}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_origin_city}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_origin_state}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_dest_city}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_dest_state}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_handle}}</td>
                <td>{{load.rjsmeta.wfc_rjs_loads_handle_phone}}</td>
                <td>
                    <a data-toggle="modal" data-target="#newPost"><i class="glyphicon glyphicon-pencil"></i></a>
                    |
                    <a ng-click="removeLoad( load )"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="13" class="text-center">
                    <div st-items-by-page="5" st-pagination="" st-template="/cms-wfc/wp-content/plugins/wfc_rjs_app/partials/rjs.pagination.html"></div>
                </td>
            </tr>
            </tfoot>
        </table>
    </span>
    <span class="col-lg-1">
    </span>
</div>