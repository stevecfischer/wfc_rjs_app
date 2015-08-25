<div class="row post-truck-partial wfc-row">
    <span class="col-md-12">
        <rjs-nav-section></rjs-nav-section>
    </span>
</div>
<div class="row wfc-form-row">
    <form name="quickNewTruck" ng-submit="quickTruckPost(quickNewTruck.$valid)" novalidate class="col-md-12">
        <fieldset>
            <div class="row">
                <div class="col-md-2">
                    <label class="control-label" for="wfc_rjs_trucks_origin_city">Origin</label>
                    <input id="wfc_rjs_trucks_origin_city"
                           ng-model="quicktruck.wfc_rjs_trucks_origin_city"
                           name="wfc_rjs_trucks_origin_city"
                           type="text"
                           class="form-control input-md"
                        />
                </div>
                <div class="col-md-1">
                    <label class="control-label" for="wfc_rjs_trucks_origin_state">St</label>
                    <br/> <select id="wfc_rjs_trucks_origin_state"
                                  name="wfc_rjs_trucks_origin_state"
                                  ng-init="quicktruck.wfc_rjs_trucks_origin_state = usStates[0].value"
                                  ng-model="quicktruck.wfc_rjs_trucks_origin_state"
                                  ng-options="option.value as option.name for option in usStates">
                        <option value="no">default</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="control-label" for="wfc_rjs_trucks_trailer_type">Eq</label>
                    <br/> <select id="wfc_rjs_trucks_trailer_type"
                                  name="wfc_rjs_trucks_trailer_type"
                                  ng-init="quicktruck.wfc_rjs_trucks_trailer_type = trailerTypes[0].value"
                                  ng-model="quicktruck.wfc_rjs_trucks_trailer_type"
                                  ng-options="option.value as option.name for option in trailerTypes"></select>
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
                    <br/>
                    <label class="control-label">LTL <input type="checkbox"
                                                            ng-model="quicktruck.wfc_rjs_trucks_size"
                                                            ng-true-value="'partial'"
                                                            ng-false-value="'No'">
                    </label>
                </div>
                <div class="col-md-3"
                     ng-class="{'has-error': quickNewTruck.wfc_rjs_trucks_pickup_date.$invalid && quickNewTruck.$submitted}">
                    <label class="control-label" for="wfc_rjs_trucks_pickup_date">Date</label>
                    <br/> <input ng-model="quicktruck.wfc_rjs_trucks_pickup_date"
                                 type="text"
                                 name="wfc_rjs_trucks_pickup_date"
                                 datepicker-popup="MM-dd-yyyy"
                                 datepicker-append-to-body="true"
                                 is-open="data.isOpen"
                                 ng-click="data.isOpen = true"
                                 ng-required="true"
                                 class="form-control input-md"
                        />
                    <p ng-show="quickNewTruck.wfc_rjs_trucks_pickup_date.$invalid && quickNewTruck.$submitted"
                       class="help-block">Enter a Date.</p>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-md">Add Truck</button>
        </fieldset>
    </form>
</div>
<div class="row wfc-table-row">
    <span class="col-md-12">
        <span class="wfc-table-loader col-md-offset-6 col-md-1 glyphicon glyphicon-refresh glyphicon-refresh-animate"
              ng-show="loading"></span>
        <table st-table="trucks"
               st-safe-src="rowCollection"
               class="table table-striped table-bordered"
               ng-show="!loading">
            <thead>
            <tr>
                <th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()"/></th>
                <!--<th>**DEBUG Origin City</th>
                <th>**DEBUG Origin State</th>-->
                <th st-sort="rjsmeta.wfc_rjs_trucks_trailer_type">Equipment</th>
                <th st-sort="rjsmeta.trailerOptions">Options</th>
                <th>Full/Partial</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_pickup_date">Date Available</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_rate_per_mile">$/Mile</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_special_information">Description</th>
                <th st-sort="rjsmeta.wfc_rjs_trucks_handle">Handle</th>
                <th>Handle Phone</th>
                <th>Tools</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="truck in trucks">
                <td width="20"><input type="checkbox"
                        ng-checked="bulkDeleteSelected.indexOf(truck) > -1"
                       ng-click="toggleBulk(truck)"
                        /></td>
                <!--<td>{{truck.rjsmeta.wfc_rjs_trucks_origin_city}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_origin_state}}</td>-->
                <td width="20">{{truck.rjsmeta.wfc_rjs_trucks_trailer_type}}</td>
                <td>{{truck.rjsmeta.trailerOptions.join(', ')}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_size}}</td>
                <td width="200">{{truck.rjsmeta.wfc_rjs_trucks_pickup_date | date:"M/dd/yy"}}</td>
                <td width="20">{{truck.rjsmeta.wfc_rjs_trucks_rate_per_mile}}</td>
                <td width="200">{{truck.rjsmeta.wfc_rjs_trucks_special_information}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_handle}}</td>
                <td>{{truck.rjsmeta.wfc_rjs_trucks_handle_phone}}</td>
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
                    <div><!-- Total number of Trucks: {{rowCollection.length}} --></div>
                </td>
            </tr>
            </tfoot>
        </table>
    </span>
</div>
<rjs-footer></rjs-footer>