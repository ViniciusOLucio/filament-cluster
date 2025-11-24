<?php

namespace App\Filament\Admin\Resources\Courses\Pages;

use App\Filament\Admin\Resources\Courses\CourseResource;
use App\Models\Course;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Livewire\Attributes\On;

class ViewCourse extends ViewRecord
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    #[On('delete-course')]
    public function deleteCourse($courseId): void
    {
        $course = Course::query()->find($courseId);

        if ($course === null) {
            return;
        }

        $course->delete();
        $this->redirect(CourseResource::getUrl('index'));
        Notification::make()
            ->success()
            ->title(('Curso ' . $course->name . ' deletado com sucesso!'))
            ->send();
    }

}
