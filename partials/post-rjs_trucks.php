<?php require_once('../includes/rjs_utilities.php'); ?>
<div class="row post-truck-partial wfc-row">
    <span class="col-md-1">
    </span>
    <span class="col-md-10">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <ul class="nav navbar-nav">
                        <li>
                        <a ng-click="createPost()">New Post</a>
                        </li>
                        <li>
                        <a href="{{wfcLocalized.site}}archive-posts/?type=rjs_{{rjsposttype}}&status=archive">Historical Posts</a>
                        </li>
                        <li>
                        <a href="{{wfcLocalized.site}}favorite-posts/?type=rjs_{{rjsposttype}}">Favorite Postings</a>
                        </li>
                        <li>
                        <a href="{{wfcLocalized.site}}manage-posts/?type=rjs_loads&status=current">Manage Loads</a>
                        </li>
                        <li>
                        <a href="{{wfcLocalized.site}}manage-posts/?type=rjs_trucks&status=current">Manage Trucks</a>
                        </li>
                        <li>
                        <a ng-click="openBulkModal()">Create Bulk Posts</a>
                        </li>
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
    <form name="quickNewTruck" ng-submit="quickTruckPost(quickNewTruck.$valid)" novalidate class="col-md-10">
        <fieldset>
            <div class="row">
                <div class="col-md-2">
                    <label class="control-label" for="origin_city">Origin</label>
                    <input id="origin_city"
                           ng-model="quicktruck.wfc_rjs_trucks_origin_city"
                           name="wfc_rjs_trucks_origin_city"
                           type="text"
                           class="form-control input-md">
                    <p ng-show="quickNewTruck.wfc_rjs_trucks_origin_city.$invalid && !quickNewTruck.wfc_rjs_trucks_origin_city.$pristine"
                       class="help-block">Enter a Date.</p>
                </div>
                <div class="col-md-1">
                    <label class="control-label" for="origin_state">St</label>
                    <br/> <select id="origin_state"
                                  name="wfc_rjs_trucks_origin_state"
                                  ng-init="quicktruck.wfc_rjs_trucks_origin_state = usStates[0].value"
                                  ng-model="quicktruck.wfc_rjs_trucks_origin_state"
                                  ng-options="option.value as option.name for option in usStates"></select>
                </div>
                <div class="col-md-1">
                    <label class="control-label" for="wfc_rjs_trucks_trailer_type">Eq</label>
                    <br/> <select id="wfc_rjs_trucks_trailer_type" ng-model="quicktruck.wfc_rjs_trucks_trailer_type">
                        <?php foreach( $rjs_trailer_type as $k => $v ): ?>
                            <option value="<?php echo $k ?>"><?php echo $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="control-label" for="dest_city">Dest.</label>
                    <input id="dest_city"
                           ng-model="quicktruck.wfc_rjs_trucks_dest_city"
                           name="wfc_rjs_trucks_dest_city"
                           type="text"
                           class="form-control input-md">
                </div>
                <div class="col-md-1">
                    <label class="control-label" for="dest_state">St</label>
                    <br/> <select id="dest_state"
                                  name="wfc_rjs_trucks_dest_state"
                                  ng-init="quicktruck.wfc_rjs_trucks_dest_state = usStates[0].value"
                                  ng-model="quicktruck.wfc_rjs_trucks_dest_state"
                                  ng-options="option.value as option.name for option in usStates"></select>
                </div>
                <div class="col-md-2">
                    <br />  <label class="control-label">LTL <input type="checkbox"
                                                            ng-model="quicktruck.wfc_rjs_trucks_size"
                                                            ng-true-value="'partial'"
                                                            ng-false-value="'No'">
                    </label>
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="wfc_rjs_trucks_pickup_date">Date</label><br />
                    <input ng-model="quicktruck.wfc_rjs_trucks_pickup_date"
                           type="text"
                           name="wfc_rjs_trucks_pickup_date"
                           datepicker-popup="MM-dd-yyyy"
                           datepicker-append-to-body="true"
                           is-open="data.isOpen"
                           ng-click="data.isOpen = true"
                           ng-required="true"
                        />
                    <p ng-show="quickNewTruck.wfc_rjs_trucks_pickup_date.$invalid"
                       class="help-block">Enter a Date.</p>
                    <!--<label class="control-label" for="wfc_rjs_trucks_pickup_date">Date</label>
                    <input id="wfc_rjs_trucks_pickup_date"
                           ng-model="quicktruck.wfc_rjs_trucks_pickup_date"
                           name="wfc_rjs_trucks_pickup_date"
                           type="date"
                           required>
                    <p ng-show="quickNewTruck.wfc_rjs_trucks_pickup_date.$invalid && !quickNewTruck.wfc_rjs_trucks_pickup_date.$pristine"
                       class="help-block">Enter a Date.</p>-->
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Add Truck</button>
        </fieldset>
    </form>
</div>
<div class="row wfc-table-row">
    <span class="col-md-1">
    </span>
    <span class="col-md-10">
        <span class="wfc-table-loader col-md-offset-6 col-md-1 glyphicon glyphicon-refresh glyphicon-refresh-animate"
              ng-show="loading"></span>
        <table st-table="trucks"
               st-safe-src="rowCollection"
               class="table table-striped table-bordered"
               ng-show="!loading">
            <thead>
            <tr>
                <th></th>
                <th>**DEBUG Origin City</th>
                <th>**DEBUG Origin State</th>
                <th>Equipment</th>
                <th st-sort="rjsmeta.trailerOptions">Options</th>
                <th>Full/Partial</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_pickup_date">Date Available</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_rate_per_mile">$/Mile</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_special_information">Description</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_handle">Handle</th>
                <th>Handle Phone</th>
                <!--<th>checkbox debug column</th>-->
                <th>Tools</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="truck in trucks">
                <td  width="20"><input type="checkbox" ng-click="toggleBulkDelete(truck.ID)"></td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_origin_city}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_origin_state}}</td>
                <td width="20">{{truck.rjsmeta.wfc_rjs_trucks_trailer_type}}</td>
                <td>{{truck.rjsmeta.trailerOptions.join(', ')}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_size}}</td>
                <td  width="200">{{truck.rjsmeta.wfc_rjs_trucks_pickup_date | scfDateFormatter}}</td>
                <td width="20">{{truck.rjsmeta.wfc_rjs_trucks_rate_per_mile}}</td>
                <td width="200">{{truck.rjsmeta.wfc_rjs_trucks_special_information}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_handle}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_handle_phone}}</td>
                <!--<td>{{truck.rjsmeta.wfc_rjs_trucks_to_hazmat}}</td>-->
                <td width="50">
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