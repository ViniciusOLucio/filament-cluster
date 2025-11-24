<?php

namespace App\Filament\Admin\Clusters\CourseSystem\Resources\Modules\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('course_id')
                    ->required()
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
            ]);
    }
}
