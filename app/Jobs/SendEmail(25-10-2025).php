<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ResetPassword;
use App\Mail\ApplicationRegister;
use App\Mail\AssignLawyer;
use App\Mail\ApproveRti;
use App\Mail\DraftRTIMail;
use App\Mail\DraftRTIMailAgain;

use App\Mail\FiledRti;
use App\Mail\FirstAppealFollowUpMail;
use App\Mail\SecondAppealFollowUpMail;
use App\Mail\MoreInfoReplyMail;
use App\Mail\EditRequestMail ;
use App\Mail\MoreInfoMail;
use App\Mail\FirstAppealPaymentMail;
use App\Mail\LawyerRegister;
use App\Mail\Admin\ApproveAppealMail;
use App\Mail\Admin\ApplicationRegister as AdminApplicationRegister;
use App\Mail\Admin\FiledRti as AdminFiledRti;


use App\Mail\Lawyer\AssignLawyer as LawyerAssignLawyer;
use App\Mail\Lawyer\EditRequestMail as LawyerEditRequestMail;
use App\Mail\Admin\EditRequestMail as AdminEditRequestMail;
use App\Mail\Lawyer\DraftRTIMail as LawyerDraftRTIMail;
use App\Mail\Lawyer\MoreInforMail as LawyerMoreInforMail;
use App\Mail\Lawyer\ApproveRti as LawyerApproveRti;
use App\Mail\Admin\MoreInfoReplyMail as AdminMoreInfoReplyMail; 
use App\Mail\Admin\SendBackToAdminRequestMail;
use App\Mail\Admin\DraftRTIMail as AdminDraftRTIMail;
use App\Mail\Admin\MoreInfoRequestMail as AdminMoreInfoRequestMail;
use App\Mail\Admin\AssignLawyer as AdminAssignLawyer;
use App\Mail\NewsletterMail;
use App\Mail\RefundRequestResponse;
use Mail;
use App\Models\MailTemplate;
use App\Models\Customer;
use App\Mail\PromotionMail;
use App\Mail\EnquiryMail;
use App\Mail\Admin\NewsletterMail as AdminNewsletterMail;


