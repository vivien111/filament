<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\Lead;
use Illuminate\Support\Facades\Storage;

class ImportLeadsComponent extends Component implements HasForms
{
    use WithFileUploads, InteractsWithForms;

    public $file;

    public function form(Form $form): Form
    {
        return $form->schema([
            FileUpload::make('file')
                ->label('Fichier CSV')
                ->required()
                ->acceptedFileTypes(['text/csv']),
        ]);
    }

    public function submit()
    {
        $data = $this->form->getState();
        
        if (!$data['file']) {
            $this->dispatch('notify', type: 'error', message: 'Aucun fichier sélectionné.');
            return;
        }

        $path = $data['file']->store('uploads');

        $file = Storage::path($path);
        $rows = array_map('str_getcsv', file($file));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (count($header) === count($row)) {
                Lead::create(array_combine($header, $row));
            }
        }

        Storage::delete($path);
        $this->dispatch('notify', type: 'success', message: 'Leads importés avec succès !');
    }

    public function render()
    {
        return view('livewire.import-leads-component');
    }
}
