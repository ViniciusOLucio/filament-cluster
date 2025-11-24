<?php

namespace App\Filament\Admin\Resources\Modules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Módulo')
                    ->description('Preencha os dados do módulo que fará parte de um curso.')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('course_id')
                            ->default(fn () => request('course_id'))
                            ->label('Curso')
                            ->relationship('course', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpanFull()
                            ->required()
                            ->placeholder('Selecione o curso ao qual o módulo pertence'),

                        TextInput::make('title')
                            ->label('Título do módulo')
                            ->required()
                            ->minLength(3)
                            ->maxLength(255)
                            ->placeholder('Ex.: Introdução ao Laravel'),
                    ])
            ]);
    }
}
