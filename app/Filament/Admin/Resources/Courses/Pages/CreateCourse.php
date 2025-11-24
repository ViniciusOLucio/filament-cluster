<?php

namespace App\Filament\Admin\Resources\Courses\Pages;

use App\Filament\Admin\Resources\Courses\CourseResource;
use App\Filament\Admin\Resources\Modules\ModuleResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;

    public function getCreatedNotification(): ?Notification
    {
        $record = $this->record;

        return Notification::make()
            ->success()
            ->title('Curso cadastrado com sucesso!')
            ->body('Adicionar o primeiro modulo ao curso?')
            ->actions(function ($record) {
                return [
                    Action::make('add_module')
                        ->label('Adicionar Módulo')
                        ->button()
                        ->url(
                            ModuleResource::getUrl('create', [
                                'course_id' => $this->record->id,
                            ])
                        ),

                    Action::make('delete')
                        ->dispatch('delete-course', [
                            'courseId' => $this->record->id,
                        ])
                ];
            });
    }


}
