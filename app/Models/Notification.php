<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['linkable_id', 'linkable_type', 'type', 'message', 'from_id', 'from_type', 'to_id', 'to_type', 'additional', 'is_read'];
    protected $casts = [
        'additional' => 'array'
    ];


    public static function sendNotification($type, $rti, $additional_data = null) {

        $subject = "";
        $sender = "";
        if($type == 'draft-rti') {
            
            if($rti['appeal_no'] == 0) {
                $subject = 'Send RTI Approval for RTI - RTI Application No. : '.$rti['application_no'];
            }
            else if($rti['appeal_no'] == 1) {
                $subject = 'Send RTI Approval for First Appeal (RTI) - Application No. : '.$rti['application_no'];
            }
            else if($rti['appeal_no'] == 2) {
    
                $subject = 'Send RTI Approval for Second Appeal (RTI)- Application No. : '.$rti['application_no'];
            }
            $sender = "lawyer";
        }
        elseif($type == 'filed-mail') {
            if($rti['appeal_no'] == 0) {
                 $subject = 'Your RTI Application Has Been Filed - Application No. : '.$rti['application_no'];
            }
            else if($rti['appeal_no'] == 1) {
                 $subject = 'Your First Appeal (RTI) Application Has Been Filed - Application No. : '.$rti['application_no'];
            }
            else if($rti['appeal_no'] == 2) {
                 $subject = 'Your Second Appeal (RTI) Application Has Been Filed - Application No. : '.$rti['application_no'];
            }
            $sender = "lawyer";
            
        }
        elseif($type == 'more-info-requested') {
            $subject  = 'More Information Needed - RTI Application No. : '.$rti['application_no'];
            $sender = "lawyer";
        }
        elseif($type == 'edit-request') {
            if($rti['appeal_no'] == 0) {

                $subject = 'Customer Requested Modifications for Initial Appeal - Application No :  '.$rti['application_no'];
            }
            elseif($rti['appeal_no'] == 1) {
    
                $subject = 'Customer Requested Modifications for First Appeal - Application No : '.$rti['application_no'];
            }
            else {
    
                $subject = 'Customer Requested Modifications for Second Appeal - Application No : '.$rti['application_no'];
            }
            $sender = "customer";
        }
        elseif($type == 'send-reply') {
            if($rti['appeal_no'] == 0) {
                $subject = 'More Information Provided for RTI Application No.: '.$rti['application_no'];
            }
            elseif($rti['appeal_no'] == 1) {
                $subject = 'Additional Information Received – Please Review and Draft First Appeal (Application No: '.$rti['application_no'].')';
            }
            elseif($rti['appeal_no'] == 2) {
                $subject = 'Additional Information Received – Please Review and Draft Second Appeal (Application No: '.$rti['application_no'].')';
            }
            $sender = "customer";
        }
        elseif($type == "approve-rti") {
            if($rti['appeal_no'] == 0) {
                $subject = 'RTI Draft Approved - Ready for Filing - Application No : '.$rti['application_no'];
            }
            else if($rti['appeal_no'] == 1) {
                $subject = 'First Appeal (RTI) Draft Approved - Ready for Filing - Application No : '.$rti['application_no'];
            }
            else {
                $subject = 'Second Appeal (RTI) Draft Approved - Ready for Filing - Application No : '.$rti['application_no'];
            }
            $sender = "customer";
        }

        elseif($type == "draft-rti-again") {
            if($rti['appeal_no'] == 0) {
                $subject = 'Your Updated Initial Appeal Draft is Ready for Review (Application No: '.$rti['application_no'].')';
            }
            else if($rti['appeal_no'] == 1) {
                $subject = 'Your Updated First Appeal Draft is Ready for Review (Application No: '.$rti['application_no'].')';
            }
            else {
                $subject = 'Your Updated Second Appeal Draft is Ready for Review (Application No: '.$rti['application_no'].')';
            }
             $sender = "lawyer";
        }
        //  elseif($type == "filed-mail") {
        //     if($rti['appeal_no'] == 0) {
        //         $subject = 'Your RTI Application Has Been Filed (Application No: '.$rti['application_no'].')';
        //     }
        //     else if($rti['appeal_no'] == 1) {
        //         $subject = 'Your First Appeal is Filed – Tracking Number & Next Steps (Application No: '.$rti['application_no'].')';
        //     }
        //     else {
        //         $subject = 'Your Second Appeal is Filed – Tracking Details (Application No: '.$$rti['application_no'].')';
        //     }
        // }
       
       
        if($sender == 'customer') {
            if($subject != null) {
                $notification = Notification::create(['additional' => $additional_data, 'message' => $subject, 'linkable_type' => "rti-application", 'linkable_id' => $rti->id, 'type' => $type , 'from_type' => 'customer', 'from_id' => $rti['user_id'] ?? '', 'to_type' => 'lawyer', 'to_id' => $rti['lawyer_id'] ?? '']);
            }
        }
        else {
            if($subject != null) {
                $notification = Notification::create(['additional' => $additional_data, 'message' => $subject, 'linkable_type' => "rti-application", 'linkable_id' => $rti->id, 'type' => $type , 'from_type' => 'lawyer', 'from_id' => $rti['lawyer_id'] ?? '', 'to_type' => 'customer', 'to_id' => $rti['user_id'] ?? '']);
            }
        }
   
        // if($subject != null) {
        //     $notification = Notification::create(['additional' => $additional_data, 'message' => $subject, 'linkable_type' => "rti-application", 'linkable_id' => $rti->id, 'type' => $type , 'from_type' => 'lawyer', 'from_id' => $rti['lawyer_id'] ?? '', 'to_type' => 'customer', 'to_id' => $rti['user_id'] ?? '']);
        // }
    }

    public static function sendCustomerNotification($type, $rti, $additional_data = null) {

        $subject = "";
        $from = "";
        $from_id = "";
        if($type == 'assign-lawyer') {
            $subject = 'Getting Started Application Number : '.$rti['application_no'];
            $from = 'admin';
            $from_id = auth()->user()->id;
        }
         elseif($type == "filed-mail") {
            if($rti['appeal_no'] == 0) {
                $subject = 'Your RTI Application Has Been Filed (Application No: '.$rti['application_no'].')';
            }
            else if($rti['appeal_no'] == 1) {
                $subject = 'Your First Appeal is Filed – Tracking Number & Next Steps (Application No: '.$rti['application_no'].')';
            }
            else {
                $subject = 'Your Second Appeal is Filed – Tracking Details (Application No: '.$rti['application_no'].')';
            }
        }
         elseif($type == 'more-info-requested') {
            $subject  = 'More Information Needed - RTI Application No. : '.$rti['application_no'];
        }
       
       
        
        if($subject != null) {
            $notification = Notification::create(['additional' => $additional_data, 'message' => $subject, 'linkable_type' => "rti-application", 'linkable_id' => $rti->id, 'type' => $type , 'from_type' => $from, 'from_id' => $from_id, 'to_type' => 'customer', 'to_id' => $rti['user_id'] ?? '']);
        }
    }
}
