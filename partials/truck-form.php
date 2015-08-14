<script type="text/ng-template" id="rjsTruckForm.html">
    <div class="wfc-form-container">
        <h3>Truck Form</h3>
        <form id="truckForm" name="truckForm" ng-submit="submitEditTruck(truckForm.$valid)" novalidate>
            <fieldset class="">
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="origin_city">Origin City</label>
                        <input id="origin_city" ng-model="truck.rjsmeta.wfc_rjs_trucks_origin_city" name="wfc_rjs_trucks_origin_city" type="text" class="form-control input-md" required/>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label" for="wfc_rjs_trucks_origin_radius">Radius</label>
                                <input id="wfc_rjs_trucks_origin_radius" ng-model="truck.rjsmeta.wfc_rjs_trucks_origin_radius" name="wfc_rjs_trucks_origin_radius" type="text" class="form-control input-md">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" for="origin_state">Origin State</label>
                        <select id="origin_state" name="wfc_rjs_trucks_origin_state"
                                ng-init="quicktruck.wfc_rjs_trucks_origin_state = usStates[0].value"
                                ng-model="quicktruck.wfc_rjs_trucks_origin_state" ng-options="option.value as option.name for option in usStates"></select>
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="dest_city">Dest. City</label>
                        <input id="dest_city" ng-model="truck.rjsmeta.wfc_rjs_trucks_dest_city" name="wfc_rjs_trucks_dest_city" type="text" class="form-control input-md">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label" for="wfc_rjs_trucks_dest_radius">Radius</label>
                                <input id="wfc_rjs_trucks_dest_radius" ng-model="truck.rjsmeta.wfc_rjs_trucks_dest_radius" type="text" class="form-control input-md">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" for="wfc_rjs_trucks_dest_state">Dest. State</label>
                        <br/> <select id="origin_state" name="wfc_rjs_trucks_dest_state"
                                      ng-init="quicktruck.wfc_rjs_trucks_dest_state = usStates[0].value"
                                      ng-model="quicktruck.wfc_rjs_trucks_dest_state" ng-options="option.value as option.name for option in usStates"></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label" for="wfc_rjs_trucks_trailer_type">Trailer Type</label>
                        <select id="wfc_rjs_trucks_trailer_type" name="wfc_rjs_trucks_trailer_type" ng-model="truck.rjsmeta.wfc_rjs_trucks_trailer_type">
                            <?php foreach( $rjs_trailer_type as $k => $v ): ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Trailer Options</label>
                        <label class="control-label">Hazmat
                            <input type="checkbox" ng-model="truck.rjsmeta.wfc_rjs_trucks_to_hazmat" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                        <label class="control-label">Team
                            <input type="checkbox" ng-model="truck.rjsmeta.wfc_rjs_trucks_to_team" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                        <label class="control-label">Expedited
                            <input type="checkbox" ng-model="truck.rjsmeta.wfc_rjs_trucks_to_expedited" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                        <label class="control-label">Tarp
                            <input type="checkbox" ng-model="truck.rjsmeta.wfc_rjs_trucks_to_tarp" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                        <label class="control-label">Pallet Exchange
                            <input type="checkbox" ng-model="truck.rjsmeta.wfc_rjs_trucks_to_pallet_exchange" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="wfc_rjs_trucks_weight">Weight</label>
                        <input id="wfc_rjs_trucks_weight" ng-model="truck.rjsmeta.wfc_rjs_trucks_weight" type="text" class="form-control input-md">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="wfc_rjs_trucks_min_distance">Min Distance</label>
                        <input id="wfc_rjs_trucks_min_distance" ng-model="truck.rjsmeta.wfc_rjs_trucks_min_distance" type="text" class="form-control input-md">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="wfc_rjs_trucks_pickup_date">Date Available
                            <span class="required">*</span>
                        </label>
                        <input id="wfc_rjs_trucks_pickup_date" ng-model="truck.rjsmeta.wfc_rjs_trucks_pickup_date" type="date" class="form-control input-md" name="wfc_rjs_trucks_pickup_date" required/>
                        <p ng-show="truckForm.wfc_rjs_trucks_pickup_date.$invalid && !truckForm.wfc_rjs_trucks_pickup_date.$pristine" class="help-block">Enter a Date.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="wfc_rjs_trucks_width">Width</label>
                        <input id="wfc_rjs_trucks_width" ng-model="truck.rjsmeta.wfc_rjs_trucks_width" type="text" class="form-control input-md">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="wfc_rjs_trucks_length">Length</label>
                        <input id="wfc_rjs_trucks_length" ng-model="truck.rjsmeta.wfc_rjs_trucks_length" type="text" class="form-control input-md">
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="wfc_rjs_trucks_qty">Qty</label>
                        <input id="wfc_rjs_trucks_length" ng-model="truck.rjsmeta.wfc_rjs_trucks_qty" type="text" class="form-control input-md">
                    </div>
                    <div class="col-md-4">
                        <label class="control-label" for="wfc_rjs_trucks_qty">Rate Per Mile</label>
                        <input id="wfc_rjs_trucks_rate_per_mile" ng-model="truck.rjsmeta.wfc_rjs_trucks_rate_per_mile" type="text" class="form-control input-md">
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="control-label" for="wfc_rjs_trucks_size">Size</label>
                        <select id="wfc_rjs_trucks_size" name="wfc_rjs_trucks_size" ng-model="truck.rjsmeta.wfc_rjs_trucks_size">
                            <?php foreach( $size_array as $k => $v ): ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label" for="wfc_rjs_favorite">Add to favorite posts
                            <input type="checkbox" ng-model="truck.rjsmeta.wfc_rjs_trucks_add_to_favorite_posts" id="wfc_rjs_favorite" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="wfc_rjs_daily">Daily
                            <input type="checkbox" ng-model="truck.rjsmeta.wfc_rjs_trucks_daily" id="wfc_rjs_daily" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label" for="special-info">Special Information</label>
                        <br/>
                        <textarea class="form-control" rows="3" id="special-info" ng-model="truck.rjsmeta.wfc_rjs_trucks_special_information"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label" for="wfc_rjs_handle">Handle</label>
                        <input id="wfc_rjs_handle" ng-model="truck.rjsmeta.wfc_rjs_trucks_handle" type="text" class="form-control input-md">
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="wfc_rjs_handle_phone">Handle phone</label>
                        <input id="wfc_rjs_handle_phone" ng-model="truck.rjsmeta.wfc_rjs_trucks_handle_phone" type="text" class="form-control input-md">
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-success btn-sm">
                <span class="glyphicon glyphicon-flash"></span>
                Submit!
            </button>
            <button type="button" class="btn btn-danger btn-sm" ng-click="cancel()">Cancel</button>
        </form>
        <!-- {{ truck | json }} -->
    </div>
</script>