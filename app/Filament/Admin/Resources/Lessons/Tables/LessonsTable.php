<?php

namespace App\Filament\Admin\Resources\Lessons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LessonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
        TextColumn::make('module.course.name')
            ->label('Curso')
            ->limit(20)
            ->sortable()
            ->searchable()
            ->icon('heroicon-o-academic-cap')
            ->toggleable(),

        TextColumn::make('module.title')
            ->label('Módulo')
            ->limit(25)
            ->sortable()
            ->searchable()
            ->icon('heroicon-o-rectangle-stack')
            ->toggleable(),

        TextColumn::make('title')
            ->label('Aula')
            ->limit(15)
            ->searchable()
            ->sortable()
            ->icon('heroicon-o-play-circle'),

        TextColumn::make('slug')
            ->label('Slug')
            ->limit(10)
            ->badge()
            ->color('gray')
            ->searchable()
            ->icon('heroicon-o-link'),

        TextColumn::make('created_at')
            ->label('Criado')
            ->date('d/m/Y')
            ->sortable()
            ->icon('heroicon-o-calendar')
            ->toggleable(isToggledHiddenByDefault: true),

        TextColumn::make('updated_at')
            ->label('Atualizado')
            ->date('d/m/Y H:i')
            ->sortable()
            ->icon('heroicon-o-clock')
            ->toggleable(isToggledHiddenByDefault: true),
    ])

        ->filters([
            SelectFilter::make('module_id')
                ->label('Filtrar por módulo')
                ->relationship('module', 'title')
                ->searchable(),

            SelectFilter::make('course')
                ->label('Filtrar por curso')
                ->relationship('module.course', 'name')
                ->searchable(),
        ])

        ->actions([
            ViewAction::make()
                ->icon('heroicon-o-eye'),

            EditAction::make()
                ->icon('heroicon-o-pencil'),

            DeleteAction::make()
                ->icon('heroicon-o-trash'),
        ])

        ->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
            ]);
    }
}
