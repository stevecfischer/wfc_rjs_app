<script type="text/ng-template" id="rjsLoadForm.html">
    <h3>Load Form</h3>
    <form ng-submit="submitEditTruck()">
        <fieldset class="">
            <span class="row">
                <div class="col-md-4">
                    <label class="control-label" for="origin_city">Origin City</label>
                    <input id="origin_city" ng-model="truck.rjsmeta.wfc_rjs_trucks_origin_city" name="wfc_rjs_trucks_origin_city" type="text" class="form-control input-md">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label" for="wfc_rjs_trucks_origin_radius">Radius</label>
                            <input id="wfc_rjs_trucks_origin_radius" ng-model="truck.rjsmeta.wfc_rjs_trucks_origin_radius" name="wfc_rjs_trucks_origin_radius" type="text" class="form-control input-md">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="control-label" for="origin_state">Origin State</label>
                    <select id="origin_state" ng-model="truck.rjsmeta.wfc_rjs_trucks_origin_state" name="wfc_rjs_loads_origin_state">
                        <?php foreach( $us_states_array as $k => $v ): ?>
                            <option value="<?php echo $k ?>"><?php echo $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="dest_city">Dest. City</label>
                    <input id="dest_city" ng-model="truck.rjsmeta.wfc_rjs_trucks_dest_city" name="wfc_rjs_loads_dest_city" type="text" class="form-control input-md">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label" for="wfc_rjs_trucks_dest_radius">Radius</label>
                            <input id="wfc_rjs_trucks_dest_radius" ng-model="truck.rjsmeta.wfc_rjs_trucks_dest_radius" type="text" class="form-control input-md">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="control-label" for="selectbasic">Dest. State</label>
                    <select id="selectbasic" ng-model="truck.rjsmeta.wfc_rjs_trucks_dest_state" name="wfc_rjs_loads_dest_state">
                        <?php foreach( $us_states_array as $k => $v ): ?>
                            <option value="<?php echo $k ?>"><?php echo $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </span>
            <span class="row">
                <div class="">
                    <div class="col-md-6">
                        <label class="control-label" for="wfc_rjs_trucks_trailer_type">Trailer Type</label>
                        <select id="wfc_rjs_trucks_trailer_type" name="wfc_rjs_trucks_trailer_type" ng-model="truck.rjsmeta.wfc_rjs_trucks_trailer_type">
                            <?php foreach( $rjs_trailer_type as $k => $v ): ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="">
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
            </span>
            <span class="row">
                <div class="col-md-4">
                    <label class="control-label" for="wfc_rjs_trucks_weight">Weight</label>
                    <input id="wfc_rjs_trucks_weight" ng-model="truck.rjsmeta.wfc_rjs_trucks_weight" type="text" class="form-control input-md">
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="wfc_rjs_trucks_min_distance">Min Distance</label>
                    <input id="wfc_rjs_trucks_min_distance" ng-model="truck.rjsmeta.wfc_rjs_trucks_min_distance" type="text" class="form-control input-md">
                </div>
                <div class="col-md-4">
                    <!--<p class="input-group">
                        <input type="text" class="form-control" datepicker-popup ng-model="truck.rjsmeta.wfc_rjs_trucks_pickup_date" is-open="opened"/>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" ng-click="open($event)">
                                <i class="glyphicon glyphicon-calendar"></i></button>
                        </span>
                    </p>-->
                    <label class="control-label" for="wfc_rjs_trucks_pickup_date">Date Available</label>
                    <input id="wfc_rjs_trucks_pickup_date" ng-model="truck.rjsmeta.wfc_rjs_trucks_pickup_date" type="date" class="form-control input-md" name="wfc_rjs_trucks_pickup_date">
                </div>
            </span>
            <span class="row">
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
            </span>
            <span class="row">
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
            </span>
            <span class="row">
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
            </span>
            <span class="row">
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
            </span>
            <span class="row">
                <div class="col-md-12">
                    <label class="control-label" for="textarea">Special Information</label>
                    <textarea id="textarea" ng-model="truck.rjsmeta.wfc_rjs_trucks_special_information"></textarea>
                </div>
            </span>
            <span class="row">
                <div class="col-md-6">
                    <label class="control-label" for="wfc_rjs_handle">Handle</label>
                    <input id="wfc_rjs_handle" ng-model="truck.rjsmeta.wfc_rjs_trucks_handle" type="text" class="form-control input-md">
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="wfc_rjs_handle_phone">Handle phone</label>
                    <input id="wfc_rjs_handle_phone" ng-model="truck.rjsmeta.wfc_rjs_trucks_handle_phone" type="text" class="form-control input-md">
                </div>
            </span>
        </fieldset>
        <button type="submit" class="btn btn-success btn-lg btn-block">
            <span class="glyphicon glyphicon-flash"></span>
            Submit!
        </button>
    </form>
</script>