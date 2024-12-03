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