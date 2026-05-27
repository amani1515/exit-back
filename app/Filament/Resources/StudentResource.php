<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Students';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('username')->searchable()->sortable(),
                TextColumn::make('quizcode')->sortable(),
                TextColumn::make('feedback')->limit(50)->default('-'),
                TextColumn::make('created_at')->label('Submitted At')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('today')
                    ->label('Today')
                    ->query(fn (Builder $query) => $query->whereDate('created_at', Carbon::today()))
                    ->toggle(),

                Filter::make('yesterday')
                    ->label('Yesterday')
                    ->query(fn (Builder $query) => $query->whereDate('created_at', Carbon::yesterday()))
                    ->toggle(),

                Filter::make('custom_date')
                    ->label('Custom Date')
                    ->form([
                        DatePicker::make('date')->label('Pick a Date'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when(
                            $data['date'],
                            fn (Builder $q) => $q->whereDate('created_at', $data['date'])
                        );
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
        ];
    }
}
