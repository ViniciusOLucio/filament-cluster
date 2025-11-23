<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
        //SEEDER USER
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@site.com',
            'password' => 'admin@site.com',
        ]);

        // SEEDER CURSOS

        $courses = [
            'Laravel Fundamentals',
            'Introduction to Web Development',
            'API Development with PHP',
        ];

        foreach ($courses as $courseName) {

            $course = Course::create([
                'name' => $courseName,
                'description' => fake()->sentence(12),
            ]);

            for ($m = 1; $m <= 2; $m++) {

                $module = Module::create([
                    'course_id' => $course->id,
                    'title' => "Module $m - " . fake()->words(3, true),
                ]);

                for ($l = 1; $l <= 10; $l++) {

                    Lesson::create([
                        'module_id' => $module->id,
                        'title' => "Lesson $l - " . fake()->words(4, true),
                        'slug' => fake()->slug(),
                        'content' => fake()->paragraph(4),
                    ]);
                }
            }
        }

    }

}
