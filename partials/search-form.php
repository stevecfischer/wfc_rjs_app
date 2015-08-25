<form id="searchForm" name="searchForm" ng-submit="searchPost(searchForm.$valid)" novalidate>
    <fieldset>
        <div class="row">
            <div class="col-md-6 origin-section">
                <label class="control-label wfc-section-title" for="origin_city">Origin City</label>
                <input id="origin_city"
                       ng-model="search.rjsmeta.wfc_rjs_trucks_origin_city"
                       name="wfc_rjs_trucks_origin_city"
                       type="text"
                       class="form-control input-md"
                    />
                <label class="control-label wfc-section-title"
                       for="wfc_rjs_trucks_origin_state">Origin State
                </label>
                <select id="wfc_rjs_trucks_origin_state"
                        name="wfc_rjs_trucks_origin_state"
                        ng-model="search.rjsmeta.wfc_rjs_trucks_origin_state"
                        ng-options="option.value as option.name for option in usStates"></select>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label wfc-section-title"
                               for="wfc_rjs_trucks_origin_radius">Radius
                        </label>
                        <input id="wfc_rjs_trucks_origin_radius"
                               ng-model="search.rjsmeta.wfc_rjs_trucks_origin_radius"
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
                       ng-model="search.rjsmeta.wfc_rjs_trucks_dest_city"
                       name="wfc_rjs_trucks_dest_city"
                       type="text"
                       class="form-control input-md">
                <label class="control-label wfc-section-title"
                       for="wfc_rjs_trucks_dest_state">Dest. State
                </label>
                <select id="wfc_rjs_trucks_dest_state"
                        name="wfc_rjs_trucks_dest_state"
                        ng-model="search.rjsmeta.wfc_rjs_trucks_dest_state"
                        ng-options="option.value as option.name for option in usStates"></select>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label wfc-section-title"
                               for="wfc_rjs_trucks_dest_radius">Radius
                        </label>
                        <input id="wfc_rjs_trucks_dest_radius"
                               ng-model="search.rjsmeta.wfc_rjs_trucks_dest_radius"
                               type="text"
                               class="form-control input-md">
                    </div>
                </div>
            </div>
        </div>
        <div class="row trailer-type">
            <div class="col-md-6">
                <label class="control-label wfc-section-title"
                       for="wfc_rjs_trucks_trailer_type">Trailer Type
                </label>
                <select id="wfc_rjs_trucks_trailer_type"
                        name="wfc_rjs_trucks_trailer_type"
                        ng-model="search.rjsmeta.wfc_rjs_trucks_trailer_type"
                        ng-options="option.value as option.name for option in trailerTypes"></select>
            </div>
            <div class="col-md-6">
                <label class="control-label wfc-section-title">Trailer Options</label>
                <label class="control-label">Hazmat <input type="checkbox"
                                                           ng-model="search.rjsmeta.wfc_rjs_trucks_to_hazmat"
                                                           ng-true-value="'Yes'"
                                                           ng-false-value="'No'">
                </label>
                <label class="control-label">Team <input type="checkbox"
                                                         ng-model="search.rjsmeta.wfc_rjs_trucks_to_team"
                                                         ng-true-value="'Yes'"
                                                         ng-false-value="'No'">
                </label>
                <label class="control-label">Expedited <input type="checkbox"
                                                              ng-model="search.rjsmeta.wfc_rjs_trucks_to_expedited"
                                                              ng-true-value="'Yes'"
                                                              ng-false-value="'No'">
                </label>
                <label class="control-label">Tarp <input type="checkbox"
                                                         ng-model="search.rjsmeta.wfc_rjs_trucks_to_tarp"
                                                         ng-true-value="'Yes'"
                                                         ng-false-value="'No'">
                </label>
                <label class="control-label">Pallet Exchange <input type="checkbox"
                                                                    ng-model="search.rjsmeta.wfc_rjs_trucks_to_pallet_exchange"
                                                                    ng-true-value="'Yes'"
                                                                    ng-false-value="'No'">
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <button type="submit"
                        class="btn btn-success btn-md single-truck">Search
                </button>
            </div>
        </div>
    </fieldset>
</form>