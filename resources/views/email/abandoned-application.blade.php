@component('mail::message')
# Don't Let Your Application Expire!

Hello {{ $data->customer->first_name ?? $data->first_name ?? 'there' }},

We noticed you started your **{{ $data->service->name ?? 'Application' }}** (Application No: **{{ $data->application_no }}**) but haven't completed the payment yet. 

Your application details and uploaded documents are saved securely in our system. If the payment is not completed, your application may eventually be deleted.

Click the button below to complete your payment and move forward with your request.

@component('mail::button', ['url' => route('service.form', [$data->serviceCategory->slug->slug, $data->service->slug->slug ?? 'custom-request']) . '?application_no=' . $data->application_no])
Complete Payment Now
@endcomponent

If you've already completed the payment, please ignore this email. If you have any questions, please contact our support team.

Thanks,
{{ config('app.name') }} Team
@endcomponent