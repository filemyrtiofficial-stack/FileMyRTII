<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\MailTemplate;
use App\Models\Customer;

// Customer Mailables
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
use App\Mail\EditRequestMail;
use App\Mail\MoreInfoMail;
use App\Mail\FirstAppealPaymentMail;
use App\Mail\LawyerRegister;
use App\Mail\NewsletterMail;
use App\Mail\RefundRequestResponse;
use App\Mail\PromotionMail;
use App\Mail\EnquiryMail;
use App\Mail\AbandonedApplicationMail; // <-- NEW MAILABLE

// Admin Mailables
use App\Mail\Admin\ApproveAppealMail;
use App\Mail\Admin\ApplicationRegister as AdminApplicationRegister;
use App\Mail\Admin\FiledRti as AdminFiledRti;
use App\Mail\Admin\EditRequestMail as AdminEditRequestMail;
use App\Mail\Admin\MoreInfoReplyMail as AdminMoreInfoReplyMail;
use App\Mail\Admin\SendBackToAdminRequestMail;
use App\Mail\Admin\DraftRTIMail as AdminDraftRTIMail;
use App\Mail\Admin\MoreInfoRequestMail as AdminMoreInfoRequestMail;
use App\Mail\Admin\AssignLawyer as AdminAssignLawyer;
use App\Mail\Admin\NewsletterMail as AdminNewsletterMail;

// Lawyer Mailables
use App\Mail\Lawyer\AssignLawyer as LawyerAssignLawyer;
use App\Mail\Lawyer\EditRequestMail as LawyerEditRequestMail;
use App\Mail\Lawyer\DraftRTIMail as LawyerDraftRTIMail;
use App\Mail\Lawyer\MoreInforMail as LawyerMoreInforMail;
use App\Mail\Lawyer\ApproveRti as LawyerApproveRti;


