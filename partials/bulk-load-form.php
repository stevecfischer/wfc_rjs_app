<script type="text/ng-template" id="rjsBulkLoadForm.html">
    <h3>Multi-load Posting</h3>
    <div class="wfc-form-container">
        <div class="container">
            <div class="row">
                <form id="bulkTruckForm" name="bulk" ng-submit="addSingletruck(bulk.$valid)" novalidate>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label wfc-section-title" for="origin_city">Origin City</label>
                                <input id="origin_city"
                                       ng-model="bulksingletruckformdata.wfc_rjs_loads_origin_city"
                                       name="wfc_rjs_loads_origin_city"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-3">
                                <label class="control-label wfc-section-title" for="origin_state">Origin State</label>
                                <select id="origin_state"
                                        name="wfc_rjs_loads_origin_state"
                                        ng-init="bulksingletruckformdata.wfc_rjs_loads_origin_state = usStates[0].value"
                                        ng-model="bulksingletruckformdata.wfc_rjs_loads_origin_state"
                                        ng-options="option.value as option.name for option in usStates"></select>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label wfc-section-title" for="dest_city">Dest. City</label>
                                <input id="dest_city"
                                       ng-model="bulksingletruckformdata.wfc_rjs_loads_dest_city"
                                       name="wfc_rjs_loads_dest_city"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-3">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_dest_state">Dest. State
                                </label>
                                <select id="wfc_rjs_loads_dest_state"
                                        name="wfc_rjs_loads_dest_state"
                                        ng-init="bulksingletruckformdata.wfc_rjs_loads_dest_state = usStates[0].value"
                                        ng-model="bulksingletruckformdata.wfc_rjs_loads_dest_state"
                                        ng-options="option.value as option.name for option in usStates"></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label wfc-section-title">Trailer Options</label>
                                <label class="control-label">Hazmat <input type="checkbox"
                                                                           ng-model="bulksingletruckformdata.wfc_rjs_loads_to_hazmat"
                                                                           ng-true-value="'Yes'"
                                                                           ng-false-value="'No'">
                                </label>
                                <label class="control-label">Team <input type="checkbox"
                                                                         ng-model="bulksingletruckformdata.wfc_rjs_loads_to_team"
                                                                         ng-true-value="'Yes'"
                                                                         ng-false-value="'No'">
                                </label>
                                <label class="control-label">Expedited <input type="checkbox"
                                                                              ng-model="bulksingletruckformdata.wfc_rjs_loads_to_expedited"
                                                                              ng-true-value="'Yes'"
                                                                              ng-false-value="'No'">
                                </label>
                                <label class="control-label">Tarp <input type="checkbox"
                                                                         ng-model="bulksingletruckformdata.wfc_rjs_loads_to_tarp"
                                                                         ng-true-value="'Yes'"
                                                                         ng-false-value="'No'">
                                </label>
                                <label class="control-label">Pallet Exchange <input type="checkbox"
                                                                                    ng-model="bulksingletruckformdata.wfc_rjs_loads_to_pallet_exchange"
                                                                                    ng-true-value="'Yes'"
                                                                                    ng-false-value="'No'">
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_trailer_type">Trailer Type
                                </label>
                                <select id="wfc_rjs_loads_trailer_type"
                                        name="wfc_rjs_loads_trailer_type"
                                        ng-init="bulksingletruckformdata.wfc_rjs_loads_trailer_type = trailerTypes[0].value"
                                        ng-model="bulksingletruckformdata.wfc_rjs_loads_trailer_type"
                                        ng-options="option.value as option.name for option in trailerTypes"></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_distance">Miles
                                </label>
                                <input id="wfc_rjs_loads_distance"
                                       ng-model="bulksingletruckformdata.wfc_rjs_loads_distance"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title">Partial <br/><input type="checkbox"
                                                                            ng-model="bulksingletruckformdata.wfc_rjs_loads_size"
                                                                            ng-true-value="'Partial/LTL'"
                                                                            ng-false-value="'No'">
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_weight">Weight
                                </label>
                                <input id="wfc_rjs_loads_weight"
                                       ng-model="bulksingletruckformdata.wfc_rjs_loads_weight"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" ng-class="{'has-error': bulk.wfc_rjs_loads_pickup_date.$invalid && bulk.$submitted}">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_pickup_date">Date Available
                                    <span class="required">*</span>
                                </label>
                                <input ng-model="bulksingletruckformdata.wfc_rjs_loads_pickup_date"
                                       type="text"
                                       name="wfc_rjs_loads_pickup_date"
                                       datepicker-popup="MM-dd-yyyy"
                                       datepicker-append-to-body="false"
                                       is-open="data.isOpen"
                                       ng-click="data.isOpen = true"
                                       ng-required="true"
                                       class="form-control input-md"
                                    />
                                <p ng-show="bulk.wfc_rjs_loads_pickup_date.$invalid && bulk.$submitted"
                                   class="help-block">Enter a Date.</p>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_amount">Payment
                                </label>
                                <input id="wfc_rjs_loads_amount"
                                       ng-model="bulksingletruckformdata.wfc_rjs_loads_amount"
                                       type="text"
                                       class="form-control input-md">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label wfc-section-title"
                                       for="wfc_rjs_loads_qty">Quantity
                                </label>
                                <input id="wfc_rjs_loads_qty"
                                       ng-model="bulksingletruckformdata.wfc_rjs_loads_qty"
                                       type="text"
                                       class="form-control input-md">
                            </div>

                        </div>
                        <div class="row special-information">
                            <div class="col-md-12">
                                <label class="control-label wfc-section-title"
                                       for="textarea">Special Information
                                </label>
                                <textarea id="textarea"
                                          ng-model="bulksingletruckformdata.wfc_rjs_loads_special_information"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit"
                                        class="btn btn-success btn-md single-truck">Add To Queue
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Origin City</th>
                            <th>State</th>
                            <th>Dest. City</th>
                            <th>State</th>
                            <th>Trailer Type</th>
                            <th>Options</th>
                            <th>Miles</th>
                            <th>P/F</th>
                            <th>Weight</th>
                            <th>Pickup Date</th>
                            <th>Payment</th>
                            <th>QTY</th>
                            <th>Special Info</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <body>
                        <tr ng-repeat="singleTruck in bulkTrucks track by $index">
                            <td>{{ singleTruck.wfc_rjs_loads_origin_city }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_origin_state }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_dest_city }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_dest_state }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_trailer_type }}</td>
                            <td>{{ singleTruck | scfTrailerOptionsConcat }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_distance }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_size }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_weight }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_pickup_date | date:"M/dd/yy" }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_amount }}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_qty}}</td>
                            <td>{{ singleTruck.wfc_rjs_loads_special_information}}</td>
                            <td>
                                <button type="button" ng-click="removeSingletruck($index)">Remove Load</button>
                            </td>
                        </tr>
                        </body>
                    </table>
                </div>
            </div>
            <!-- END .ROW-->
            <div class="row">
                <div class="col-md-6">
                    <!--DIV IS EMPTY ON PURPOSE-->
                </div>
                <div class="col-md-6">
                    <form ng-submit="submitBulkTruck()">
                        <button type="button" class="btn btn-danger btn-md" ng-click="cancel()">Cancel</button>
                        <button type="submit" class="btn btn-success btn-md">Post and Close</button>
                    </form>
                </div>
            </div>
            <!-- END ROW -->
        </div>
        <!-- END CONTAINER -->
    </div>
</script>