class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    protected $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $details)
    {
        $this->details = $details;
        $this->type = $type;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $customer_status = false;
        $lawyer_status = false;
        $admin_status = false;
        $customer_email_id = "";
        $lawyer_email_id = "";

        if($this->type == 'reset-password') {
            $email = new ResetPassword($this->details);
            $customer_status = true;
            $customer_email_id = $this->details['email'] ?? '';
        }
        elseif($this->type == 'application-register') {
           

            $email = new ApplicationRegister($this->details);
            $customer_email_id = $this->details['email'] ?? '';
            $customer_status = true;

            if($this->details->appeal_no == 1 || $this->details->appeal_no == 2) {
                $lawyer_email = new LawyerAssignLawyer($this->details);
                $lawyer_email_id = $this->details->lawyer['email'] ?? '';
                $lawyer_status = true;
            }
           
            $admin_email = new AdminApplicationRegister($this->details);
            $admin_status = true;

        }
        elseif($this->type == 'assign-lawyer') {
            $email = new AssignLawyer($this->details);
            $customer_email_id = $this->details['email'] ?? '';

            $customer_status = true;
            
            $admin_email = new AdminAssignLawyer($this->details);
            $admin_status = true;
            
              $lawyer_email = new LawyerAssignLawyer($this->details);
            $lawyer_email_id = $this->details->lawyer['email'] ?? '';
            

             $lawyer_status = true;
             
        }
        elseif($this->type == 'assign-new-lawyer') {
            $lawyer_email = new LawyerAssignLawyer($this->details);
            $lawyer_email_id = $this->details->lawyer['email'] ?? '';
            

             $lawyer_status = true;
             
            $admin_email = new AdminAssignLawyer($this->details);
            $admin_status = true;

        }
        elseif($this->type == 'approve-rti') {
            $email = new ApproveRti($this->details);
            $customer_email_id = $this->details['email'] ?? '';

            $lawyer_email = new LawyerApproveRti($this->details);
            $lawyer_email_id = $this->details->lawyer['email'] ?? '';
            
            $admin_email = new ApproveAppealMail($this->details);
            
            $customer_status = true;
            $admin_status = true;
            $lawyer_status = true;


        }
        elseif($this->type == 'draft-rti') {
            $email = new DraftRTIMail($this->details);
            $customer_email_id = $this->details->rtiApplication['email'] ?? '';

            $customer_status = true;

            $admin_email = new AdminDraftRTIMail($this->details, 'first');
            $admin_status = true;
            
            
        }

        elseif($this->type == 'draft-rti-again') {
            $email = new DraftRTIMailAgain($this->details);
            $customer_email_id = $this->details->rtiApplication['email'] ?? '';

            $customer_status = true;


            $admin_email = new AdminDraftRTIMail($this->details, "again");
            $admin_status = true;

            // $lawyer_email = new LawyerDraftRTIMail($this->details);
            // $lawyer_status = true;
            
            
        }
        elseif($this->type == 'filed-mail') {
            $email = new FiledRti($this->details);
            $customer_email_id = $this->details['email'] ?? '';
            $customer_status = true;

            $admin_email = new AdminFiledRti($this->details);
            $admin_status = true;
            
        }
        elseif($this->type == 'first-appeal-follow-up') {
            $email = new FirstAppealFollowUpMail($this->details);
            $customer_email_id = $this->details['email'] ?? '';

            $customer_status = true;
        }
        elseif($this->type == 'second-appeal-follow-up') {
            $email = new SecondAppealFollowUpMail($this->details);
            $customer_email_id = $this->details['email'] ?? '';

            $customer_status = true;
        }
        elseif($this->type == 'send-reply') {
            $email = new MoreInfoReplyMail($this->details);
            $customer_email_id = $this->details->rtiApplication['email'] ?? '';
            $customer_status    = true;

            $lawyer_email = new LawyerMoreInforMail($this->details);
            $lawyer_email_id = $this->details->rtiApplication->lawyer['email'] ?? '';
            $lawyer_status    = true;

            $admin_email = new AdminMoreInfoReplyMail($this->details);
            $admin_status = true;

            
        }
        elseif($this->type == 'edit-request') {
            $email = new EditRequestMail($this->details);
            $customer_email_id = $this->details->rtiApplication['email'] ?? '';
            $customer_status    = true;
            $lawyer_email=new LawyerEditRequestMail($this->details);
            $lawyer_email_id = $this->details->rtiApplication->lawyer['email'] ?? '';
            $lawyer_status = true;
            $admin_email = new AdminEditRequestMail($this->details);
            $admin_status = true;
          

        }
        elseif($this->type == 'more-info') {
            $email = new MoreInfoMail($this->details);
            $customer_email_id = $this->details->rtiApplication['email'] ?? '';
            $customer_status    = true;

            $admin_email = new AdminMoreInfoRequestMail($this->details);
            $admin_status    = true;


        }
        elseif($this->type == 'lawyer-resgister') {
            $email = new LawyerRegister($this->details);
            $lawyer_email_id = $this->details->lawyer['email'] ?? '';

            $customer_status    = true;
            // $this->details['email'] = ['personal_email_id'];
        }
        elseif($this->type == "send-back-to-admin") {
            $admin_email = new SendBackToAdminRequestMail($this->details);
            $admin_status = true;
        }
        elseif($this->type == "newsletter") {
            $email = new NewsletterMail($this->details);
            $customer_email_id = $this->details['email'] ?? '';
            $customer_status = true;
                
            $admin_email = new AdminNewsletterMail($this->details);
            $admin_status    = true;

        }
        elseif($this->type == 'refund-response-response') {
            $email = new RefundRequestResponse($this->details);
            $customer_email_id = $this->details->rtiApplication['email'] ?? '';
            $customer_status = true;
        }
        elseif($this->type == 'enquiry') {
            $admin_email = new EnquiryMail($this->details);
            $admin_status    = true;
        }
        elseif($this->type == 'promotion-mail') {
            $template = MailTemplate::list(false, ['id' => $this->details['mail_template']]);
            if(count($template) > 0) {
                $customers = Customer::list(false, ['ids' => $this->details['customers']]);
                foreach($customers as $item) {

                    $html = str_replace("{{name}}", $item->fullName, $template[0]->html);
                    $html = str_replace("{{ name }}", $item->fullName, $template[0]->html);
                    $email = new PromotionMail(['html' => $html, 'subject' => $template[0]->subject]);
                    Mail::to($item->email)->send($email);

                }
            }
        }
        else {
            $email = new ApplicationRegister($this->details);
            $customer_email_id = $this->details['email'] ?? '';

            $customer_status    = true;
        }
        if($customer_status) {

            Mail::to($customer_email_id)->send($email);
        }
        if($admin_status) {
            // Mail::to("developmentd299@gmail.com")->send($admin_email);
            // if($customer_status) {
                
            // Mail::to($customer_email_idss)->send($admin_email);
            // }

            Mail::to(config('app.admin_mail'))->send($admin_email);
        }
        if($lawyer_status) {

            Mail::to($lawyer_email_id)->send($lawyer_email);
        }

    }


}
