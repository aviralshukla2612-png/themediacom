$files = Get-ChildItem -Path "c:\Users\yamini\Desktop\media\mediadynamic\app\Filament\Resources" -Recurse -Filter "*.php"

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    $original = $content

    # Add ->wrap() immediately after limit(...)
    $content = [regex]::Replace($content, "(->limit\(\d+\))", '$1->wrap()')

    if ($original -ne $content) {
        Write-Host "Modified $($file.Name)"
        Set-Content -Path $file.FullName -Value $content -NoNewline
    }
}
