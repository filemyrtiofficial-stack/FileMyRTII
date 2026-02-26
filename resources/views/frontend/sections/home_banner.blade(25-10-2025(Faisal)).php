<header class="section_banner">
    <div class="header_bg_img" style="background-image: url({{asset($data['home_banner_banner_desktop_image'] ?? '')}});">
        <div class="container">
            <div class="row banner_row">
                <div class="col-12 col-sm-6">
                    <div class="header_text">
                        {{-- 
                            *** START OF CHANGES: Replacing dynamic H1, P, and A tag with new button structure ***
                            
                            Original structure was:
                            <h1 class="title">{!! $data['title'] ?? '' !!}</h1>
                            <p class="fs-24">{!! $data['home_banner_description'] ?? '' !!}</p>
                            <a href="{{config('app.base_url')}}{!! $data['home_banner_banner_link_url'] ?? '' !!}" class="theme-btn"><span>{!! $data['home_banner_banner_link_title'] ?? '' !!}</span></a>
                        --}}
                        
                        {{-- Start of New Button/CTA Block --}}
                        <div class="xwrap-container">
                            <style>
                                :root {
                                    --brand-500: #1760a6;
                                    --brand-700: #0c3a62;
                                    --ink: #12324a;
                                    --ink-strong: #0b3b58;
                                    --panel-top: #f6fbff;
                                    --panel-bottom: #eef8ff;
                                    --ring: #7fb6e8;
                                    --shadow: 0 8px 22px rgba(36, 78, 110, 0.08);
                                    --radius: 18px;
                                }
                                
                                @media (prefers-color-scheme: dark) {
                                    :root {
                                        --ink: #dbe7f3;
                                        --ink-strong: #ffffff;
                                        --panel-top: #0e2234;
                                        --panel-bottom: #0b1a28;
                                        --shadow: 0 10px 24px rgba(0, 0, 0, 0.35);
                                    }
                                }
                                
                                .xwrap-container {
                                    /* Apply container styling to integrate better with the theme */
                                    padding-top: 20px;
                                }

                                /* Custom styles for the hero section integration */
                                .header_text .xwrap {
                                    max-width: 100%; /* Ensure it fits the column */
                                    padding: 0;
                                    margin: 0;
                                }
                                
                                .header_text .xgrid {
                                    gap: 16px;
                                }

                                .xwrap {
                                    max-width: 960px;
                                    margin: 0 auto;
                                    padding: 24px 16px;
                                }
                                
                                .xgrid {
                                    display: flex;
                                    flex-direction: column;
                                    gap: 16px;
                                    align-items: stretch;
                                }
                                
                                @media (min-width: 640px) {
                                    .xgrid {
                                        flex-direction: row;
                                        gap: 24px;
                                    }
                                }
                                
                                .xcard {
                                    position: relative;
                                    flex: 1 1 0;
                                    min-height: 176px;
                                    border-radius: var(--radius);
                                    background: linear-gradient(180deg, var(--panel-top), var(--panel-bottom));
                                    border: 1.5px solid rgba(10, 110, 200, 0.18);
                                    box-shadow: var(--shadow);
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    cursor: pointer;
                                    transition: transform 0.18s ease;
                                }
                                
                                .xcard:hover {
                                    transform: translateY(-2px);
                                }
                                
                                .xcontent {
                                    width: 100%;
                                    text-align: center;
                                    padding: 26px 20px;
                                }
                                
                                .xtext {
                                    margin: 6px 0 18px;
                                    font: 500 17px/1.45 system-ui, Inter, sans-serif;
                                    color: var(--ink);
                                }
                                
                                .xtext strong {
                                    color: var(--ink-strong);
                                    font-weight: 800;
                                }
                                
                                .xcta {
                                    display: inline-block;
                                    min-height: 44px;
                                    padding: 12px 40px;
                                    border-radius: 40px;
                                    font: 800 17px/1 system-ui, Inter, sans-serif;
                                    color: #fff;
                                    text-align: center;
                                    transition: transform 0.14s ease;
                                    user-select: none;
                                }
                                
                                .xcta:hover {
                                    transform: scale(1.04);
                                }
                                
                                .xprimary {
                                    background: linear-gradient(180deg, #1a67b0 0%, var(--brand-700) 100%);
                                }
                                
                                .xsecondary {
                                    background: linear-gradient(180deg, #1f6fa6 0%, #0b5a86 100%);
                                }
                                
                                .xbadge {
                                    position: absolute;
                                    top: -12px;
                                    left: 50%;
                                    transform: translateX(-50%);
                                    padding: 6px 12px;
                                    font: 700 11px/1 Inter, sans-serif;
                                    color: #fff;
                                    border-radius: 999px;
                                    background: linear-gradient(180deg, #0b79c9, #055b9b);
                                    box-shadow: 0 6px 18px rgba(11, 121, 201, 0.18);
                                }
                                
                                /* === modal styles === */
                                .modal-bg {
                                    position: fixed;
                                    inset: 0;
                                    background: rgba(0, 0, 0, 0.55);
                                    backdrop-filter: blur(8px);
                                    display: none;
                                    align-items: center;
                                    justify-content: center;
                                    z-index: 999;
                                }
                                
                                .modal {
                                    background: #fff;
                                    max-width: 600px;
                                    width: 90%;
                                    border-radius: 20px;
                                    padding: 30px 26px;
                                    text-align: center;
                                    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
                                    animation: fadeIn 0.3s ease;
                                    color: #0e2234;
                                    max-height: 85vh;
                                    overflow-y: auto;
                                }
                                
                                @keyframes fadeIn {
                                    from {
                                        opacity: 0;
                                        transform: translateY(10px);
                                    }
                                    to {
                                        opacity: 1;
                                        transform: translateY(0);
                                    }
                                }
                                
                                .modal h1 {
                                    font-size: 1.5rem;
                                    color: var(--brand-500);
                                    margin-bottom: 10px;
                                }
                                
                                .modal h2 {
                                    font-size: 1rem;
                                    color: #18486b;
                                    margin-bottom: 16px;
                                    line-height: 1.5;
                                }
                                
                                .modal p {
                                    font-size: 0.95rem;
                                    color: #2a4a66;
                                    line-height: 1.6;
                                    margin-bottom: 12px;
                                }
                                
                                .modal ul {
                                    text-align: left;
                                    list-style: none;
                                    padding-left: 0;
                                    margin: 16px 0;
                                    color: #1a3d58;
                                }
                                
                                .modal ul li::before {
                                    content: "✅ ";
                                }
                                
                                .modal-footer {
                                    display: flex;
                                    justify-content: center;
                                    gap: 16px;
                                    margin-top: 24px;
                                    flex-wrap: wrap;
                                }
                                
                                .btn {
                                    padding: 12px 32px;
                                    border-radius: 40px;
                                    font-weight: 700;
                                    font-size: 15px;
                                    cursor: pointer;
                                    user-select: none;
                                    transition: transform 0.15s ease, background 0.2s ease;
                                }
                                
                                .btn:hover {
                                    transform: scale(1.04);
                                }
                                
                                .btn-primary {
                                    background: var(--brand-500);
                                    color: #fff;
                                }
                                
                                .btn-secondary {
                                    background: #d8e9f8;
                                    color: var(--brand-700);
                                }
                                
                                @media (max-width: 480px) {
                                    .xtext {
                                        font-size: 15px;
                                    }
                                    
                                    .xcta {
                                        font-size: 15px;
                                        padding: 10px 24px;
                                    }
                                    
                                    .modal {
                                        width: 90%;
                                        padding: 24px 18px;
                                        max-height: 80vh;
                                        margin-top: 0;
                                    }
                                    
                                    .btn {
                                        width: 100%;
                                    }
                                }
                            </style>
                            <div class="xwrap">
                                <div class="xgrid" role="group" aria-label="RTI actions">
                                    <section
                                        class="xcard"
                                        tabindex="0"
                                        role="link"
                                        aria-label="File your RTI with our experts"
                                        onclick="navigateTo('https://mintcream-snake-956030.hostingersite.com/apply/social-rti/gram-panchayat-inquiry')"
                                        onkeydown="if(event.key==='Enter'||event.key===' '){navigateTo('https://mintcream-snake-956030.hostingersite.com/apply/social-rti/gram-panchayat-inquiry')}"
                                    >
                                        <div class="xcontent">
                                            <p class="xtext">
                                                Prefer a human touch? File your RTI with our <strong>RTI experts</strong>
                                            </p>
                                            <div class="xcta xprimary">Apply Now</div>
                                        </div>
                                    </section>
                                    <section
                                        class="xcard"
                                        tabindex="0"
                                        role="link"
                                        aria-label="Draft RTI with AI tool"
                                        onclick="openModal()"
                                        onkeydown="if(event.key==='Enter'||event.key===' '){openModal()}"
                                    >
                                        <div class="xbadge">NEW</div>
                                        <div class="xcontent">
                                            <p class="xtext">
                                                Draft your RTI easily with our AI Tool — <strong>RTI Dost</strong> — free
                                            </p>
                                            <div class="xcta xsecondary">Draft With AI</div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        {{-- End of New Button/CTA Block --}}
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="mobile_img">
                        <img class="img-fluid" src="{{asset($data['home_banner_banner_mobile_image'] ?? '')}}" alt="{{$data['home_banner_banner_mobile_image_alt'] ?? ''}}">
                    </div>
                </div>
            </div>
            <div class="row testimonial_row">
                <div class="col-auto">
                    <div class="slider_wrapper">
                        <div class="testimonial_slider">
                            @for($index = 0; $index < $data['banner_slider_list_row_count'] ?? 1; $index++)
                                <div class="item">
                                    <div class="testimonial_slide">
                                        <div class="profile">
                                            <img class="img-fluid" src="{{asset($data['home_banner_banner_review_slider_image_'.$index] ?? '')}}"
                                                alt="{{$data['home_banner_banner_review_slider_image_alt_'.$index] ?? ''}}">
                                        </div>
                                        <div class="slide_content">
                                            <div class="fs-20">
                                                <p>{!! $data['home_banner_banner_review_slider_description_'.$index] ?? '' !!} </p>
                                            </div>
                                            <div class="fs-20">
                                                <div class="user-name fw-700">
                    {!! $data['home_banner_banner_review_slider_title_'.$index] ?? '' !!}
                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- *** MODAL & SCRIPTS MOVED TO THE END OF THE FILE FOR CLEANER HTML STRUCTURE *** --}}

<div class="modal-bg" id="modalBg">
    <div class="modal" role="dialog" aria-modal="true">
        <h1>Your RTI Draft Is Just a Click Away!</h1>
        <h2>
            Powered by AI, perfected by experts — get your Right to Information draft instantly and accurately.
        </h2>
        <p>
            At FileMyRTI, we blend cutting-edge AI technology with real-world legal expertise to help you
            create a precise, legally valid RTI draft in minutes.
        </p>
        <ul>
            <li>No legal knowledge required</li>
            <li>AI-assisted + human-verified accuracy</li>
            <li>Option to file directly through FileMyRTI</li>
        </ul>
        <p><strong>AI Drafts It. We File It. You Get Results.</strong></p>
        <div class="modal-footer">
            <div class="btn btn-secondary" onclick="closeModal()">Cancel</div>
            <div class="btn btn-primary" onclick="proceed()">Continue to AI Tool</div>
        </div>
    </div>
</div>

<script>
    {{-- I'm assuming you will need to place the JavaScript in a <script> block 
         within this file or move it to a global JS file. 
         If you are using Laravel's @push('js') (as seen in your index.blade.php), 
         you should use that for the script.
    --}}
    const modalBg = document.getElementById("modalBg");
    
    function openModal() {
        modalBg.style.display = "flex";
        document.body.style.overflow = "hidden";
    }
    
    function closeModal() {
        modalBg.style.display = "none";
        document.body.style.overflow = "";
    }
    
    function proceed() {
        window.location.href = "https://chat.filemyrti.com";
    }
    
    function navigateTo(url) {
        window.location.href = url;
    }
</script>