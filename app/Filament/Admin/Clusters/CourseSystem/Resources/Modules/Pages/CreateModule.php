<?php

namespace App\Filament\Admin\Clusters\CourseSystem\Resources\Modules\Pages;

use App\Filament\Admin\Clusters\CourseSystem\Resources\Modules\ModuleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateModule extends CreateRecord
{
    protected static string $resource = ModuleResource::class;
}
