<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use App\Interfaces\AuthInterface;

// use App\Repositories\HospitalRepository;
// use App\Interfaces\HospitalInterface;
// use App\Repositories\SpecialityRepository;
// use App\Interfaces\SpecialityInterface;
// use App\Repositories\DoctorRepository;
// use App\Interfaces\DoctorInterface;
// use App\Repositories\DiseaseRepository;
// use App\Interfaces\DiseaseInterface;
// use App\Repositories\DiseaseTypeRepository;
// use App\Interfaces\DiseaseTypeInterface;
// use App\Repositories\LabTestRepository;
// use App\Interfaces\LabTestInterface;
// use App\Repositories\LabRepository;
// use App\Interfaces\LabInterface;

use App\Repositories\CategoryRepository;
use App\Interfaces\CategoryInterface;
use App\Repositories\BlogRepository;
use App\Interfaces\BlogInterface;
use App\Repositories\EnquiryRepository;
use App\Interfaces\EnquiryInterface;
use App\Repositories\ServiceCategoryRepository;
use App\Interfaces\ServiceCategoryInterface;
use App\Repositories\ServiceRepository;
use App\Interfaces\ServiceInterface;
use App\Repositories\TeamMemberRepository;
use App\Interfaces\TeamMemberInterface;
use App\Repositories\MenuRepository;
use App\Interfaces\MenuInterface;
use App\Repositories\SectionRepository;
use App\Interfaces\SectionInterface;
use App\Repositories\TemplateRepository;
use App\Interfaces\TemplateInterface;
use App\Repositories\SettingRepository;
use App\Interfaces\SettingInterface;
use App\Repositories\TestimonialRepository;
use App\Interfaces\TestimonialInterface;
use App\Repositories\RoleRepository;
use App\Interfaces\RoleInterface;
use App\Repositories\LawyerRepository;
use App\Interfaces\LawyerInterface;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(SpecialityInterface::Class, SpecialityRepository::class);
        // $this->app->bind(HospitalInterface::Class, HospitalRepository::class);
        // $this->app->bind(DiseaseTypeInterface::Class, DiseaseTypeRepository::class);
        // $this->app->bind(DiseaseInterface::Class, DiseaseRepository::class);
        // $this->app->bind(LabTestInterface::Class, LabTestRepository::class);
        // $this->app->bind(DoctorInterface::Class, DoctorRepository::class);
        // $this->app->bind(LabInterface::Class, LabRepository::class);
        $this->app->bind(AuthInterface::Class, AuthRepository::class);
        $this->app->bind(CategoryInterface::Class, CategoryRepository::class);
        $this->app->bind(BlogInterface::Class, BlogRepository::class);
        $this->app->bind(EnquiryInterface::Class, EnquiryRepository::class);
        $this->app->bind(ServiceCategoryInterface::Class, ServiceCategoryRepository::class);
        $this->app->bind(ServiceInterface::Class, ServiceRepository::class);
        $this->app->bind(TeamMemberInterface::Class, TeamMemberRepository::class);
        $this->app->bind(MenuInterface::Class, MenuRepository::class);
        $this->app->bind(SectionInterface::Class, SectionRepository::class);
        $this->app->bind(TemplateInterface::Class, TemplateRepository::class);
        $this->app->bind(SettingInterface::Class, SettingRepository::class);
        $this->app->bind(TestimonialInterface::Class, TestimonialRepository::class);
        $this->app->bind(RoleInterface::Class, RoleRepository::class);
        $this->app->bind(LawyerInterface::Class, LawyerRepository::class);


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