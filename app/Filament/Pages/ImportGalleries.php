<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;

class ImportGalleries extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.import-galleries';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('csv_file')
                    ->acceptedFileTypes([
                            'text/csv'
                        ])
                    ->preserveFilenames()
                    ->multiple()
                    ->hint('Max file size 200MB')
                    ->label('Gallery CSV File(s)')
                    ->maxSize(212288)
                    ->disk('local')  // storage/app
                    ->directory('uploaded-csv')  // storage/app/uploaded-csv
                    ->visibility('private')
                    ->required()
                    ->moveFiles(), //move from temp folder, instead of copying. helps to save disk space.
            ])
            ->statePath('data');
    }

    public function submitForm(): void
    {
        //https://github.com/filamentphp/filament/discussions/5982
        $attrs = $this->form->getState();

        //dd($attrs);

        Notification::make()
            ->success()
            ->title('file uploaded')
            ->send();
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->icon('heroicon-m-clipboard')
                ->submit('save'),
        ];
    }

}
