<?php

namespace App\Filament\Admin\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{


    public static function configure(Table $table): Table
    {
        return $table
            ->striped() // Linhas zebrinhas (mais clean)
            ->deferLoading() // Carrega mais rápido
            ->defaultSort('created_at', 'desc')
            ->columns([

                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->limit(25)
                    ->tooltip(fn ($record) => $record->name),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email copiado!')
                    ->copyMessageDuration(1500)
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->email),

                IconColumn::make('email_verified_at')
                    ->label('Verificado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([/* ... */])

            ->recordActions([
                ViewAction::make()
                    ->icon('heroicon-o-eye')
                    ->color('gray'),

                EditAction::make()
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary'),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Excluir selecionados')
                        ->color('danger'),
                ]),
            ])

            ->contentGrid([
                'md' => 1,
                'xl' => 1,
            ]);
    }
}
