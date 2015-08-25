<div class="row post-truck-partial wfc-row">
    <span class="col-md-12">
        <rjs-nav-section></rjs-nav-section>
    </span>
</div>
<div class="row wfc-form-row">
    <span class="col-md-12">
        <search-form></search-form>
    </span>
</div>
<div class="row wfc-table-row">
    <span class="col-md-12">
        <span class="wfc-table-loader col-md-offset-6 col-md-1 glyphicon glyphicon-refresh glyphicon-refresh-animate"
              ng-show="loading"></span>
        <table st-table="posts"
               st-safe-src="rowCollection"
               class="table table-striped table-bordered"
               ng-show="!loading">
            <thead>
            <tr>
                <th>Origin City</th>
                <th>Origin State</th>
                <th>Dest City</th>
                <th>Dest State</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="post in posts">
                <td>{{post.rjsmeta.wfc_rjs_trucks_origin_city}}</td>
                <td>{{post.rjsmeta.wfc_rjs_trucks_origin_state}}</td>
                <td>{{post.rjsmeta.wfc_rjs_trucks_dest_city}}</td>
                <td>{{post.rjsmeta.wfc_rjs_trucks_dest_state}}</td>
                <td>{{post.rjsmeta.trailerOptions.join(', ')}}</td>
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