<?php

namespace App\Exports;

use App\Models\Newsletter;
use Maatwebsite\Excel\Concerns\FromCollection;

class NewsletterExport implements FromCollection
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $query = Newsletter::query();

        if (!empty($this->filters['email'])) {
            $query->where('email', 'like', '%' . $this->filters['email'] . '%');
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        return $query->get();
        return Newsletter::all();
    }
}
