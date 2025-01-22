@extends('frontend.layout.layout')

@section('content')

        


<section class="contact_section dashboard_section">
    
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-5">
                <div class="contact_faq_wrapper">
                    <ul class="contact_faq_list">
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab1">Application Status</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab2">RTI Application</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab3">Your Profile</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab4">Download</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab5">Payment Info & Invoice</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab6">First Appeal</a>
                        </li>
                        <li class="contact_faq_item">
                            <span class="shape"></span>
                            <a class="faq_list_item" href="#tab7">Second Appeal</a>
                        </li>
                       
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-7">
                <div class="contact_wrapper">
                    <div class="contact_faq">
                        <!-- <div class="contact_faq_heading">
                            <h2>Top queries</h2>
                        </div> -->
                        <div class="contact_faq_tab_content">
                            <div id="tab1" class="contact_faq_tab active">
                                <div class="contact_faq_heading text-center">
                                    <h2>Application Status</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>RTI Application registered date</td>
                                                <td>{{Carbon\Carbon::parse($data->created_at)->format('d/m/Y')}}</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>RTI Application filed date</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Expected reply from PIO</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <ul class="status_bar">
                                        <li @if($data->status >= 1) class="active" @endif><a href="javascript:void(0);">1</a><span>Started</span></li>
                                        <li @if($data->status >= 2) class="active" @endif><a href="javascript:void(0);">2</a><span>Approval</span></li>
                                        <li @if($data->status == 3) class="active" @endif><a href="javascript:void(0);">3</a><span>Filed</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="tab2" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab3" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Your Profile</h2>
                                </div>
                                <div class="faq_item_wrap">
                                   <div class="row">
                                        <div class="col-md-6">
                                            <label for="">First Name</label>
                                            <input type="text" diabled value="{{$data->first_name ?? ''}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Last Name</label>
                                            <input type="text" diabled value="{{$data->last_name ?? ''}}">
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Email</label>
                                            <input type="text" diabled value="{{$data->email ?? ''}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Phone Number</label>
                                            <input type="text" diabled value="{{$data->phone_number ?? ''}}">
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Address</label>
                                            <textarea type="text" diabled >{{$data->address ?? ''}}</textarea>
                                        </div>
                                       
                                   </div>
                                </div>
                            </div>
                            <div id="tab4" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab5" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab6" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab7" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab8" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab9" class="contact_faq_tab">
                                <div class="contact_faq_heading">
                                    <h2>Top queries</h2>
                                </div>
                                <div class="faq_item_wrap">
                                    <div class="faq_item">
                                        <div class="faq_title active">
                                            <h4>What are the modes of payment for paying for RTI on OnlineRTI?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Can I apply RTI to private bodies?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Do you handle only Bangalore related RTIs or other cities as well?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>Is this a private organization?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                    <div class="faq_item">
                                        <div class="faq_title">
                                            <h4>I have paid for my RTI. What next?</h4>
                                        </div>
                                        <div class="faq_content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec fermentum risus dui, vel placerat mi auctor vitae. Fusce id felis nec ligula aliquam sagittis ornare vel diam. Duis vulputate odio ut mi vulputate posuere. Aenean dapibus vehicula pharetra. Curabitur</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab10" class="contact_faq_tab">
                                <div class="contact_form">
                                    <div class="contact_form_heading">
                                        Lorem ipsum dolor sit ametcerat mi auctor
                                    </div>
                                    <div class="contact_option_list">
                                        <div class="contact_option custom_radio"><input type="radio" id="rti_yes" name="rti_option" checked><label for="rti_yes">I have already applied RTI</label></div>
                                        <div class="contact_option custom_radio"><input type="radio" id="rti_no" name="rti_option"><label for="rti_no">I Want to apply RTI</label></div>
                                    </div>
                                    <div class="contact_form_option">
                                        <div class="form_no">
                                            <button type="submit" class="theme-btn"><span>Apply Now</span></button>
                                        </div>
                                        <div class="form_yes">
                                            <div class="rti_form">
                                                <form action="">
                                                    <div class="form_item">
                                                        <select class="form_field custom_select" name="reason" id="">
                                                            <option value="selected">Please select a reason</option>
                                                            <option value="reason1">Lorem ipsum dolor sit amet.</option>
                                                            <option value="reason2">Lorem ipsum dolor sit amet.</option>
                                                            <option value="reason3">Lorem ipsum dolor sit amet.</option>
                                                        </select>
                                                    </div>
                                                    <div class="form_item col_2">
                                                        <div class="form_item">
                                                            <input class="form_field" type="text" name="study_year" id="" placeholder="Name">
                                                        </div>
                                                        <div class="form_item">
                                                            <input class="form_field" type="tel" name="study_year" id="" placeholder="Phone No">
                                                        </div>
                                                    </div>
                                                    <div class="form_item">
                                                        <input class="form_field" type="email" name="email" id="" placeholder="E-mail">
                                                    </div>
                                                    <div class="form_item">
                                                        <input class="form_field" type="text" name="study_year" id="" placeholder="Message">
                                                    </div>
                                                    <button type="submit" class="theme-btn"><span>Submit</span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

