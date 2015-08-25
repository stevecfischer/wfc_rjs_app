<form id="searchForm" name="search" ng-submit="searchPost(search.$valid)" novalidate>
    <fieldset>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label wfc-section-title" for="origin_city">Origin City</label>
                <input id="origin_city"
                       name="wfc_rjs_trucks_origin_city"
                       type="text"
                       class="form-control input-md">
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