<script type="text/ng-template" id="rjsTruckForm.html">
    <div class="wfc-form-container">
        <div class="container">
            <form id="truckForm" name="truckForm" ng-submit="submitEditTruck(truckForm.$valid)" novalidate>
                <div class="row">
                    <h3 class="col-md-8 wfc-form-title">Single Truck Posting</h3>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger btn-md" ng-click="cancel()">Cancel</button>
                        <button type="submit" class="btn btn-success btn-md">Post and Close</button>
                    </div>
                </div>
                <fieldset class="">
                    <div class="row">
                        <div class="col-md-6 origin-section">
                            <label class="control-label wfc-section-title" for="origin_city">Origin City</label>
                            <input id="origin_city"
                                   ng-model="truck.rjsmeta.wfc_rjs_trucks_origin_city"
                                   name="wfc_rjs_trucks_origin_city"
                                   type="text"
                                   class="form-control input-md"
                                />
                            <label class="control-label wfc-section-title"
                                   for="wfc_rjs_trucks_origin_state">Origin State
                            </label>
                            <select id="wfc_rjs_trucks_origin_state"
                                    name="wfc_rjs_trucks_origin_state"
                                    ng-init="truck.rjsmeta.wfc_rjs_trucks_origin_state = truck.rjsmeta.wfc_rjs_trucks_origin_state ||  usStates[1].value"
                                    ng-model="truck.rjsmeta.wfc_rjs_trucks_origin_state"
                                    ng-options="option.value as option.name for option in usStates"></select>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label wfc-section-title"
                                           for="wfc_rjs_trucks_origin_radius">Radius
                                    </label>
                                    <input id="wfc_rjs_trucks_origin_radius"
                                           ng-model="truck.rjsmeta.wfc_rjs_trucks_origin_radius"
                                           name="wfc_rjs_trucks_origin_radius"
                                           type="text"
                                           class="form-control input-md">
                                </div>
                            </div>
                        </div>
                        <!-- END ORIGIN SECTION ROW -->
                        <div class="col-md-6 destination-city">
                            <label class="control-label wfc-section-title" for="dest_city">Dest. City</label>
                            <input id="dest_city"
                                   ng-model="truck.rjsmeta.wfc_rjs_trucks_dest_city"
                                   name="wfc_rjs_trucks_dest_city"
                                   type="text"
                                   class="form-control input-md">
                            <label class="control-label wfc-section-title"
                                   for="wfc_rjs_trucks_dest_state">Dest. State
                            </label>
                            <select id="wfc_rjs_trucks_dest_state"
                                    name="wfc_rjs_trucks_dest_state"
                                    ng-init="truck.rjsmeta.wfc_rjs_trucks_dest_state = truck.rjsmeta.wfc_rjs_trucks_dest_state || usStates[1].value"
                                    ng-model="truck.rjsmeta.wfc_rjs_trucks_dest_state"
                                    ng-options="option.value as option.name for option in usStates"></select>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label wfc-section-title"
                                           for="wfc_rjs_trucks_dest_radius">Radius
                                    </label>
                                    <input id="wfc_rjs_trucks_dest_radius"
                                           ng-model="truck.rjsmeta.wfc_rjs_trucks_dest_radius"
                                           type="text"
                                           class="form-control input-md">
                                </div>
                            </div>
                        </div>
                        <!-- END DESTINATION SECTION -->
                    </div>
                    <!-- END ROW -->
                    <div class="row trailer-type">
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title"
                                   for="wfc_rjs_trucks_trailer_type">Trailer Type
                            </label>
                            <select id="wfc_rjs_trucks_trailer_type"
                                    name="wfc_rjs_trucks_trailer_type"
                                    ng-init="truck.rjsmeta.wfc_rjs_trucks_trailer_type = truck.rjsmeta.wfc_rjs_trucks_trailer_type || trailerTypes[0].value"
                                    ng-model="truck.rjsmeta.wfc_rjs_trucks_trailer_type"
                                    ng-options="option.value as option.name for option in trailerTypes"></select>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title">Trailer Options</label>
                            <label class="control-label">Hazmat <input type="checkbox"
                                                                       ng-model="truck.rjsmeta.wfc_rjs_trucks_to_hazmat"
                                                                       ng-true-value="'Yes'"
                                                                       ng-false-value="'No'">
                            </label>
                            <label class="control-label">Team <input type="checkbox"
                                                                     ng-model="truck.rjsmeta.wfc_rjs_trucks_to_team"
                                                                     ng-true-value="'Yes'"
                                                                     ng-false-value="'No'">
                            </label>
                            <label class="control-label">Expedited <input type="checkbox"
                                                                          ng-model="truck.rjsmeta.wfc_rjs_trucks_to_expedited"
                                                                          ng-true-value="'Yes'"
                                                                          ng-false-value="'No'">
                            </label>
                            <label class="control-label">Tarp <input type="checkbox"
                                                                     ng-model="truck.rjsmeta.wfc_rjs_trucks_to_tarp"
                                                                     ng-true-value="'Yes'"
                                                                     ng-false-value="'No'">
                            </label>
                            <label class="control-label">Pallet Exchange <input type="checkbox"
                                                                                ng-model="truck.rjsmeta.wfc_rjs_trucks_to_pallet_exchange"
                                                                                ng-true-value="'Yes'"
                                                                                ng-false-value="'No'">
                            </label>
                        </div>
                    </div>
                    <section id="other-criteria">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>OTHER CRITERIA</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_trucks_weight">Weight
                                </label>
                                <input id="wfc_rjs_trucks_weight"
                                       ng-model="truck.rjsmeta.wfc_rjs_trucks_weight"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_trucks_min_distance">Min Distance
                                </label>
                                <input id="wfc_rjs_trucks_min_distance"
                                       ng-model="truck.rjsmeta.wfc_rjs_trucks_min_distance"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4"
                                 ng-class="{'has-error': truckForm.wfc_rjs_trucks_pickup_date.$invalid && truckForm.$submitted}">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_trucks_pickup_date">Date Available
                                    <span class="required">*</span>
                                </label>
                                <input ng-model="truck.rjsmeta.wfc_rjs_trucks_pickup_date"
                                       type="text"
                                       name="wfc_rjs_trucks_pickup_date"
                                       datepicker-popup="MM-dd-yyyy"
                                       datepicker-append-to-body="false"
                                       is-open="data.isOpen"
                                       ng-click="data.isOpen = true"
                                       ng-required="true"
                                       class="form-control input-md"
                                    />
                                <p ng-show="truckForm.wfc_rjs_trucks_pickup_date.$invalid && truckForm.$submitted"
                                   class="help-block">Enter a Date.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title" for="wfc_rjs_trucks_width">Width</label>
                                <input id="wfc_rjs_trucks_width"
                                       ng-model="truck.rjsmeta.wfc_rjs_trucks_width"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_trucks_length">Length
                                </label>
                                <input id="wfc_rjs_trucks_length"
                                       ng-model="truck.rjsmeta.wfc_rjs_trucks_length"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title" for="wfc_rjs_trucks_qty">Qty</label>
                                <input id="wfc_rjs_trucks_length"
                                       ng-model="truck.rjsmeta.wfc_rjs_trucks_qty"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_trucks_qty">Rate Per Mile
                                </label>
                                <input id="wfc_rjs_trucks_rate_per_mile"
                                       ng-model="truck.rjsmeta.wfc_rjs_trucks_rate_per_mile"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title" for="wfc_rjs_trucks_size">Size</label>
                                <select id="wfc_rjs_trucks_size"
                                        name="wfc_rjs_trucks_size"
                                        ng-init="truck.rjsmeta.wfc_rjs_trucks_size = truck.rjsmeta.wfc_rjs_trucks_size || trailerSizes[0].value"
                                        ng-model="truck.rjsmeta.wfc_rjs_trucks_size"
                                        ng-options="option.value as option.name for option in trailerSizes"></select>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </section>
                    <div class="row favorite-daily">
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title" for="wfc_rjs_favorite">Add to favorite posts
                                <input type="checkbox"
                                       ng-model="truck.rjsmeta.wfc_rjs_trucks_add_to_favorite_posts"
                                       id="wfc_rjs_favorite"
                                       ng-true-value="'Yes'"
                                       ng-false-value="'No'">
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title" for="wfc_rjs_daily">Daily
                                <input type="checkbox"
                                       ng-model="truck.rjsmeta.wfc_rjs_trucks_daily"
                                       id="wfc_rjs_daily"
                                       ng-true-value="'Yes'"
                                       ng-false-value="'No'">
                            </label>
                        </div>
                    </div>
                    <div class="row special-information">
                        <div class="col-md-12">
                            <label class="control-label wfc-section-title"
                                   for="special-info">Special Information
                            </label>
                            <br/> <textarea class="form-control"
                                            rows="3"
                                            id="special-info"
                                            ng-model="truck.rjsmeta.wfc_rjs_trucks_special_information"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title" for="wfc_rjs_handle">Handle</label>
                            <input id="wfc_rjs_handle"
                                   ng-model="truck.rjsmeta.wfc_rjs_trucks_handle"
                                   type="text"
                                   class="form-control input-md">
                        </div>
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title"
                                   for="wfc_rjs_handle_phone">Handle phone
                            </label>
                            <input id="wfc_rjs_handle_phone"
                                   ng-model="truck.rjsmeta.wfc_rjs_trucks_handle_phone"
                                   type="text"
                                   class="form-control input-md">
                        </div>
                    </div>
                </fieldset>
                <button type="button" class="btn btn-danger btn-md" ng-click="cancel()">Cancel</button>
                <button type="submit" class="btn btn-success btn-md">Post and Close</button>
            </form>
            <!-- {{ truck | json }} -->
        </div>
    </div>
</script>