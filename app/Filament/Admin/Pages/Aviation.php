<?php

namespace App\Filament\Admin\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Aviation extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.admin.pages.aviation';


    public function table(Table $table): Table
    {
        return $table
            ->records(function () {

                $data = cache()->remember('aviation_flights', 100, function () {

                    $response = Http::get('http://api.aviationstack.com/v1/flights', [
                        'access_key' => config('services.aviation.key'),
                        'limit' => 100,
                        'total' => 1,
                    ]);

                    if ($response->failed()) {
                        return [];
                    }

                    return $response->json('data') ?? [];
                });

                return $data;
            })
            ->columns([
                TextColumn::make('flight_date')
                    ->label('Data do voo')
                    ->dateTime('D/M/Y'),

                TextColumn::make('airline.name')
                    ->label('Companhia aérea'),

                TextColumn::make('departure.airport')
                    ->label('Partida'),

                TextColumn::make('arrival.airport')
                    ->label('Chegada'),

                TextColumn::make('flight.number')
                    ->label('Voo'),
            ])
            ->headerActions([
                Action::make('cache_clear')
                    ->label('Limpar Cache')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function () {
                        Cache::flush();
                        Artisan::call('cache:clear');
                        Notification::make()
                            ->success()
                            ->title('Cache limpo')
                            ->body('Novos dados foram carregados')
                            ->send();
                    }),
            ]);
    }


}
