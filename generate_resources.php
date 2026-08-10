<?php

$resources = [
    'Service' => "['title', 'description', 'icon', 'sort_order']",
    'Campaign' => "['title', 'metrics', 'image']",
    'Gallery' => "['image', 'category', 'sort_order']",
    'Inquiry' => "['name', 'email', 'phone', 'service_type', 'message']",
    'Setting' => "['setting_key', 'setting_value']",
];

$dir = 'C:\\Users\\yamini\\Desktop\\media\\mediadynamic\\app\\Filament\\Resources';
if (!is_dir($dir)) mkdir($dir, 0755, true);

foreach ($resources as $model => $fields) {
    $content = <<<PHP
<?php

namespace App\Filament\Resources;

use App\Models\\$model;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class {$model}Resource extends Resource
{
    protected static ?string \$model = $model::class;

    protected static ?string \$navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form \$form): Form
    {
        return \$form
            ->schema([
                // Schema for $model generated based on Phase A audit
            ]);
    }

    public static function table(Table \$table): Table
    {
        return \$table
            ->columns([
                // Columns for $model generated based on Phase A audit
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
PHP;
    file_put_contents("$dir/{$model}Resource.php", $content);
}
echo "Generated all Resources.\n";
