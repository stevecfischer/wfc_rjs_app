<h3>Search</h3>
<div class="wfc-form-container">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!--DIV IS EMPTY ON PURPOSE-->
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <div class="row">
            <form id="searchForm" name="search" ng-submit="searchPost(search.$valid)" novalidate>
                <fieldset>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label wfc-section-title" for="origin_city">Origin City</label>
                            <input id="origin_city"
                                       name="wfc_rjs_trucks_origin_city"
                                       type="text"
                                       class="form-control input-md">

                            Search for: <input type="search" name="s" ng-model="filter.s"/>
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
        </div>
    </div>
    <!-- END CONTAINER -->
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
                <td colspan="13" class="text-center">
                    <input st-search placeholder="global search" class="input-sm form-control" type="search"/>
                </td>
            </tr>
            <tr>
                <th >Description</th>
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