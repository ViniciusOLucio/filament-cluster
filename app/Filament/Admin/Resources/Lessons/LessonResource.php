<?php

namespace App\Filament\Admin\Resources\Lessons;

use App\Filament\Admin\Clusters\CourseSystem\CourseSystemCluster;
use App\Filament\Admin\Resources\Lessons\Pages\CreateLesson;
use App\Filament\Admin\Resources\Lessons\Pages\EditLesson;
use App\Filament\Admin\Resources\Lessons\Pages\ListLessons;
use App\Filament\Admin\Resources\Lessons\Pages\ViewLesson;
use App\Filament\Admin\Resources\Lessons\Schemas\LessonForm;
use App\Filament\Admin\Resources\Lessons\Schemas\LessonInfolist;
use App\Filament\Admin\Resources\Lessons\Tables\LessonsTable;
use App\Models\Lesson;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedVideoCamera;

    protected static ?string $recordTitleAttribute = 'Lesson';

    protected static ?string $modelLabel = 'Aula';

    protected static string | \UnitEnum | null $navigationGroup = 'Sistema de cursos';

    protected static ?string $pluralLabel = 'Aulas';

    protected static ?string $slug = 'aulas';


    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return LessonForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LessonInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LessonsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLessons::route('/'),
            'create' => CreateLesson::route('/create'),
            'view' => ViewLesson::route('/{record}'),
            'edit' => EditLesson::route('/{record}/edit'),
        ];
    }
}
