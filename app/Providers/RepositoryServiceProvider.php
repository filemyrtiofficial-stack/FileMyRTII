<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Interfaces\AuthInterface;
use App\Repositories\HospitalRepository;
use App\Interfaces\HospitalInterface;
use App\Repositories\SpecialityRepository;
use App\Interfaces\SpecialityInterface;
use App\Repositories\DoctorRepository;
use App\Interfaces\DoctorInterface;
use App\Repositories\DiseaseRepository;
use App\Interfaces\DiseaseInterface;
use App\Repositories\DiseaseTypeRepository;
use App\Interfaces\DiseaseTypeInterface;
use App\Repositories\LabTestRepository;
use App\Interfaces\LabTestInterface;
use App\Repositories\CategoryRepository;
use App\Interfaces\CategoryInterface;
use App\Repositories\BlogRepository;
use App\Interfaces\BlogInterface;
use App\Repositories\EnquiryRepository;
use App\Interfaces\EnquiryInterface;
use App\Repositories\LabRepository;
use App\Interfaces\LabInterface;
use App\Repositories\ServiceCategoryRepository;
use App\Interfaces\ServiceCategoryInterface;
use App\Repositories\ServiceRepository;
use App\Interfaces\ServiceInterface;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthInterface::Class, AuthRepository::class);
        $this->app->bind(SpecialityInterface::Class, SpecialityRepository::class);
        $this->app->bind(HospitalInterface::Class, HospitalRepository::class);
        $this->app->bind(DiseaseTypeInterface::Class, DiseaseTypeRepository::class);
        $this->app->bind(DiseaseInterface::Class, DiseaseRepository::class);
        $this->app->bind(LabTestInterface::Class, LabTestRepository::class);
        $this->app->bind(DoctorInterface::Class, DoctorRepository::class);
        $this->app->bind(CategoryInterface::Class, CategoryRepository::class);
        $this->app->bind(BlogInterface::Class, BlogRepository::class);
        $this->app->bind(EnquiryInterface::Class, EnquiryRepository::class);
        $this->app->bind(LabInterface::Class, LabRepository::class);
        $this->app->bind(ServiceCategoryInterface::Class, ServiceCategoryRepository::class);
        $this->app->bind(ServiceInterface::Class, ServiceRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}