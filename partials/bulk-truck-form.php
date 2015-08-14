<script type="text/ng-template" id="rjsBulkForm.html">
    <h3>Bulk Creation</h3>
    <div class="wfc-form-container">
        <div class="row">
            <form id="bulkTruckForm" name="bulk" ng-submit="addSingletruck(bulk.$valid)" novalidate>
                <fieldset>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label" for="origin_city">Origin City</label>
                            <input id="origin_city" ng-model="bulksingletruckformdata.wfc_rjs_trucks_origin_city" name="wfc_rjs_trucks_origin_city" type="text" class="form-control input-md">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label" for="origin_state">Origin State</label>
                            <select id="origin_state" ng-model="bulksingletruckformdata.wfc_rjs_trucks_origin_state" name="wfc_rjs_loads_origin_state">
                                <?php foreach( $us_states_array as $k => $v ): ?>
                                    <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label" for="dest_city">Dest. City</label>
                            <input id="dest_city" ng-model="bulksingletruckformdata.wfc_rjs_trucks_dest_city" name="wfc_rjs_loads_dest_city" type="text" class="form-control input-md">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label" for="selectbasic">Dest. State</label>
                            <select id="selectbasic" ng-model="bulksingletruckformdata.wfc_rjs_trucks_dest_state" name="wfc_rjs_loads_dest_state">
                                <?php foreach( $us_states_array as $k => $v ): ?>
                                    <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Trailer Options</label>
                            <label class="control-label">Hazmat
                                <input type="checkbox" ng-model="bulksingletruckformdata.wfc_rjs_trucks_to_hazmat" ng-true-value="'Yes'" ng-false-value="'No'">
                            </label>
                            <label class="control-label">Team
                                <input type="checkbox" ng-model="bulksingletruckformdata.wfc_rjs_trucks_to_team" ng-true-value="'Yes'" ng-false-value="'No'">
                            </label>
                            <label class="control-label">Expedited
                                <input type="checkbox" ng-model="bulksingletruckformdata.wfc_rjs_trucks_to_expedited" ng-true-value="'Yes'" ng-false-value="'No'">
                            </label>
                            <label class="control-label">Tarp
                                <input type="checkbox" ng-model="bulksingletruckformdata.wfc_rjs_trucks_to_tarp" ng-true-value="'Yes'" ng-false-value="'No'">
                            </label>
                            <label class="control-label">Pallet Exchange
                                <input type="checkbox" ng-model="bulksingletruckformdata.wfc_rjs_trucks_to_pallet_exchange" ng-true-value="'Yes'" ng-false-value="'No'">
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label" for="wfc_rjs_trucks_trailer_type">Trailer Type</label>
                            <select id="wfc_rjs_trucks_trailer_type" ng-model="bulksingletruckformdata.wfc_rjs_trucks_trailer_type">
                                <?php foreach( $rjs_trailer_type as $k => $v ): ?>
                                    <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label" for="wfc_rjs_trucks_weight">Weight</label>
                            <input id="wfc_rjs_trucks_weight" ng-model="bulksingletruckformdata.wfc_rjs_trucks_weight" type="text" class="form-control input-md">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label" for="wfc_rjs_trucks_min_distance">Min Distance</label>
                            <input id="wfc_rjs_trucks_min_distance" ng-model="bulksingletruckformdata.wfc_rjs_trucks_min_distance" type="text" class="form-control input-md">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label" for="wfc_rjs_trucks_pickup_date">Date Available
                                <span class="required">*</span>
                            </label>
                            <input id="wfc_rjs_trucks_pickup_date" ng-model="bulksingletruckformdata.wfc_rjs_trucks_pickup_date" type="date" class="form-control input-md" name="wfc_rjs_trucks_pickup_date" required>
                            <p ng-show="bulk.wfc_rjs_trucks_pickup_date.$invalid && !bulk.wfc_rjs_trucks_pickup_date.$pristine" class="help-block">Enter a Date.</p>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label" for="textarea">Special Information</label>
                            <textarea id="textarea" ng-model="bulksingletruckformdata.wfc_rjs_trucks_special_information"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Add Single Truck</button>
                </fieldset>
            </form>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Origin City</th>
                    <th>Origin State</th>
                    <th>Dest. City</th>
                    <th>Dest. State</th>
                    <th>Trailer Type</th>
                    <th>Weight</th>
                    <th>Min Distance</th>
                    <th>Date Available</th>
                    <th>Options</th>
                    <th>Special Information</th>
                </tr>
                </thead>
                <body>
                <tr ng-repeat="singleTruck in bulkTrucks track by $index">
                    <td>{{ singleTruck.wfc_rjs_trucks_origin_city }}</td>
                    <td>{{ singleTruck.wfc_rjs_trucks_origin_state }}</td>
                    <td>{{ singleTruck.wfc_rjs_trucks_dest_city }}</td>
                    <td>{{ singleTruck.wfc_rjs_trucks_dest_state }}</td>
                    <td>{{ singleTruck.wfc_rjs_trucks_trailer_type }}</td>
                    <td>{{ singleTruck.wfc_rjs_trucks_weight }}</td>
                    <td>{{ singleTruck.wfc_rjs_trucks_min_distance }}</td>
                    <td>{{ singleTruck.wfc_rjs_trucks_pickup_date | scfDateFormatter }}</td>
                    <td>{{ singleTruck | scfTrailerOptionsConcat }}</td>
                    <td>{{ singleTruck.wfc_rjs_trucks_special_information }}</td>
                    <td>
                        <button type="button" ng-click="removeSingletruck($index)">Remove Truck</button>
                    </td>
                </tr>
                </body>
            </table>
        </div>
        <form ng-submit="submitBulkTruck()">
            <button type="submit" class="btn btn-success btn-sm">Post All Trucks</button>
            <button type="button" class="btn btn-danger btn-sm" ng-click="cancel()">Cancel</button>
        </form>
    </div>
</script>