class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $details;
    protected $type;
    
    /**
     * Create a new job instance.
     */
    public function __construct(string $type, $details)
    {
        $this->details = $details;
        $this->type = $type;
    }
    
    /**
     * Execute the job.
     */
    public function handle()
    {
        // Initialize Mailable and Recipients
        $customerEmail = null;
        $lawyerEmail = null;
        $adminEmail = null;
        $customerRecipient = null;
        $lawyerRecipient = null;
        $adminRecipient = config('app.admin_mail'); // Default admin recipient

        // Use the details array/object for easier access
        $details = $this->details;
        $hasRtiApplication = isset($details->rtiApplication);
        $hasLawyer = isset($details->lawyer) && $details->lawyer;
        
        // --- Core Logic: Determine Mailables and Recipients ---
        switch ($this->type) {
            case 'abandoned-application':
                $customerEmail = new AbandonedApplicationMail($details);
                $customerRecipient = $details['email'] ?? null;
                break;
                
            case 'reset-password':
                $customerEmail = new ResetPassword($details);
                $customerRecipient = $details['email'] ?? null;
                break;

            case 'application-register':
                $customerEmail = new ApplicationRegister($details);
                $customerRecipient = $details['email'] ?? null;
                $adminEmail = new AdminApplicationRegister($details);
                if (($details->appeal_no ?? 0) > 0 && $hasLawyer) {
                    $lawyerEmail = new LawyerAssignLawyer($details);
                    $lawyerRecipient = $details->lawyer['email'] ?? null;
                }
                break;

            case 'assign-lawyer':
            case 'assign-new-lawyer':
                $customerEmail = new AssignLawyer($details); // Only for 'assign-lawyer'
                $customerRecipient = $details['email'] ?? null;
                $adminEmail = new AdminAssignLawyer($details);
                $lawyerEmail = new LawyerAssignLawyer($details);
                $lawyerRecipient = $details->lawyer['email'] ?? null;
                break;

            case 'approve-rti':
                $customerEmail = new ApproveRti($details);
                $customerRecipient = $details['email'] ?? null;
                $adminEmail = new ApproveAppealMail($details);
                $lawyerEmail = new LawyerApproveRti($details);
                $lawyerRecipient = $details->lawyer['email'] ?? null;
                break;
            
            case 'draft-rti':
                $customerEmail = new DraftRTIMail($details);
                $customerRecipient = $details->rtiApplication['email'] ?? null;
                $adminEmail = new AdminDraftRTIMail($details, 'first');
                break;
                
            case 'draft-rti-again':
                $customerEmail = new DraftRTIMailAgain($details);
                $customerRecipient = $details->rtiApplication['email'] ?? null;
                $adminEmail = new AdminDraftRTIMail($details, "again");
                break;

            case 'filed-mail':
                $customerEmail = new FiledRti($details);
                $customerRecipient = $details['email'] ?? null;
                $adminEmail = new AdminFiledRti($details);
                break;

            case 'first-appeal-follow-up':
                $customerEmail = new FirstAppealFollowUpMail($details);
                $customerRecipient = $details['email'] ?? null;
                break;

            case 'second-appeal-follow-up':
                $customerEmail = new SecondAppealFollowUpMail($details);
                $customerRecipient = $details['email'] ?? null;
                break;

            case 'send-reply':
                $customerEmail = new MoreInfoReplyMail($details);
                $customerRecipient = $details->rtiApplication['email'] ?? null;
                $lawyerEmail = new LawyerMoreInforMail($details);
                $lawyerRecipient = $details->rtiApplication->lawyer['email'] ?? null;
                $adminEmail = new AdminMoreInfoReplyMail($details);
                break;
                
            case 'edit-request':
                $customerEmail = new EditRequestMail($details);
                $customerRecipient = $details->rtiApplication['email'] ?? null;
                $lawyerEmail = new LawyerEditRequestMail($details);
                $lawyerRecipient = $details->rtiApplication->lawyer['email'] ?? null;
                $adminEmail = new AdminEditRequestMail($details);
                break;

            case 'more-info':
                $customerEmail = new MoreInfoMail($details);
                $customerRecipient = $details->rtiApplication['email'] ?? null;
                $adminEmail = new AdminMoreInfoRequestMail($details);
                break;

            case 'lawyer-resgister':
                $customerEmail = new LawyerRegister($details);
                $customerRecipient = $details->lawyer['email'] ?? null;
                break;

            case 'send-back-to-admin':
                $adminEmail = new SendBackToAdminRequestMail($details);
                break;

            case 'newsletter':
                $customerEmail = new NewsletterMail($details);
                $customerRecipient = $details['email'] ?? null;
                $adminEmail = new AdminNewsletterMail($details);
                break;

            case 'refund-response-response':
                $customerEmail = new RefundRequestResponse($details);
                $customerRecipient = $details->rtiApplication['email'] ?? null;
                break;

            case 'enquiry':
                $adminEmail = new EnquiryMail($details);
                break;
                
            case 'promotion-mail':
                $template = MailTemplate::list(false, ['id' => $details['mail_template']]);
                if (count($template) > 0) {
                    $customers = Customer::list(false, ['ids' => $details['customers']]);
                    foreach($customers as $item) {
                        $html = str_replace(["{{name}}", "{{ name }}"], $item->fullName, $template[0]->html);
                        $email = new PromotionMail(['html' => $html, 'subject' => $template[0]->subject]);
                        Mail::to($item->email)->send($email);
                    }
                }
                // No need to continue to the generic send block for promotion-mail
                return; 
                
            default:
                // Fallback for types not explicitly listed, matching your original code's else block
                $customerEmail = new ApplicationRegister($details);
                $customerRecipient = $details['email'] ?? null;
                break;
        }

        // --- Consolidated Sending Block ---
        
        // 1. Send Customer Email
        if ($customerEmail && $customerRecipient) {
            Mail::to($customerRecipient)->send($customerEmail);
        }

        // 2. Send Admin Email
        if ($adminEmail && $adminRecipient) {
            Mail::to($adminRecipient)->send($adminEmail);
        }
        
        // 3. Send Lawyer Email
        if ($lawyerEmail && $lawyerRecipient) {
            Mail::to($lawyerRecipient)->send($lawyerEmail);
        }
    }
}