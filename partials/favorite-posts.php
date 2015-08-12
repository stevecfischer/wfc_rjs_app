<script type="text/ng-template" id="rjsFavorite.html">
    <div class="container">
        <div class="row">
            <table st-table="favTrucks" st-safe-src="rowFavCollection" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th></th>
                    <th>**DEBUG Origin City</th>
                    <th>Tools</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="quicktruck in favTrucks">
                    <td>{{quicktruck.rjsmeta.wfc_rjs_trucks_origin_city}}</td>
                    <td>
                        <a ng-click="editing = true"><i class="glyphicon glyphicon-pencil"></i></a>
                        <form name="editFavTruck" ng-show="editing" ng-submit="editFavoriteTruck(editFavTruck.$valid)" novalidate class="col-md-10">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="control-label" for="origin_city">Origin</label>
                                        <input id="origin_city" ng-model="quicktruck.rjsmeta.wfc_rjs_trucks_origin_city" name="wfc_rjs_trucks_origin_city" type="text" class="form-control input-md">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label" for="wfc_rjs_trucks_pickup_date">Date</label>
                                        <input id="wfc_rjs_trucks_pickup_date" ng-model="quicktruck.rjsmeta.wfc_rjs_trucks_pickup_date" name="wfc_rjs_trucks_pickup_date" type="date" required>
                                        <p ng-show="quicktruck.rjsmeta.wfc_rjs_trucks_pickup_date.$invalid && !quicktruck.rjsmeta.wfc_rjs_trucks_pickup_date.$pristine" class="help-block">Enter a Date.</p>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-sm" type="submit">Update</button>
                                <button class="btn btn-danger btn-sm" type="button" ng-click="editing = false">Cancel</button>
                            </fieldset>
                        </form>
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
        </div>
    </div>
    <!--    {{rowFavCollection | json }}-->
</script>