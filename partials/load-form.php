<script type="text/ng-template" id="rjsLoadForm.html">
    <div class="wfc-form-container">
        <div class="container">
            <form id="truckForm" name="truckForm" ng-submit="submitEditTruck(truckForm.$valid)" novalidate>
                <div class="row">
                    <h3 class="col-md-8 wfc-form-title">Single Load Posting</h3>
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
                                   ng-model="truck.rjsmeta.wfc_rjs_loads_origin_city"
                                   name="wfc_rjs_loads_origin_city"
                                   type="text"
                                   class="form-control input-md"
                                />
                            <label class="control-label wfc-section-title"
                                   for="wfc_rjs_loads_origin_state">Origin State
                            </label>
                            <select id="wfc_rjs_loads_origin_state"
                                    name="wfc_rjs_loads_origin_state"
                                    ng-init="truck.rjsmeta.wfc_rjs_loads_origin_state = truck.rjsmeta.wfc_rjs_loads_origin_state ||  usStates[1].value"
                                    ng-model="truck.rjsmeta.wfc_rjs_loads_origin_state"
                                    ng-options="option.value as option.name for option in usStates"></select>

                        </div>
                        <!-- END ORIGIN SECTION ROW -->
                        <div class="col-md-6 destination-city">
                            <label class="control-label wfc-section-title" for="dest_city">Dest. City</label>
                            <input id="dest_city"
                                   ng-model="truck.rjsmeta.wfc_rjs_loads_dest_city"
                                   name="wfc_rjs_loads_dest_city"
                                   type="text"
                                   class="form-control input-md">
                            <label class="control-label wfc-section-title"
                                   for="wfc_rjs_loads_dest_state">Dest. State
                            </label>
                            <select id="wfc_rjs_loads_dest_state"
                                    name="wfc_rjs_loads_dest_state"
                                    ng-init="truck.rjsmeta.wfc_rjs_loads_dest_state = truck.rjsmeta.wfc_rjs_loads_dest_state || usStates[1].value"
                                    ng-model="truck.rjsmeta.wfc_rjs_loads_dest_state"
                                    ng-options="option.value as option.name for option in usStates"></select>

                        </div>
                        <!-- END DESTINATION SECTION -->
                    </div>
                    <!-- END ROW -->
                    <div class="row trailer-type">
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title"
                                   for="wfc_rjs_loads_trailer_type">Trailer Type
                            </label>
                            <select id="wfc_rjs_loads_trailer_type"
                                    name="wfc_rjs_loads_trailer_type"
                                    ng-init="truck.rjsmeta.wfc_rjs_loads_trailer_type = truck.rjsmeta.wfc_rjs_loads_trailer_type || trailerTypes[0].value"
                                    ng-model="truck.rjsmeta.wfc_rjs_loads_trailer_type"
                                    ng-options="option.value as option.name for option in trailerTypes"></select>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title">Trailer Options</label>
                            <label class="control-label">Hazmat <input type="checkbox"
                                                                       ng-model="truck.rjsmeta.wfc_rjs_loads_to_hazmat"
                                                                       ng-true-value="'Yes'"
                                                                       ng-false-value="'No'">
                            </label>
                            <label class="control-label">Team <input type="checkbox"
                                                                     ng-model="truck.rjsmeta.wfc_rjs_loads_to_team"
                                                                     ng-true-value="'Yes'"
                                                                     ng-false-value="'No'">
                            </label>
                            <label class="control-label">Expedited <input type="checkbox"
                                                                          ng-model="truck.rjsmeta.wfc_rjs_loads_to_expedited"
                                                                          ng-true-value="'Yes'"
                                                                          ng-false-value="'No'">
                            </label>
                            <label class="control-label">Tarp <input type="checkbox"
                                                                     ng-model="truck.rjsmeta.wfc_rjs_loads_to_tarp"
                                                                     ng-true-value="'Yes'"
                                                                     ng-false-value="'No'">
                            </label>
                            <label class="control-label">Pallet Exchange <input type="checkbox"
                                                                                ng-model="truck.rjsmeta.wfc_rjs_loads_to_pallet_exchange"
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
                                       for="wfc_rjs_loads_amount">Amount
                                </label>
                                <input id="wfc_rjs_loads_amount"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_amount"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title" for="wfc_rjs_loads_width">Width</label>
                                <input id="wfc_rjs_loads_width"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_width"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4" ng-class="{'has-error': truckForm.wfc_rjs_loads_pickup_date.$invalid && truckForm.$submitted}">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_pickup_date">PickUp Date
                                    <span class="required">*</span>
                                </label>
                                <input ng-model="truck.rjsmeta.wfc_rjs_loads_pickup_date"
                                       type="text"
                                       name="wfc_rjs_loads_pickup_date"
                                       datepicker-popup="MM-dd-yyyy"
                                       datepicker-append-to-body="false"
                                       is-open="data.isOpen"
                                       ng-click="data.isOpen = true"
                                       ng-required="true"
                                       class="form-control input-md"
                                    />
                                <p ng-show="truckForm.wfc_rjs_loads_pickup_date.$invalid && truckForm.$submitted"
                                   class="help-block">Enter a Date.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title" for="wfc_rjs_loads_distance">Distance</label>
                                <input id="wfc_rjs_loads_distance"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_distance"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_qty">Qty
                                </label>
                                <input id="wfc_rjs_loads_qty"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_qty"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_pickup_time">PickUp Time
                                </label>
                                <input id="wfc_rjs_loads_pickup_time"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_pickup_time"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title" for="wfc_rjs_loads_length">Length</label>
                                <input id="wfc_rjs_loads_length"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_length"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_extra_stops">Extra Stops
                                </label>
                                <input id="wfc_rjs_loads_extra_stops"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_extra_stops"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_deliver_date">Deliver Date
                                </label>
                                <input ng-model="truck.rjsmeta.wfc_rjs_loads_deliver_date"
                                       type="text"
                                       name="wfc_rjs_loads_deliver_date"
                                       datepicker-popup="MM-dd-yyyy"
                                       datepicker-append-to-body="false"
                                       is-open="data.isOpenD"
                                       ng-click="data.isOpenD = true"
                                       class="form-control input-md"
                                    />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_weight">Weight
                                </label>
                                <input id="wfc_rjs_loads_weight"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_weight"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title" for="wfc_rjs_loads_size">Size</label>
                                <select id="wfc_rjs_loads_size"
                                        name="wfc_rjs_loads_size"
                                        ng-init="truck.rjsmeta.wfc_rjs_loads_size = truck.rjsmeta.wfc_rjs_loads_size || trailerSizes[0].value"
                                        ng-model="truck.rjsmeta.wfc_rjs_loads_size"
                                        ng-options="option.value as option.name for option in trailerSizes"></select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_deliver_time">Deliver Time
                                </label>
                                <input id="wfc_rjs_loads_deliver_time"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_deliver_time"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                        </div>
                    </section>
                    <div class="row favorite-daily">
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title" for="wfc_rjs_favorite">Add to favorite posts
                                <input type="checkbox"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_add_to_favorite_posts"
                                       id="wfc_rjs_favorite"
                                       ng-true-value="'Yes'"
                                       ng-false-value="'No'">
                            </label>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title" for="wfc_rjs_daily">Daily
                                <input type="checkbox"
                                       ng-model="truck.rjsmeta.wfc_rjs_loads_daily"
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
                                            ng-model="truck.rjsmeta.wfc_rjs_loads_special_information"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title" for="wfc_rjs_loads_handle">Handle</label>
                            <input id="wfc_rjs_loads_handle"
                                   ng-model="truck.rjsmeta.wfc_rjs_loads_handle"
                                   type="text"
                                   class="form-control input-md">
                        </div>
                        <div class="col-md-6">
                            <label class="control-label wfc-section-title"
                                   for="wfc_rjs_loads_handle_phone">Handle phone
                            </label>
                            <input id="wfc_rjs_loads_handle_phone"
                                   ng-model="truck.rjsmeta.wfc_rjs_loads_handle_phone"
                                   type="text"
                                   class="form-control input-md">
                        </div>
                    </div>
                </fieldset>
                <button type="button" class="btn btn-danger btn-md" ng-click="cancel()">Cancel</button>
                <button type="submit" class="btn btn-success btn-md">Post and Close</button>
            </form>
        </div>
    </div>
</script>