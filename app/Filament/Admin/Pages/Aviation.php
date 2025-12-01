<?php

namespace App\Filament\Admin\Pages;

use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use function Laravel\Prompts\search;

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
//                        'limit' => 100,
//                        'total' => 1,
                    ]);

                    if ($response->failed()) {
                        return [];
                    }

                    return $response->json('data') ?? [];
                });


              return $data;

//                $page = request()->integer('page', 1);
//                $perPage = request()->integer('per_page', 5);
//
//                $offset = ($page - 1) * $perPage;
//
//                $items = array_slice($data, $offset, $perPage);
//
//                return new LengthAwarePaginator(
//                    $items,
//                    count($data),
//                    $perPage,
//                    $page,
//                    [
//                        'path' => request()->url(),
//                        'query' => request()->query(),
//                    ]
//                );
            })


            ->columns([
                TextColumn::make('flight_date')
                    ->dateTime(timezone: 'America/Sao_Paulo'),
                TextColumn::make('airline.name'),
                TextColumn::make('flight.number'),
                TextColumn::make('departure.airport'),
                TextColumn::make('arrival.airport'),
            ])
            ->headerActions([
                Action::make('cache_clear')
                    ->label('Limpar Cache')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function(){
//                        $this->refresh();
                        Cache::flush();
                        Artisan::call('cache:clear');
                        Notification::make()
                            ->success()
                            ->title('Cache limpo')
                            ->body('Novos dados foram carregados');
                    }),



            ]);


//            ->defaultPaginationPageOption(5)
//            ->paginated([5, 10, 25, 50, 100, 'all']);
    }



}
