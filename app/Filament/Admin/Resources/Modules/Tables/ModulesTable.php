<?php

namespace App\Filament\Admin\Resources\Modules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ModulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
           ->columns([
                TextColumn::make('course.name')
                    ->label('Curso')
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-o-academic-cap')
                    ->toggleable(),

                TextColumn::make('title')
                    ->label('Módulo')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-rectangle-stack'),

                TextColumn::make('lessons_count')
                    ->label('Aulas')
                    ->counts('lessons') // precisa do withCount no query()
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'primary' : 'gray')
                    ->icon('heroicon-o-play-circle'),

                TextColumn::make('created_at')
                    ->label('Criado')
                    ->icon('heroicon-o-calendar')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Atualizado')
                    ->icon('heroicon-o-clock')
                    ->date('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                SelectFilter::make('course_id')
                    ->label('Filtrar por curso')
                    ->relationship('course', 'name')
                    ->searchable(),
            ])

            ->actions([
                ViewAction::make()
                    ->icon('heroicon-o-eye'),

                EditAction::make()
                    ->icon('heroicon-o-pencil-square'),

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
