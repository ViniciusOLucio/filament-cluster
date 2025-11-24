<?php

namespace App\Filament\Admin\Clusters\CourseSystem\Resources\Modules\Pages;

use App\Filament\Admin\Clusters\CourseSystem\Resources\Modules\ModuleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewModule extends ViewRecord
{
    protected static string $resource = ModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
