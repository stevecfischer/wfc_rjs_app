<?php acf_form_head(); ?>
<?php get_header(); ?>
<div ng-controller="TruckController">
    <div class="clearfloat"></div>
    <div class="container-fluid">
        <div id="wfc-rjs-container">
            <div class="row">
                <span class="col-lg-1">
                    <div>
                        <?php require_once WPRJS_PARTIALS_PATH."truck-form.php"; ?>
                        <?php require_once WPRJS_PARTIALS_PATH."bulk-truck-form.php"; ?>
                    </div>
                </span>
                <span class="col-lg-7 wfc-quick-post-form rjs-quick-form">
<!--                    --><?php //require_once WPRJS_PARTIALS_PATH."quick-truck-form.php"; ?>
                </span>
                <span class="col-lg-1">
                </span>
            </div>
            <div ng-view></div>
        </div>
    </div>
    <div class="modal fade" id="newPost" tabindex="-1" role="dialog" aria-labelledby="postLoadLabel">
        <div class="modal-dialog modal-lg" role="form">
            <div class="modal-content">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                    <a href="#post-load-tab" aria-controls="post-load-tab" role="tab" data-toggle="tab">Post Load</a>
                    </li>
                    <li role="presentation">
                    <a href="#post-truck-tab" aria-controls="post-truck-tab" role="tab" data-toggle="tab">Post Truck</a>
                    </li>
                </ul>
                <div class="tab-content" id="tabs">
                    <div class="tab-pane active" id="post-load-tab">
                        <form class="form-horizontal rjs-create-form" action="#" enctype="multipart/form-data" method="post">
                            <fieldset class="">
                                <span class="row"><!-- Text input-->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="origin_city">Origin City</label>
                                            <input id="origin_city" name="wfc_rjs_loads_origin_city" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="">
                                        <div class="col-md-2">
                                            <label class="control-label" for="origin_state">Origin State</label>
                                            <select id="origin_state" name="wfc_rjs_loads_origin_state">
                                                <?php foreach( $us_states_array as $k => $v ): ?>
                                                    <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="dest_city">Dest. City</label>
                                            <input id="dest_city" name="wfc_rjs_loads_dest_city" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="">
                                        <div class="col-md-2">
                                            <label class="control-label" for="selectbasic">Dest. State</label>
                                            <select id="selectbasic" name="wfc_rjs_loads_dest_state">
                                                <?php foreach( $us_states_array as $k => $v ): ?>
                                                    <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </span>
                                <span class="row"><!-- Select Basic -->
                                    <div class="">
                                        <div class="col-md-6">
                                            <label class="control-label" for="selectbasic">Trailer Type</label>
                                            <select id="selectbasic" name="wfc_rjs_loads_trailer_type">
                                                <?php foreach( $rjs_trailer_type as $k => $v ): ?>
                                                    <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Multiple Checkboxes (inline) -->
                                    <div class="">
                                        <div class="col-md-6">
                                            <label class="control-label" for="checkboxes">Trailer Options</label>
                                            <label class="checkbox-inline" for="checkboxes-0">
                                                <input type="checkbox" name="wfc_rjs_loads_trailer_options[]" id="checkboxes-0" value="Hazmat"> Hazmat
                                            </label>
                                            <label class="checkbox-inline" for="checkboxes-1">
                                                <input type="checkbox" name="wfc_rjs_loads_trailer_options[]" id="checkboxes-1" value="Team"> Team
                                            </label>
                                            <label class="checkbox-inline" for="checkboxes-2">
                                                <input type="checkbox" name="wfc_rjs_loads_trailer_options[]" id="checkboxes-2" value="Expedited"> Expedited
                                            </label>
                                            <label class="checkbox-inline" for="checkboxes-3">
                                                <input type="checkbox" name="wfc_rjs_loads_trailer_options[]" id="checkboxes-3" value="Tarp"> Tarp
                                            </label>
                                            <label class="checkbox-inline" for="checkboxes-4">
                                                <input type="checkbox" name="wfc_rjs_loads_trailer_options[]" id="checkboxes-4" value="Pallet Exchange"> Pallet Exchange
                                            </label>
                                        </div>
                                    </div>
                                </span>
                                <!-- Text input-->
                                <span class="row">
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Amount</label>
                                            <input id="textinput" name="wfc_rjs_loads_amount" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Width</label>
                                            <input id="textinput" name="wfc_rjs_loads_width" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Pickup Date</label>
                                            <input id="textinput" name="wfc_rjs_loads_pickup_date" type="date" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                </span>
                                <!-- Text input-->
                                <span class="row">
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Distance</label>
                                            <input id="textinput" name="wfc_rjs_loads_distance" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Qty</label>
                                            <input id="textinput" name="wfc_rjs_loads_qty" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Pickup time</label>
                                            <input id="textinput" name="wfc_rjs_loads_pickup_time" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                </span>
                                <!-- Text input-->
                                <span class="row">
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Length</label>
                                            <input id="textinput" name="wfc_rjs_loads_length" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Extra stops</label>
                                            <input id="textinput" name="wfc_rjs_loads_extra_stops" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Deliver date</label>
                                            <input id="textinput" name="wfc_rjs_loads_deliver_date" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                </span>
                                <!-- Text input-->
                                <span class="row">
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Weight</label>
                                            <input id="textinput" name="wfc_rjs_loads_weight" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="selectbasic">Size</label>
                                            <select id="selectbasic" name="wfc_rjs_loads_size">
                                                <option value="1">Option one</option>
                                                <option value="2">Option two</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="">
                                        <div class="col-md-4">
                                            <label class="control-label" for="textinput">Deliver time</label>
                                            <input id="textinput" name="wfc_rjs_loads_deliver_time" type="text" placeholder="" class="form-control input-md">
                                        </div>
                                    </div>
                                </span>
                                <!-- Multiple Checkboxes (inline) -->
                                <div class="">
                                    <div class="col-md-6">
                                        <label class="control-label" for="checkboxes">Add to favorite posts</label>
                                        <label class="checkbox-inline" for="checkboxes-0">
                                            <input type="checkbox" name="checkboxes" id="checkboxes-0" value="yes"> Add to favorite posts
                                        </label>
                                    </div>
                                </div>
                                <!-- Multiple Checkboxes (inline) -->
                                <div class="">
                                    <div class="col-md-6">
                                        <label class="control-label" for="checkboxes">Daily</label>
                                        <label class="checkbox-inline" for="checkboxes-0">
                                            <input type="checkbox" name="checkboxes" id="checkboxes-0" value="yes"> Daily
                                        </label>
                                    </div>
                                </div>
                                <!-- Textarea -->
                                <div class="">
                                    <div class="col-md-12">
                                        <label class="control-label" for="textarea">Special Information</label>
                                        <textarea id="textarea" name="wfc_rjs_loads_special_information">Special Information</textarea>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="">
                                    <div class="col-md-6">
                                        <label class="control-label" for="textinput">Handle</label>
                                        <input id="textinput" name="wfc_rjs_loads_handle" type="text" placeholder="" class="form-control input-md">
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="">
                                    <div class="col-md-6">
                                        <label class="control-label" for="textinput">Handle phone</label>
                                        <input id="textinput" name="wfc_rjs_loads_handle_phone" type="text" placeholder="" class="form-control input-md">
                                    </div>
                                </div>
                            </fieldset>
                            <button class="rjs-create-submit-form">Quick Post</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="post-truck-tab">
                        <div class="container">
                            <h1>User detail</h1>
                            <form novalidate="novalidate" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label" for="inputFirstName">First name:</label>
                                    <div class="controls">
                                        <input type="text" id="inputFirstName" ng-model="truck.rjsmeta.wfc_rjs_trucks_origin_city"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputLastName">Last name:</label>
                                    <div class="controls">
                                        <input type="text" id="inputLastName" ng-model="user.lastName"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <a ng-click="cancel()" class="btn btn-small">cancel</a>
                                        <a ng-click="updateUser()" class="btn btn-small btn-primary">update user</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php get_footer(); ?>