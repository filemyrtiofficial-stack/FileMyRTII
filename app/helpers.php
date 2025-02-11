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



function formAdditionalFields() {
    return [
        'customer' => [
            'name' => 'Customer',
        ],
        'lawyer' => [
            'name' => 'Lawyer',
        ],
        ];
}

function formAdditionalFieldOptions($selected = null)  {
    $list = "";
    foreach(formAdditionalFields() as $key => $value) {
        $is_selected = "";
        if($selected == $key) {
            $is_selected = "selected";
        }
        $list .= '<option value="'.$key.'" '.$is_selected.'>'.$value['name'].'</option>';
    }
    return $list;
}


function applicationStatus() {
    return [
            1 => [
                'name' => 'Pending',
                'class' => 'text-warning'
            ],
            2 => [
                'name' => 'Approved',
                'class' => 'text-info'
            ],
            3 => [
                'name' => 'Filed',
                'class' => 'text-success'
            ]
        ];
}

function paymentStatus() {
    return [
            'pending' => [
                'name' => 'Pending',
                'class' => 'text-danger'
            ],
            'paid' => [
                'name' => 'Paid',
                'class' => 'text-success'
            ],
           
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
            $file_name = $path."/".$fileNameToStore;
            array_push($file_list, ['file' => $file_name, 'path' => route('preview-document',Crypt::encryptString($file_name))]);
        }
    }
    return $file_list;
}

function getIds($data, $key) {
    $data =  $data;
    return array_column($data, $key);
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
            'faqs' => [
                "section_name" => "Faqs",
                'key' => 'faqs'
               
            ],
            'accordian_with_side_tabing' => [
                "section_name" => "Accordian with side tabing",
                'key' => 'accordian_with_side_tabing'
               
            ],
            'testimonial_slider' => [
                "section_name" => "Testimonial Slider",
                'key' => 'testimonial_slider'
               
            ],
            'why_choose' => [
                "section_name" => "Why Choose",
                'key' => 'why_choose'
               
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
                    'type' => 'select',
                    'label' => 'Status',
                    'name' => 'status',
                    'required' => true,
                    'options' => commonStatus()
                ],
                [
                    'type' => 'image',
                    'label' => 'Icon',
                    'name' => 'image',
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
                    'type' => 'input',
                    'label' => 'Title',
                    'name' => 'title',
                    'required' => true
                ],
                [
                    'type' => 'select',
                    'label' => 'Status',
                    'name' => 'status',
                    'required' => true,
                    'options' => commonStatus()
                ],
                [
                    'type' => 'image',
                    'label' => 'Icon',
                    'name' => 'image',
                    'required' => true
                ],
                [
                    'type' => 'textarea',
                    'label' => 'Description',
                    'name' => 'description',
                    'required' => true
                ],
                [
                    "type" => 'link',
                    'lable' => "File My RTI Now"
                    
                ],
            ]
            ],
            'why_choose' => [
                'title' => 'Why Choose',
                'fields' => [
                    [
                        'type' => 'input',
                        'label' => 'Title',
                        'name' => 'title',
                        'required' => true
                    ],
                    [
                        'type' => 'select',
                        'label' => 'Status',
                        'name' => 'status',
                        'required' => true,
                        'options' => commonStatus()
                    ],
                    [
                        'type' => 'image',
                        'label' => 'Icon',
                        'name' => 'image',
                        'required' => true
                    ],
                    [
                        'type' => 'image',
                        'label' => 'Icon 2',
                        'name' => 'image_2',
                        'required' => true
                    ],
                    [
                        'type' => 'textarea',
                        'label' => 'Description',
                        'name' => 'description',
                        'required' => true
                    ],
                    [
                        'type' => 'numeric',
                        'label' => 'Sequance',
                        'name' => 'sequance',
                        'required' => true
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

function permissionList($parent_id = 0) {
    $permissions = Spatie\Permission\Models\Permission::where(['parent_id' => $parent_id])->get();
    return $permissions;
}

function fieldList() {
    return [
        'input' => 'Input',
        'textarea' => 'Textarea',
        'date' => 'Date',

        // 'boolean' => 'boolean',


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

function array_remove_null($item)
{
    if (!is_array($item)) {
        return $item;
    }
   return collect($item)
        ->reject(function ($item) {
            return is_null($item);
        })
        ->flatMap(function ($item, $key) {
            return is_numeric($key)
                ? [array_remove_null($item)]
                : [$key => array_remove_null($item)];
        })
        ->toArray();
}

function shareUrl() {
    $url =  Illuminate\Support\Facades\URL::current();
    return [
        'facebook' =>'https://www.facebook.com/sharer/sharer.php?u=' . $url,
        'tweeter' =>'https://twitter.com/intent/tweet?url=' . $url,
        'linkedin' =>'https://www.linkedin.com/shareArticle?url=' . $url,
        'blogurl' => $url

    ];
}

function TestimonialOptions($selected = null)  {
    $list = "";
    foreach(App\Models\Testimonial::list(false) as $item) {
        $is_selected = "";
        if($selected == $item->id) {
            $is_selected = "selected";
        }
        $list .= '<option value="'.$item->id.'" '.$is_selected.'>'.$item->client_name.'</option>';
    }
    return $list;
}

function partition() {
    return [
        '5-6' => [
            'column_1' => 'col-sm-5',
            'column_2' => 'col-sm-6',
        ],
        '6-6' => [
            'column_1' => 'col-sm-6',
            'column_2' => 'col-sm-6',

        ]
    ];
}

function encryptString($string) {
    return Illuminate\Support\Facades\Crypt::encryptString($string);
}


function decryptString($string) {
    return Illuminate\Support\Facades\Crypt::decryptString($string);
}

function addDays($day, $date) {
    return Carbon\Carbon::parse($date)->addDays($day);
}

function getRtiDate($filter) {
    $data = App\Models\ApplicationStatus::where($filter)->first();
    if($data) {
        return Carbon\Carbon::parse($data->date)->format('d/m/Y');
    }
    return "";
}
function getFieldName($field) {
   $field = Illuminate\Support\Str::slug($field);
   return str_replace("-", "_", $field);

}

function filePreview($file_name) {
    return route('preview-document',Crypt::encryptString($file_name));
}


function invoicePreviewPath($application_no, $appeal_no) {
    return filePreview(asset('upload/pdf/'.'invoice_' .$application_no .'_appeal_no_'.$appeal_no.'.pdf'));
}

function rtiPersonalDetailFields() {
    return [
        'first_name' => [
            'label' => "First Name"
        ],
        'last_name' => [
            'label' => "Last Name"
        ],
        'email' => [
            'label' => "Email"
        ],
        'phone_number' => [
            'label' => "Phone Number"
        ],
        'address' => [
            'label' => "Address"
        ],
        'city' => [
            'label' => "City"
        ],
        'state' => [
            'label' => "State"
        ],
        'pincode' => [
            'label' => "Pincode"
        ],
    ];
}

function notifictaionList($filter) {
    return App\Models\Notification::where($filter)->orderBy('id', 'desc')->get();
}
function applicationCloseRequestsStatus() {
    return [
            0 => [
                'name' => 'Pending',
                'class' => 'text-warning'
            ],
            1 => [
                'name' => 'Approved',
                'class' => 'text-info'
            ]
           
        ];
}