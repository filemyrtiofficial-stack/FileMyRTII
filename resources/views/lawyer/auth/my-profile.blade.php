<div class="personal_detail_modal modal" id="personal_detail_modal">
    <div class="personal_detail_modal_wrap">
        <div class="modal_header">
            <h4 class="heading">Personal Details</h4>
            <button class="close close-rti-popup">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#0F1729"></path>
                </svg>
            </button>
        </div>
        <div class="modal_body">
            <div class="faq_item_wrap" style="float:left;width:100%;overflow-x: auto;height: 500px;">
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">First Name</label>
                        <input class="form_field" type="text" name="first_name" id="" placeholder="First Name" disabled value="{{$lawyerdata['first_name'] ?? ''}}">
                    </div>
                    <div class="form_item">
                        <label for="last_name">Last Name</label>
                        <input class="form_field" type="text" name="last_name" id="" placeholder="Last Name" value="{{$lawyerdata['last_name'] ?? ''}}" disabled>
                    </div>
                </div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="last_name">Phone Number</label>
                        <input class="form_field" type="tel" name="" id="" placeholder="Enter Your Number" value="{{$lawyerdata['phone'] ?? ''}}" disabled>
                    </div>
                    <div class="form_item">
                        <label for="first_name">Email</label>
                        <input class="form_field" type="email" name="" id="" placeholder="Enter Your Email" value="{{$lawyerdata['email'] ?? ''}}" disabled>
                    </div>
                </div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">Full Address</label>
                        <textarea class="form_field" name="" id="" disabled>{{$lawyerdata['address'] ?? ''}}</textarea>
                    </div>
                    <div class="form_item">
                        <label class="form-label">DOB</label>
                        <div class="input-group">
                            <input id="dob" name="dob" value="{{$lawyerdata['dob'] ?? ''}}" class="form_field" type="date" placeholder="DOB" disabled>
                        </div>
                    </div>

                </div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">Qualification</label>
                        <input class="form_field" type="text" name="" id="" placeholder="Enter Your Email" value="{{$lawyerdata['qualification'] ?? ''}}" disabled>
                    </div>
                    <div class="form_item">
                        <label class="form-label">Experience</label>
                        <div class="input-group">
                            <input id="Experience" name="experience" value="{{$lawyerdata['experience'] ?? ''}}" class="form_field" type="text" placeholder="Experience" disabled>
                        </div>
                    </div>

                </div>

                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">Father Name/Spouse Name</label>
                        <input class="form_field" type="text" name="" id="" placeholder="Father Name/Spouse Name" value="{{$lawyerdata->lawyerProfile->father_spouse_name ?? ''}}" disabled>
                    </div>
                    <div class="form_item">
                        <label class="form-label">Mother Name</label>
                        <div class="input-group">
                            <input type="text" id="mother_name" name="mother_name" value="{{$lawyerdata->lawyerProfile->mother_name ?? ''}}" class="form_field" placeholder="Mother Name" disabled>
                        </div>
                    </div>

                </div>

                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">Emergency/ Alternative Phone No.</label>
                        <input class="form_field" type="text" name="" id="alternative_phone_no" placeholder="Emergency/ Alternative Phone No." value="{{$lawyerdata->lawyerProfile->alternative_phone_no ?? ''}}" disabled>
                    </div>
                    <div class="form_item">
                        <label class="form-label">Personal Email ID</label>
                        <div class="input-group">
                            <input id="personal_email_id" name="personal_email_id" value="{{$lawyerdata->lawyerProfile->personal_email_id ?? ''}}" class="form_field" type="email" placeholder="Personal Email ID" disabled>
                        </div>
                    </div>

                </div>

                <div class="db_item_wrap">
                    <div class="form_item">
                        <label for="first_name">Gender</label>
                        <select name="gender" id="gender" class="form_field" disabled>
                            @foreach(commonGenders() as $key => $item)
                            <option value="{{$key}}" @if(isset($lawyerdata->lawyerProfile->gender) && $lawyerdata->lawyerProfile->gender ==$key)
                                selected @endif>
                                {{$item['name']}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_item">
                        <label class="form-label">Marital Status</label>
                        <div class="input-group">
                            <select name="marital_status" id="marital_status" class="form_field" disabled>
                                @foreach(maritalStatus() as $key => $item)
                                <option value="{{$key}}" @if(isset($lawyerdata->lawyerProfile->marital_status) && $lawyerdata->lawyerProfile->marital_status ==$key)
                                    selected @endif>
                                    {{$item['name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="db_item_wrap">
                    <div class="form_item">
                        <label class="form-label">Date of Joining </label>
                        <div class="input-group">
                            <input id="date_of_joining" name="date_of_joining" value="{{$lawyerdata->lawyerProfile->date_of_joining ?? ''}}" class="form_field" type="date" placeholder="Date of Joining" disabled>
                        </div>
                    </div>
                    <div class="form_item">

                        <label class="form-label">Exit Date </label>
                        <div class="input-group">
                            <input id="exit_date" name="exit_date" value="{{$lawyerdata->lawyerProfile->exit_date ?? ''}}" class="form_field" type="date" placeholder="Exit Date" disabled>
                        </div>
                    </div>
                </div>

                <div class="db_item_wrap">
                    <div class="form_item">
                        <label class="form-label">Account holder</label>
                        <div class="input-group">
                            <input id="bank_account_holder" name="bank_account_holder" value="{{$lawyerdata->lawyerProfile->bank_account_holder ?? ''}}" class="form_field" type="text" placeholder="Mother Name" disabled>
                        </div>
                    </div>
                    <div class="form_item">
                        <label class="form-label">Bank name</label>
                        <div class="input-group">
                            <input id="bank_name" name="bank_name" value="{{$lawyerdata->lawyerProfile->bank_name ?? ''}}" class="form_field" type="text" placeholder="Bank name" disabled>
                        </div>

                    </div>
                </div>

                <div class="db_item_wrap">
                    <div class="form_item">
                        <label class="form-label">Bank address</label>
                        <div class="input-group">
                            <input id="bank_address" name="bank_address" value="{{$lawyerdata->lawyerProfile->bank_address ?? ''}}" class="form_field" type="text" placeholder="Bank address" disabled>
                        </div>
                    </div>
                    <div class="form_item">
                        <label class="form-label">Account number</label>
                        <div class="input-group">
                            <input id="bank_account_number" name="bank_account_number" value="{{$lawyerdata->lawyerProfile->bank_account_number ?? ''}}" class="form_field"   type="text" placeholder="Mother Name" disabled>
                        </div>

                    </div>
                </div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label class="form-label">IFSC code</label>
                        <div class="input-group">
                            <input id="bank_ifsc_code" name="bank_ifsc_code" value="{{$lawyerdata->lawyerProfile->bank_ifsc_code ?? ''}}" class="form_field" type="text" placeholder="IFSC code" disabled>
                        </div>
                    </div>
                    <div class="form_item">
                        <label class="form-label">Blood Group</label>
                        <div class="input-group">

                            <select name="blood_group" id="blood_group" class="form_field" disabled>
                                @foreach(bloodGroup() as $key => $item)
                                <option value="{{$key}}" @if(isset($lawyerdata->lawyerProfile->blood_group) && $lawyerdata->lawyerProfile->blood_group ==$key)
                                    selected @endif>
                                    {{$item['name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label class="form-label">About</label>
                        <div class="input-group">
                            <textarea name="about" class="form_field" id="about" rows="12" disabled>{{$lawyerdata['about'] ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="form_item">
                        <label class="form-label">Package Details</label>
                        <div class="input-group">
                            <textarea name="package_details" class="form_field" id="package_details" rows="12" disabled>{{$lawyerdata->lawyerProfile->package_details ?? ''}}</textarea>
                        </div>

                    </div>
                </div>
                <div class="db_item_wrap">
                    <div class="form_item">
                        <label class="form-label">Remarks</label>
                        <div class="input-group">
                            <textarea name="remarks" class="form_field" id="remarks" rows="12" disabled>{{$lawyerdata->lawyerProfile->remarks ?? ''}}</textarea>
                        </div>
                    </div>
                    <div class="form_item">


                    </div>
                </div>
                <!-- <div class="db_item_wrap">
                    <div class="form_item">
                        
                    </div>
                    <div class="form_item">

                        
                    </div>
                </div> 
                <div class="db_item_wrap">
                    <div class="form_item">
                        
                    </div>
                    <div class="form_item">

                        
                    </div>
                </div> 
                <div class="db_item_wrap">
                    <div class="form_item">
                        
                    </div>
                    <div class="form_item">

                        
                    </div>
                </div>  -->
                <div class="col-12">
                    <!-- <hr>
                    <h5>Attachments</h5> -->
                    <div class="tab_overview_data" style="display: none;">
                        <table>
                            <thead>
                                <tr>

                                    <th>Title</th>
                                    <th>Image</th>

                                </tr>
                            </thead>
                            @if(isset($lawyerdata->lawyerProfile->attachments ))
                            @foreach($lawyerdata->lawyerProfile->attachments['document_name'] ?? [] as $key => $value)


                            <tbody>
                                <tr>
                                    <td>{{$value}}</td>
                                    <td><a href="{{asset($lawyerdata->lawyerProfile->attachments['images'][$key]) ?? ''}}" target="_blank">Preview</a></td>
                                </tr>


                                @endforeach
                                @endif

                            </tbody>
                        </table>



                    </div>
                </div>

            </div>
        </div>
        <div class="modal_action">
            <!-- <a href="javascript:void(0);" class="theme-btn"><span>Save Changes</span></a> -->
        </div>
    </div>
    <div class="modal_bg"></div>
</div>