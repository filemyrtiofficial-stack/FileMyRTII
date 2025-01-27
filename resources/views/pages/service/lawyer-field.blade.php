    <div class="col-md-3">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Field Type</label> <br>
                            <div class="input-group">
                                <select type="text" name="lawyer_field_type[]" class="form-control field_type" required>
                                    {!! fieldListOptions() !!}
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Field Lable</label> <br>
                            <div class="input-group">
                                <input type="text" name="lawyer_field_lable[]" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Is Required</label> <br>
                            <div class="input-group">
                                <select type="text" name="lawyer_is_required[]" class="form-control" required>
                                        {!! booleanListOptions() !!}
                                </select>
                            </div>
                        </div>
                        <div class="date-other-validation" style="display:none;">
                            <div class="form-group">
                                <label for="">Minimum Date</label> <br>
                                <div class="input-group">
                                <input type="date" name="lawyer_minimum_date[]" class="form-control" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Maximum Date</label> <br>
                                <div class="input-group">
                                <input type="date" name="lawyer_maximum_date[]" class="form-control" >

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Dependency Date Field</label> <br>
                                <div class="input-group">
                                <input type="" name="lawyer_dependency_date_field[]" class="form-control" >

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-sm btn-danger remove-card">Remove</button>
                    </div>
                </div>
            </div>
