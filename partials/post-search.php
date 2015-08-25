<div class="row post-search-partial wfc-row">
    <span class="col-md-offset-1 col-md-10">
        <rjs-nav-section></rjs-nav-section>
    </span>
</div>
<div class="row wfc-form-row">
    <span class="col-md-1">
    </span>
    <span class="col-md-10">
        <search-form></search-form>
    </span>
</div>
<div class="row wfc-table-row">
    <span class="col-md-1">
    </span>
    <span class="col-md-10">
        <span class="wfc-table-loader col-md-offset-6 col-md-1 glyphicon glyphicon-refresh glyphicon-refresh-animate"
              ng-show="loading"></span>
        <table st-table="posts"
               class="table table-striped table-bordered"
            >
            <thead>
            <tr>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="post in posts">
                <td width="200">{{post.rjsmeta.wfc_rjs_trucks_special_information}}</td>
            </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </span>
    <span class="col-md-1">
    </span>
</div>