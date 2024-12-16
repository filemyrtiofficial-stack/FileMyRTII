<?php

function commonStatus() {
    return [
        0 => [
            'name' => 'Inactive',
            'class' => 'text-danger'
        ],
        1 => [
            'name' => 'Active',
            'class' => 'text-success'
        ]
        ];
}

function blogStatus() {
    return [
            1 => [
                'name' => 'Draft',
                'class' => 'text-danger'
            ],
            2 => [
                'name' => 'Publish',
                'class' => 'text-success'
            ]
        ];
}

function daysList() {
    return [
        'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' 
    ];
}

function dayList() {
    return [
        'sunday' => 1, 'monday' => 2, 'tuesday' => 3, 'wednesday' => 4, 'thursday' => 5, 'friday' => 6, 'saturday' => 7
    ];
}

function BooleanList() {
    return [
        'no' => [
            'name' => 'No',
            'class' => 'text-danger'
        ],
        'yes' => [
            'name' => 'Yes',
            'class' => 'text-success'
        ]
        ];
}

function uploadFile($request, $key, $path) {
    $file_name = $key;
    if($request->hasFile($file_name)){
        $path = '/upload/'.$path;
        $filenameWithExt = $request->file($file_name)->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file($file_name)->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $file = $request->file($file_name) ;
        $destinationPath = public_path().$path ;
        $file->move($destinationPath,$fileNameToStore);
        // $path = $request->file($file_name)->storeAs('public/'.$path,$fileNameToStore);
        return $path."/".$fileNameToStore;
    }
    return "";
}

function multipleFiles($request, $key, $path) {
    $file_list = [];
    $path = '/upload/'.$path;
    if($request->hasFile($key))
    {
        $files = $request->file($key);
        foreach($files as $file){

            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = public_path().$path ;
            $file->move($destinationPath,$fileNameToStore);

            // $path = $file->storeAs('public/'.$path,$fileNameToStore);
            array_push($file_list, $path."/".$fileNameToStore);
        }
    }
    return $file_list;
}

function getIds($data, $key) {
    $data =  $data;
    return array_column($data, $key);
}


