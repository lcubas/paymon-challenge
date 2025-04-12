<?php

namespace App\Providers;

use App\Repositories\Contracts\AcademyRepositoryInterface;
use App\Repositories\Contracts\CommunicationRepositoryInterface;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\Repositories\Contracts\StudentRepositoryInterface;
use App\Repositories\Eloquent\AcademyEloquentRepository;
use App\Repositories\Eloquent\CommunicationEloquentRepository;
use App\Repositories\Eloquent\CourseEloquentRepository;
use App\Repositories\Eloquent\EnrollmentEloquentRepository;
use App\Repositories\Eloquent\StudentEloquentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AcademyRepositoryInterface::class, AcademyEloquentRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseEloquentRepository::class);
        $this->app->bind(EnrollmentRepositoryInterface::class, EnrollmentEloquentRepository::class);
        $this->app->bind(CommunicationRepositoryInterface::class, CommunicationEloquentRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentEloquentRepository::class);
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

