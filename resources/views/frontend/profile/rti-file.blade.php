
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        height: 842px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
        position: relative;
    }
    .signature {
        position: absolute;
    right: 0px;
    }
    .title {
        text-align:center;
    }
</style>
</head>
<body>
<div class="title">
    <p><h3>The Right to Information Act, 2005</h3></p>
    <p><strong>Application for Obtaining Information</strong></p>
</div>

<div>

    <p>From</p>
    <p>
        <input type="text" name="full_name" class="text-input" placeholder="Full Name">
        <span class="text-span"></span>
    </p> 
    <p>
    <input type="text" name="address" class="text-input" placeholder="Address">
    <span class="text-span"></span>
    </p>
    <p>[City, State, Pin Code]</p> 
    <p>[Email Address]</p> 
    <p>[Phone Number]</p>
</div>

<div>

    <p>To</p>
    <p>The Public Information Officer </p>
    <p>[Examining Authority/Board Name]</p>
    <p>[Office Address]</p>
</div>


<div>
    <p>

        <strong>Subject:</strong> Request for Copy of Answer Sheet
    </p>
</div>


<div>
    <p><strong>Dear Public Information Officer,</strong></p>
    <p>Under the Right to Information Act, 2005, Section 6, I seek information regarding the evaluation of my examination. I request a copy of my evaluated answer sheet for the purpose of review. The details of my request are as follows:</p>
</div>

<div>
    <p><strong>Details of the Applicant:</strong></p>
    <ul>
        <li><strong>Name:</strong>  <input type="text" name="full_name" class="text-input" placeholder="Full Name">
        <span class="text-span"></span></li>
        <li><strong>Address:</strong> [Your Address]</li>
        <li><strong>Email:</strong> [Your Email Address]</li>
        <li><strong>Phone Number:</strong> [Your Phone Number]</li>
    </ul>
</div>

<div>
    <p><strong>Details of Information Required:</strong></p>
    <ul>
    <li><strong>Examination Name:</strong> [Insert Exam Name]</li>
    <li><strong>Roll Number:</strong> [Insert Roll Number]</li>
    <li><strong>Exam Date:</strong> [Insert Exam Date]</li>
    <li><strong>Subject/Paper Name:</strong> [Insert Subject/Paper Name]</li>
    <li><strong>Additional Details:</strong> [Provide any additional details to help identify the answer sheet]</li>
    </ul>
</div>


<div>
    <p><strong>Application Fee Details:</strong></p>
    <p>Application fee of ₹10/- paid by [Insert Payment Method: Court Fee Stamp/IPO/Online Payment].</p>
</div>
    

<div>
    <p><strong>Below Items for Your Kind Consideration:</strong></p>
    <ol>
        <li>As per Section 6(3) of the RTI Act, if the requested information pertains to another public authority, kindly transfer the application or part of it within five days and inform me accordingly.</li>
        <li>As per Section 7(3) of the RTI Act, in case additional fees are required to provide the requested information, kindly inform me of the additional amount along with a detailed calculation.</li>
        <li>As per Sections 7(8)(iii) and 7(3)(ii) of the RTI Act, kindly provide the particulars of the First Appellate Authority.</li>
    </ol>
</div>


<div>
    <p><strong>Declaration</strong></p>
    <p>I declare that I am a citizen of India and am entitled to seek information under the RTI Act, 2005.</p>
</div>



<div class="signature">
    <p>[Insert E-Signature]</p>
    <p><strong>Yours faithfully,</strong></p>
    <p> <input type="text" name="full_name" class="text-input" placeholder="Full Name">
        <span class="text-span"></span></p>
    <p>Date: {{Carbon\Carbon::now()->format('d/m/Y')}}</p>
</div>








</body>
</html>
