<?php

namespace App\Filament\Pages;

use App\Support\Ai\AiInstructionRepository;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class AiAssistantSettings extends Page implements HasForms
{
    use InteractsWithForms;

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'Asistente IA';

    protected static ?string $navigationGroup = 'Integraciones';

    protected static ?int $navigationSort = 20;

    protected static string $view = 'filament.pages.ai-assistant-settings';

    public ?string $instructions = null;

    public array $data = [];

    public function mount(AiInstructionRepository $repository): void
    {
        $this->instructions = $repository->get();

        $this->form->fill([
            'instructions' => $this->instructions,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\MarkdownEditor::make('instructions')
                    ->label('Instrucciones del asistente')
                    ->helperText('Personaliza el tono, estilo y alcance del asistente IA. Se sincroniza inmediatamente con los chats públicos.')
                    ->minHeight(300)
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    /**
     * @throws Halt
     */
    public function save(AiInstructionRepository $repository): void
    {
        $data = $this->form->getState();

        $repository->put($data['instructions'] ?? '');

        Notification::make()
            ->success()
            ->title('Instrucciones actualizadas')
            ->body('El asistente IA utilizará la nueva guía desde este momento.')
            ->send();
    }
}
