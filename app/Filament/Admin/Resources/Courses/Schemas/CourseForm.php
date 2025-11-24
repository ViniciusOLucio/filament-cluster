<?php

namespace App\Filament\Admin\Resources\Courses\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informações do Curso')
                    ->description('Preencha os dados básicos do curso.')
                    ->columnSpanFull()
                    ->schema([

                        TextInput::make('name')
                            ->label('Nome do curso')
                            ->required()
                            ->minLength(3)
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->placeholder('Ex.: Laravel do Zero'),

                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(4)
                            ->columnSpanFull()
                            ->placeholder('Descreva o conteúdo e objetivo deste curso...'),
                    ]),
            ]);
    }

}
