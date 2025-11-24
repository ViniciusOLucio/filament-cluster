<?php

namespace App\Filament\Admin\Resources\Lessons\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informações da Aula')
                    ->description('Preencha os dados da aula que fará parte de um módulo.')
                    ->columnSpanFull()
                    ->schema([

                        Select::make('module_id')
                            ->label('Módulo')
                            ->relationship('module', 'title')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull()
                            ->placeholder('Selecione o módulo ao qual esta aula pertence'),

                        TextInput::make('title')
                            ->label('Título da aula')
                            ->required()
                            ->minLength(3)
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->placeholder('Ex.: Criando nosso primeiro controller'),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->placeholder('ex.: criando-nosso-primeiro-controller')
                            ->helperText('Você pode usar o título para gerar o slug automaticamente.')
                            ->lazy()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            }),

                        FileUpload::make('content')
                            ->label('Arquivo da aula')
                            ->required()
                            ->columnSpanFull()
                            ->directory('lessons/files')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/msword',
                                'image/*',
                                'video/*',
                            ])
                            ->placeholder('Envie o material da aula (PDF, DOCX, imagem, vídeo...)')
                            ->helperText('Envie o material que será utilizado nesta aula.'),
                    ]),
            ]);
    }

}
