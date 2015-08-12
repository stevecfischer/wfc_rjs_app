    <div class="container">
        <div class="row">
            <fieldset>
                <div class="row">
                    <div class="col-md-2">
                        <label class="control-label" for="origin_city">Origin City</label>
                        <input id="origin_city" ng-model="wfc_rjs_trucks_origin_city" name="wfc_rjs_trucks_origin_city" type="text" class="form-control input-md">
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" for="origin_state">Origin State</label>
                        <select id="origin_state" ng-model="wfc_rjs_trucks_origin_state" name="wfc_rjs_loads_origin_state">
                            <?php foreach( $us_states_array as $k => $v ): ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" for="dest_city">Dest. City</label>
                        <input id="dest_city" ng-model="wfc_rjs_trucks_dest_city" name="wfc_rjs_loads_dest_city" type="text" class="form-control input-md">
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" for="selectbasic">Dest. State</label>
                        <select id="selectbasic" ng-model="wfc_rjs_trucks_dest_state" name="wfc_rjs_loads_dest_state">
                            <?php foreach( $us_states_array as $k => $v ): ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label">Trailer Options</label>
                        <label class="control-label">Hazmat
                            <input type="checkbox" ng-model="wfc_rjs_trucks_to_hazmat" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                        <label class="control-label">Team
                            <input type="checkbox" ng-model="wfc_rjs_trucks_to_team" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                        <label class="control-label">Expedited
                            <input type="checkbox" ng-model="wfc_rjs_trucks_to_expedited" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                        <label class="control-label">Tarp
                            <input type="checkbox" ng-model="wfc_rjs_trucks_to_tarp" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                        <label class="control-label">Pallet Exchange
                            <input type="checkbox" ng-model="wfc_rjs_trucks_to_pallet_exchange" ng-true-value="'Yes'" ng-false-value="'No'">
                        </label>
                    </div>
                    <div class="col-md-2">
                        <label class="control-label" for="wfc_rjs_trucks_trailer_type">Trailer Type</label>
                        <select id="wfc_rjs_trucks_trailer_type" ng-model="wfc_rjs_trucks_trailer_type">
                            <?php foreach( $rjs_trailer_type as $k => $v ): ?>
                                <option value="<?php echo $k ?>"><?php echo $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <button type="button" ng-click="quickTruckPost()">Add Truck</button>
            </fieldset>
        </div>
    </div>
