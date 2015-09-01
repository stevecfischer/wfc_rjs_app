<div class="row wfc-row">
    <span class="col-md-offset-1 col-md-2">
        <button ng-click="bulkDeleteTrucks()"
                ng-disabled="disableBulk"
                class="btn btn-success btn-md">Bulk Delete
        </button>
    </span>
    <span class="col-md-2">
        <button class="btn btn-info btn-md" type="button" ng-csv="getExportArray()" text-delimiter="\"  filename="export.csv">Export</button>
    </span>
</div>