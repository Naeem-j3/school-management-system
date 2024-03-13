<?php

namespace App\Providers;
use App\Repository\quizze\QuizzeRepository;
use App\Repository\quizze\QuizzeRepositoryInterface;
use App\Repository\student\AttendanceRepository;
use App\Repository\student\AttendanceRepositoryInterface;
use App\Repository\student\FeeInvoicesRepository;
use App\Repository\student\FeeInvoicesRepositoryInterface;
use App\Repository\student\FeeRepository;
use App\Repository\student\FeeRepositoryInterface;
use App\Repository\student\PormotionRepository;
use App\Repository\student\PormotionRepositoryInterface;
use App\Repository\student\ReceiptStudentsRepository;
use App\Repository\student\ReceiptStudentsRepositoryInterface;
use App\Repository\student\StudentGraduatedRepository;
use App\Repository\student\StudentGraduatedRepositoryInterface;
use App\Repository\student\StudentRepository;
use App\Repository\student\StudentRepositoryInterface;
use App\Repository\subject\SubjectRepository;
use App\Repository\subject\SubjectRepositoryInterface;
use App\Repository\teacher\TeacherRepository;
use App\Repository\teacher\TeacherRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            TeacherRepositoryInterface::class,
            TeacherRepository::class
        );
        $this->app->bind(
            PormotionRepositoryInterface::class,
            PormotionRepository::class
        );
        $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class
        );
        $this->app->bind(
            StudentGraduatedRepositoryInterface::class,
            StudentGraduatedRepository::class
        );
        $this->app->bind(
            FeeRepositoryInterface::class,
            FeeRepository::class
        );
        $this->app->bind(
            FeeInvoicesRepositoryInterface::class,
            FeeInvoicesRepository::class
        );
        $this->app->bind(
            ReceiptStudentsRepositoryInterface::class,
            ReceiptStudentsRepository::class
        );
        $this->app->bind(
            AttendanceRepositoryInterface::class,
            AttendanceRepository::class
        );
        $this->app->bind(
            SubjectRepositoryInterface::class,
            SubjectRepository::class
        );
        $this->app->bind(
            QuizzeRepositoryInterface::class,
            QuizzeRepository::class);





    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