function ourServices() {
    return [
        'standard-quality-assurance'=>[
            'icon' => asset('frontend/images/icon/standard-quality-assurance.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Standard Quality Assurance",
            'short_description' => "Enhance Trust and Quality Seamlessly: Achieve NABH Accrediation with our expert guidance. Boost your hospital's credibility and patient trust effortlessly!"
        ],
        'hospital-outline-and-tariff-structuring' => [
            'icon' => asset('frontend/images/icon/hospital-outline-and-tariff-structuring.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Hospital Outline and tariff structuring",
            'short_description' => "Enhance visiblity and market appeal with a comprehensive and accurate hospital profiles."
        ],
        'cashless-empanelment' => [
            'icon' => asset('frontend/images/icon/cashless-empanelment.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Cashless Empanelment",
            'short_description' => "Make Patient Access Simple and Smooth: Make healthcare accessible through partnership with insurance provider, corporate tie-ups and government PSU'S"
        ],
        'revenue-cycle-management' => [
            'icon' => asset('frontend/images/icon/revenue-cycle-management.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Revenue Cycle Management (RCM)",
            'short_description' => "Optimize Financial Operations Effortlessly: Enahance financial performance through efficient, transparent automated billing and claims managment."
        ],
        'health-information-exchange' => [
            'icon' => asset('frontend/images/icon/health-information-exchange.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Health Information Exchange",
            'short_description' => "Broadern Your Service Readh Easily: Our user-friendly mobile app enable patients to access their health information, Schecule appointments and communicate with healthcare providers seamlessly."
        ],
        'brand' => [
            'icon' => asset('frontend/images/icon/brand.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Brand",
            'short_description' => "Conduct audits regularly to ensure that every partner  location strictly adheres to Gratis Healthcare's brand guildlines..."
        ],
        'marketing-and-outreach'  => [
            'icon' => asset('frontend/images/icon/marketing-and-outreach.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Marketing and Outreach",
            'short_description' => "Increase visibility and Attract More Patients: Elevate your online presence and attract new patients with our targated marketing strategies."
        ],
        'community-engagement' => [
            'icon' => asset('frontend/images/icon/community-engagement.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Community Engagement",
            'short_description' => "Organize health camps, workshops, and seminars to educate the public, offer free health screenings, and promote wellness."
        ],
        'financial-planning-and-sustainability' => [
            'icon' => asset('frontend/images/icon/financial-planning-and-sustainability.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Financial planning and Sustainability",
            'short_description' => "Ensure the long-term financial health and sustainability of the hospital network throgh strategic planning and efficient operations."
        ],
        'patient-centric-excellence' => [
            'icon' => asset('frontend/images/icon/patient-centric-excellence.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Patient-Centric Excellence",
            'short_description' => "Focus on delivering and exceptional patient experience by prioritizing care, comfront and convenience."
        ],
        'training-and-support' => [
            'icon' => asset('frontend/images/icon/training-and-support.png'),
            'banner' => asset('frontend/images/service-banner.jpeg'),
            "name" => "Training & Support",
            'short_description' => "A robust training & support programs covering medical protocols, use of technology customer service and managment best practices."
        ]
        ];

}


function faqList() {
    return [
        [
            'question' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "answer" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum. "
        ],
        [
            'question' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "answer" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum. "
        ],
        [
            'question' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "answer" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum. "
        ],
        [
            'question' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "answer" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum. "
        ],
        [
            'question' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "answer" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum. "
        ],
        [
            'question' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "answer" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum. "
        ],
        [
            'question' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "answer" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum. "
        ]
        ];
}

function testimonials() {
    return [
        [
            'name' => 'Lorem',
            'star' => 3,
            "feedback" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum.'
        ],
        [
            'name' => 'Lorem',
            'star' => 5,
            "feedback" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum.'
        ],
        [
            'name' => 'Lorem',
            'star' => 5,
            "feedback" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum.'
        ],
        [
            'name' => 'Lorem',
            'star' => 5,
            "feedback" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum.'
        ],
        [
            'name' => 'Lorem',
            'star' => 5,
            "feedback" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum.'
        ],
        [
            'name' => 'Lorem',
            'star' => 5,
            "feedback" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus libero nisl, congue lobortis libero maximus eu. Nullam feugiat congue tristique. Nulla justo dui, suscipit ac nulla ut, condimentum sollicitudin turpis. Suspendisse at blandit orci. Sed faucibus quam in ultricies hendrerit. Sed lacinia mauris eu justo maximus condimentum.'
        ]
    ];

}
function checkSlug($slug, $id = null) {
    $check_slug = App\Models\SlugMaster::where('slug', $slug);
    if($id != null) {
        $check_slug->where('id', '!=', $id);
    }
    $check_slug = $check_slug->first();
    return $check_slug;
}

function getColumnData($data, $key) {
    return array_column($data, $key);
}

function fieldTypeList() {

    return $field_list = [
        'General' => [
                        'boolean' => [
                            'field_type' => 'Boolean',
                            'field_key' => 'boolean',
                            'limit' => 1,
                            'required' => false
                        ],
                        'date' => [
                            'field_type' => 'Date',
                            'field_key' => 'date',
                        ],
                        'email' => [
                            'field_type' => 'Email',
                            'field_key' => 'email',
                        ],
                        'link' => [
                            'field_type' => 'Link',
                            'field_key' => 'link',
                        ],
                    ],
        'Number' => [
                        'list-float' => [
                            'field_type' => 'List (float)',
                            'field_key' => 'list-float',
                        ],
                        'list-integer' => [
                            'field_type' => 'List (integer)',
                            'field_key' => 'list-integer',
                        ],
                        'number-decimal' => [
                            'field_type' => 'Number (decimal)',
                            'field_key' => 'number-decimal',
                        ],
                        'number-float' => [
                            'field_type' => 'Number (float)',
                            'field_key' => 'number-float',
                        ],
                        'number-integer' => [
                            'field_type' => 'Number (integer)',
                            'field_key' => 'number-integer',
                        ],
                    ],
        'Text' => [
                        'list-text' => [
                            'field_type' => 'List (Text)',
                            'field_key' => 'list-text',
                        ],
                        'text-formatted' => [
                            'field_type' => 'Text (formatted)',
                            'field_key' => 'text-formatted',
                        ],
                        'text-formatted-long' => [
                            'field_type' => 'Text (formatted, long)',
                            'field_key' => 'text-formatted-long',
                        ],
                        'text-formatted-long-summary' => [
                            'field_type' => 'Text (formatted, long, with summary)',
                            'field_key' => 'text-formatted-long-summary',
                        ],
                        'text-plain' => [
                            'field_type' => 'Text (Plain)',
                            'field_key' => 'text-plain',
                        ],
                        'text-plain-long' => [
                            'field_type' => 'Text (Plain, Long)',
                            'field_key' => 'text-plain-long',
                        ],
                    ],
        'Reference' => [
                        'file' => [
                            'field_type' => 'File',
                            'field_key' => 'file',
                            'allow_extension' => [
                                'lable' => "Allowed file extensions",
                                'required' => true,
                                'fields' => [
                                        [
                                            'type' => 'input',
                                            'name' => "allow_extension",
                                            'default' => 'txt',
                                        ]
                                    ]
                            ],
                            "upload-size" => [
                                'lable' => "Maximum upload size",
                                'required' => false,
                                'default' => "6 GB",
                                'fields' => [
                                        [
                                            'type' => 'input',
                                            'name' => "upload_size",
                                        ]
                                    ]
                            ]

                        ],
                        'image' => [
                            'field_type' => 'Image',
                            'field_key' => 'image',
                            'additional_fields' => [

                                'allow_extension' => [
                                    'lable' => "Allowed file extensions",
                                    'required' => true,
                                    'fields' => [
                                        [
                                            'type' => 'input',
                                            'name' => "allow_extension",
                                            'default' => 'png, gif, jpg, jpeg',
                                        ]
                                    ]

                                ],
                                "min-resolution" => [
                                    'lable' => "Minimum image resolution",
                                    'required' => false,
                                    'note' => 'The minimum allowed image size expressed as WIDTH×HEIGHT (e.g. 640×480). Leave blank for no restriction. If a smaller image is uploaded, it will be rejected.',
                                    'fields' => [
                                            [
                                                'type' => 'input',
                                                'name' => "min_height",
                                                'lable' => "Min Height"
                                            ],
                                            [
                                                'type' => 'input',
                                                'name' => "min_width",
                                                'lable' => "Min Width"

                                            ]
                                        ]

                                ],
                                "max-resolution" => [
                                    'lable' => "Maximum image resolution Maximum width",
                                    'required' => false,
                                    'note' => 'The maximum allowed image size expressed as WIDTH×HEIGHT (e.g. 640×480). Leave blank for no restriction. If a larger image is uploaded, it will be resized to reflect the given width and height. Resizing images on upload will cause the loss of EXIF data in the image.',
                                    'fields' => [
                                        [
                                            'type' => 'input',
                                            'name' => "max_height",
                                            'lable' => "max Height"
                                        ],
                                        [
                                            'type' => 'input',
                                            'name' => "max_width",
                                            'lable' => "max Width"

                                        ]
                                    ]
                                ],
                                "upload-size" => [
                                    'lable' => "Maximum upload size",
                                    'required' => false,
                                    'default' => "6GB",
                                    'fields' => [
                                        [
                                            'type' => 'input',
                                            'name' => "upload_size",
                                        ]
                                    ]
                                ]
                            ]

                        ],
                        'service-category' => [
                            'field_type' => 'Service Category',
                            'field_key' => 'service-category',
                        ],
                        'service' => [
                            'field_type' => 'Service',
                            'field_key' => 'service',
                        ],
                        'blog-category' => [
                            'field_type' => 'Blog (Category)',
                            'field_key' => 'blog-category',
                        ],
                        'team-members' => [
                            'field_type' => 'Team Members',
                            'field_key' => 'team-members',
                        ],
                        'lawyers' => [
                            'field_type' => 'Lawyers',
                            'field_key' => 'lawyers',
                        ],
                        'sections' => [
                            'field_type' => 'Sections',
                            'field_key' => 'sections',
                            'additional_fields' => [
                                "select-sections" => [
                                    'lable' => "Select Section For Reference",
                                    'required' => true,
                                    'fields' => [
                                        [
                                            'type' => 'select',
                                            'name' => "section_list",
                                            'options' => sectionList()
                                        ]
                                    ]
                                ]
                            ]
                        ],
                    ]
    ];
}

function sectionList() {
    return App\Models\TemplateSection::select('id', 'section as name')->get();
}

function getTypeDetails($key) {
    $key = explode("#",$key);
    return fieldTypeList()[$key[0]][$key[1]];

}

function allNumberOfValueOptions() {
    return [
        'unlimited' => "Unlimited",
        'limited' => "Limited",
        ];
}


function templateList() {
    return $template = [
            'home_banner' => [
                "section_name" => "Hero Banner",
                'key' => 'home_banner',
                "fields" => [
                    [
                        "type" => 'input',
                        "lable" => 'Title',
                        'name' => "banner_title",

                    ],
                    [
                        "type" => 'textarea',
                        "lable" => 'Description',
                        'name' => "banner_description",

                    ],
                    [
                        "type" => 'image',
                        "lable" => 'Mobile Banner',
                        'name' => "banner_mobile_image",

                    ],
                    [
                        "type" => 'image',
                        "lable" => 'Desktop Banner',
                        'name' => "banner_desktop_image",

                    ],
                    [
                        "type" => 'link',
                        'lable' => "File My RTI Now",
                        'fields' => [
                            [
                                "type" => 'input',
                                "lable" => 'Title',
                                'name' => "banner_link_title",
        
                            ],
                            [
                                "type" => 'input',
                                "lable" => 'Url',
                                'name' => "banner_link_url",
        
                            ],
                        ]
                    ],
                    [
                        "type" => "section",
                        "key" => 'hero_banner_review_slider',
                        'section_name' => "Review Slider",
                        'repeat' => 10,
                        "fields" => [
                            [
                                "type" => 'input',
                                "lable" => 'Title',
                                'name' => "banner_review_slider_title",

                            ],
                            [
                                "type" => 'textarea',
                                "lable" => 'Description',
                                'name' => "banner_review_slider_description",

                            ],
                            [
                                "type" => 'image',
                                "lable" => 'Image',
                                'name' => "banner_review_slider_image",

                            ],
                        ]
                    ]
                ]
            ],
            // 'banner' => [
            //     "section_name" => "Banner",
            //     'key' => 'banner',
            //     "fields" => [
            //         [
            //             "type" => 'input',
            //             "lable" => 'Title',
            //             'name' => "banner_title",

            //         ],
            //         [
            //             "type" => 'image',
            //             "lable" => 'Mobile Banner',
            //             'name' => "banner_image",

            //         ],
            //         [
            //             "type" => 'link',
            //             'lable' => "Redirection Link",
            //             'fields' => [
            //                 [
            //                     "type" => 'input',
            //                     "lable" => 'Title',
            //                     'name' => "link_title",
        
            //                 ],
            //                 [
            //                     "type" => 'input',
            //                     "lable" => 'Url',
            //                     'name' => "link_url",
        
            //                 ],
            //             ]
            //         ]
            //     ]
            // ],
            'our_blogs' => [
                "section_name" => "Our Blogs",
                'key' => 'our_blogs',
                "fields" => [
                    [
                        "type" => 'input',
                        "lable" => 'Title',
                        'name' => "title",

                    ],
                    [
                        "type" => 'select',
                        'lable' => "All Multiple",
                        'name' => "all_multiple",
                        'options' => yesNoOption(),
                        'target' => 'our_blogs_blog_list'

                        
                    ],
                    [
                        "type" => 'select',
                        'lable' => "Select Blogs",
                        'name' => "blog_list",
                        'options' => App\Models\Blog::list(false, ['status' => 2]),
                        'check_multiple_type' => 'our_blogs_all_multiple'
                        
                    ]
                    
                ]
            ],
            'how_it_works' => [
                "section_name" => "How It Works",
                'key' => 'how_it_works',
                "fields" => [
                    [
                        "type" => 'input',
                        "lable" => 'Title',
                        'name' => "title",

                    ],
                    [
                        "type" => 'link',
                        'lable' => "Redirection Link",
                        'fields' => [
                            [
                                "type" => 'input',
                                "lable" => 'Title',
                                'name' => "link_title",
        
                            ],
                            [
                                "type" => 'input',
                                "lable" => 'Url',
                                'name' => "link_url",
        
                            ],
                        ]
                    ],
                    [
                        "type" => 'section',
                        'lable' => "",
                        'name' => "",
                        'repeat' => 3,
                        'key' => 'journey_list',
                        "fields" => [
                            [
                                "type" => 'input',
                                "lable" => 'Title',
                                'name' => "section_title",

                            ],
                            [
                                "type" => 'textarea',
                                "lable" => 'Description',
                                'name' => "section_description",

                            ],
                            [
                                "type" => 'image',
                                "lable" => 'Image',
                                'name' => "section_image",

                            ],
                        ]

                        
                    ],
                    
                    
                ]
            ],
            'service_tabs' => [
                "section_name" => "Services In Tab",
                'key' => 'service_tabs',
                "fields" => [
                    [
                        "type" => 'input',
                        "lable" => 'Title',
                        'name' => "title",

                    ],
                    [
                        "type" => 'link',
                        'lable' => "Redirection Link",
                        'fields' => [
                            [
                                "type" => 'input',
                                "lable" => 'Title',
                                'name' => "link_title",
        
                            ],
                            [
                                "type" => 'input',
                                "lable" => 'Url',
                                'name' => "link_url",
        
                            ],
                        ]
                    ],
                    [
                        "type" => 'search',
                        'lable' => "",
                        'name' => "",
                        'repeat' => 4,
                        'key' => 'Service_category',
                        "fields" => [
                            [
                                "type" => 'input',
                                "lable" => 'Service Category',
                                'name' => "catgeory",

                            ]
                        ]

                        
                    ],
                    
                    
                ]
            ],
            'top_banner' => [
                "section_name" => "Banner Design 2",
                'key' => 'top_banner'
               
            ],

            'footer_banner' => [
                "section_name" => "Footer Banner",
                'key' => 'footer_banner'
               
            ],
            'left_image_right_text' => [
                "section_name" => "Left Image Right Text",
                'key' => 'left_image_right_text'
               
            ],
            'right_image_left_text' => [
                "section_name" => "Right Image Left Text",
                'key' => 'right_image_left_text'
               
            ],
            'right_image_left_accordian' => [
                "section_name" => "Right Image Left Accordian",
                'key' => 'right_image_left_accordian'
               
            ],
            'our_team' => [
                "section_name" => "Our Team",
                'key' => 'our_team'
               
            ],
                

      
    ];
}

function yesNoOption() {
    return [
        [
            'id' => 'yes',
            'name' => 'Yes'
        ],
        [
            'id' => 'no',
            'name' => 'No'
        ]
        ];
}

function serviceCategoryOptions($selected = null)  {
    $list = "";
    foreach(App\Models\ServiceCategory::list(false) as $item) {
        $is_selected = "";
        if($selected == $item->id) {
            $is_selected = "selected";
        }
        $list .= '<option value="'.$item->id.'" '.$is_selected.'>'.$item->name.'</option>';
    }
    return $list;
}

function sectionTemplateOptions($type, $selected = null)  {
    $list = "";
    foreach(App\Models\Section::list(false, ['type' => $type]) as $item) {
        $is_selected = "";
        if($selected == $item->id) {
            $is_selected = "selected";
        }
        $list .= '<option value="'.$item->id.'" '.$is_selected.'>'.$item->title.'</option>';
    }
    return $list;
}



function sectionTypeList() {
    return [
        'how_it_works' => [
            'title' => 'How it works',
            'fields' => [
                [
                    'type' => 'input',
                    'label' => 'Title',
                    'name' => 'title',
                    'required' => true
                ],
                [
                    'type' => 'image',
                    'label' => 'Icon',
                    'name' => 'icon',
                    'required' => true
                ],
                [
                    'type' => 'textarea',
                    'label' => 'Description',
                    'name' => 'description',
                    'required' => true
                ],
            ]
        ],
            'footer_banner' => [
            'title' => 'footer Banner',
            'fields' => [
                [
                    "type" => 'link',
                    'lable' => "File My RTI Now"
                    
                ],
            ]
        ]
    ];
}

function teamOptions($selected = null)  {
    $list = "";
    foreach(App\Models\TeamMember::list(false) as $item) {
        $is_selected = "";
        if($selected == $item->id) {
            $is_selected = "selected";
        }
        $list .= '<option value="'.$item->id.'" '.$is_selected.'>'.$item->name.'</option>';
    }
    return $list;
}

function blogOptions($selected = null)  {
    $list = "";
    foreach(App\Models\Blog::list(false) as $item) {
        $is_selected = "";
        if($selected == $item->id) {
            $is_selected = "selected";
        }
        $list .= '<option value="'.$item->id.'" '.$is_selected.'>'.$item->title.'</option>';
    }
    return $list;
}

function permissionList($parent_id) {
    $permissions = Spatie\Permission\Models\Permission::where(['parent_id' => $parent_id])->get();
}

function fieldList() {
    return [
        'input' => 'Input',
        'textarea' => 'Textarea',
        'boolean' => 'boolean',


    ];
}

function fieldListOptions($selected = null)  {
    $list = "";
    foreach(fieldList() as $key => $value) {
        $is_selected = "";
        if($selected == $key) {
            $is_selected = "selected";
        }
        $list .= '<option value="'.$key.'" '.$is_selected.'>'.$value.'</option>';
    }
    return $list;
}

function booleanListOptions($selected = null)  {
    $list = "";
    foreach(BooleanList() as $key => $value) {
        $is_selected = "";
        if($selected == $key) {
            $is_selected = "selected";
        }
        $list .= '<option value="'.$key.'" '.$is_selected.'>'.$value['name'].'</option>';
    }
    return $list;
}

