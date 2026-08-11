$files = Get-ChildItem -Path "c:\Users\yamini\Desktop\media\mediadynamic\app\Filament\Resources" -Recurse -Filter "Edit*.php"

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    
    # Check if it already has CreateAction to avoid duplicates
    if ($content -notmatch "CreateAction::make\(\)") {
        # Insert \Filament\Actions\CreateAction::make(), before DeleteAction::make()
        $content = $content -replace "DeleteAction::make\(\),", "\Filament\Actions\CreateAction::make(),`r`n            DeleteAction::make(),"
        
        Set-Content -Path $file.FullName -Value $content
        Write-Host "Updated $($file.Name)"
    }
}
